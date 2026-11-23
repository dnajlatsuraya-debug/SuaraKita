<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AspirationController extends Controller
{
    // ==========================================
    // MENAMPILKAN HALAMAN UTAMA
    // ==========================================

    public function index()
    {
        $aspirations = Aspiration::latest()->get();

        return view('aspirations.index', compact('aspirations'));
    }


    // ==========================================
    // MENYIMPAN ASPIRASI BARU
    // ==========================================

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'evidence_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('evidence_photo')) {
            $photoPath = $this->uploadPersistentPhoto($request->file('evidence_photo'));
        }

        // Membuat kode rahasia untuk mengedit aspirasi
        $editCode = Str::random(8);

        Aspiration::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'location' => $request->location,
            'evidence_photo' => $photoPath,
            'edit_token' => Hash::make($editCode),
            'status' => 'Menunggu',
            'votes' => 0,
        ]);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Aspirasi berhasil dikirim!')
            ->with('edit_code', $editCode);
    }


    // ==========================================
    // DASHBOARD ADMIN
    // ==========================================

    public function admin()
{
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login');
    }

    // Mengambil seluruh data aspirasi
    $aspirations = Aspiration::latest()->get();

    // Menghitung aspirasi yang masuk hari ini
    $dailyReport = Aspiration::whereDate(
        'created_at',
        today()
    )->count();

    // Menghitung aspirasi yang masuk bulan ini
    $monthlyReport = Aspiration::whereMonth(
        'created_at',
        now()->month
    )->whereYear(
        'created_at',
        now()->year
    )->count();

    return view('aspirations.admin', compact(
        'aspirations',
        'dailyReport',
        'monthlyReport'
    ));
}


    // ==========================================
    // MENGUBAH STATUS ASPIRASI
    // ==========================================

    public function updateStatus(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai',
        ]);

        $aspiration = Aspiration::findOrFail($id);

        $aspiration->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('aspirations.admin')
            ->with('success', 'Status aspirasi berhasil diperbarui.');
    }


    // ==========================================
    // MENAMPILKAN FORM EDIT ASPIRASI
    // ==========================================

    public function edit(Request $request, $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $code = $request->query('code');

        if (
            !$code ||
            !$aspiration->edit_token ||
            !Hash::check($code, $aspiration->edit_token)
        ) {
            return redirect()
                ->route('aspirations.index')
                ->with('error', 'Kode edit salah atau tidak valid.');
        }

        return view('aspirations.edit', compact('aspiration', 'code'));
    }


    // ==========================================
    // MEMPERBARUI ASPIRASI
    // ==========================================

    public function update(Request $request, $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $code = $request->input('code');

        if (
            !$code ||
            !$aspiration->edit_token ||
            !Hash::check($code, $aspiration->edit_token)
        ) {
            return redirect()
                ->route('aspirations.index')
                ->with('error', 'Kode edit salah atau tidak valid.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'evidence_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = $aspiration->evidence_photo;

        if ($request->hasFile('evidence_photo')) {

            // Menghapus foto lama di local disk jika bukan URL eksternal
            if ($photoPath && !filter_var($photoPath, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($photoPath);
            }

            // Menyimpan foto baru secara persisten
            $photoPath = $this->uploadPersistentPhoto($request->file('evidence_photo'));
        }

        $aspiration->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'location' => $request->location,
            'evidence_photo' => $photoPath,
        ]);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Aspirasi berhasil diperbarui.');
    }


    // ==========================================
    // MEMBERIKAN DUKUNGAN / UPVOTE
    // ==========================================

    public function upvote($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $votedAspirations = session('voted_aspirations', []);

        if (in_array($id, $votedAspirations)) {
            return redirect()
                ->route('aspirations.index')
                ->with('error', 'Kamu sudah mendukung aspirasi ini.');
        }

        $aspiration->increment('votes');

        $votedAspirations[] = $id;

        session([
            'voted_aspirations' => $votedAspirations
        ]);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Terima kasih sudah mendukung aspirasi!');
    }


    // ==========================================
    // MENGHAPUS ASPIRASI YANG SUDAH SELESAI
    // ==========================================

    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $aspiration = Aspiration::findOrFail($id);

        if ($aspiration->status !== 'Selesai') {
            return redirect()
                ->route('aspirations.admin')
                ->with('error', 'Aspirasi hanya dapat dihapus jika statusnya sudah Selesai.');
        }

        // Menghapus foto bukti jika tersedia
        if ($aspiration->evidence_photo) {
            Storage::disk('public')->delete(
                $aspiration->evidence_photo
            );
        }

        $aspiration->delete();

        return redirect()
            ->route('aspirations.admin')
            ->with('success', 'Aspirasi berhasil dihapus.');
    }


    // Menampilkan laporan berdasarkan rentang tanggal
public function report(Request $request)
{
    if (!session('admin_logged_in')) {
        return redirect()->route('admin.login');
    }

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if (!$startDate && !$endDate) {
        $startDate = now()->toDateString();
        $endDate = now()->toDateString();
    } elseif (!$startDate) {
        $startDate = $endDate;
    } elseif (!$endDate) {
        $endDate = $startDate;
    }

    $aspirations = Aspiration::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->latest()
        ->get();

    $totalReport = $aspirations->count();
    $totalMenunggu = $aspirations->where('status', 'Menunggu')->count();
    $totalDiproses = $aspirations->where('status', 'Diproses')->count();
    $totalSelesai = $aspirations->where('status', 'Selesai')->count();

    return view('aspirations.report', compact(
        'aspirations',
        'startDate',
        'endDate',
        'totalReport',
        'totalMenunggu',
        'totalDiproses',
        'totalSelesai'
    ));
}


    // ==========================================
    // EKSPOR LAPORAN KE EXCEL MELALUI CSV
    // ==========================================

    public function exportReportExcel(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        $month = (int) $request->month;
        $year = (int) $request->year;

        $aspirations = Aspiration::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('created_at', 'asc')
            ->get();

        $filename = "laporan-suarakita-{$month}-{$year}.csv";

        return response()->streamDownload(function () use ($aspirations, $month, $year) {

            $file = fopen('php://output', 'w');

            // Supaya karakter Indonesia terbaca di Excel
            fwrite($file, "\xEF\xBB\xBF");

            fputcsv($file, ['LAPORAN BULANAN ASPIRASI SUARAKITA']);
            fputcsv($file, ['Bulan', $month]);
            fputcsv($file, ['Tahun', $year]);
            fputcsv($file, []);

            fputcsv($file, [
                'No',
                'Tanggal',
                'Judul Aspirasi',
                'Kategori',
                'Deskripsi',
                'Lokasi',
                'Status'
            ]);

            foreach ($aspirations as $index => $aspiration) {
                fputcsv($file, [
                    $index + 1,
                    $aspiration->created_at->format('d-m-Y'),
                    $aspiration->title,
                    $aspiration->category,
                    $aspiration->description,
                    $aspiration->location ?? '-',
                    $aspiration->status,
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, [
                'Total Aspirasi',
                $aspirations->count()
            ]);

            fclose($file);

        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8'
        ]);
    }

    /**
     * Upload foto secara persisten menggunakan Imgur CDN (Direct Link)
     * dengan fallback ke local public disk jika koneksi eksternal terkendala.
     */
    private function uploadPersistentPhoto($file): ?string
    {
        try {
            $base64 = base64_encode(file_get_contents($file->getRealPath()));
            $clientId = '546c25a59c58ad7'; // Anonymous Imgur Client ID

            $ch = curl_init('https://api.imgur.com/3/image');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Client-ID ' . $clientId,
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'image' => $base64,
                'type' => 'base64',
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $response) {
                $data = json_decode($response, true);
                if (!empty($data['data']['link'])) {
                    return $data['data']['link'];
                }
            }
        } catch (\Throwable $e) {
            // Silently fallback to local storage
        }

        return $file->store('aspirations', 'public');
    }

}