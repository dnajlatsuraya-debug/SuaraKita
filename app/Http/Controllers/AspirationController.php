<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AspirationController extends Controller
{
    // HALAMAN UTAMA
    public function index()
    {
        $aspirations = Aspiration::latest()->get();

        return view('aspirations.index', compact('aspirations'));
    }

    // KIRIM ASPIRASI
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'evidence_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Kode ini diberikan kepada pengirim satu kali.
        $editCode = Str::random(12);

        $photoPath = null;

        if ($request->hasFile('evidence_photo')) {
            $photoPath = $request->file('evidence_photo')
                ->store('aspirations', 'public');
        }

        Aspiration::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? null,
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

    // HALAMAN ADMIN
    public function admin()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $aspirations = Aspiration::latest()->get();

        return view('aspirations.admin', compact('aspirations'));
    }

    // UBAH STATUS
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
            ->with('success', 'Status berhasil diperbarui!');
    }

    // HALAMAN EDIT DENGAN KODE RAHASIA
    public function edit(Request $request, $id)
    {
        $aspiration = Aspiration::findOrFail($id);
        $code = $request->query('code');

        if (
            !$code ||
            !$aspiration->edit_token ||
            !Hash::check($code, $aspiration->edit_token)
        ) {
            abort(403, 'Kode edit salah atau tidak tersedia.');
        }

        return view('aspirations.edit', compact('aspiration', 'code'));
    }

    // SIMPAN PERUBAHAN ASPIRASI
    public function update(Request $request, $id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $code = $request->input('code');

        if (
            !$code ||
            !$aspiration->edit_token ||
            !Hash::check($code, $aspiration->edit_token)
        ) {
            abort(403, 'Kode edit salah atau tidak tersedia.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'evidence_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? null,
        ];

        if ($request->hasFile('evidence_photo')) {
            if ($aspiration->evidence_photo) {
                Storage::disk('public')->delete(
                    $aspiration->evidence_photo
                );
            }

            $data['evidence_photo'] = $request->file('evidence_photo')
                ->store('aspirations', 'public');
        }

        $aspiration->update($data);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Aspirasi berhasil diperbarui!');
    }

    // UPVOTE: SATU KALI PER SESI BROWSER
    public function upvote($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $votedIds = session('voted_aspirations', []);

        if (in_array($aspiration->id, $votedIds)) {
            return redirect()
                ->route('aspirations.index')
                ->with('error', 'Kamu sudah memberikan dukungan.');
        }

        $aspiration->increment('votes');

        $votedIds[] = $aspiration->id;
        session(['voted_aspirations' => $votedIds]);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Dukungan berhasil diberikan!');
    }

    // HAPUS HANYA JIKA STATUS SELESAI
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $aspiration = Aspiration::findOrFail($id);

        if ($aspiration->status !== 'Selesai') {
            return redirect()
                ->route('aspirations.admin')
                ->with('error', 'Aspirasi hanya dapat dihapus jika statusnya Selesai.');
        }

        if ($aspiration->evidence_photo) {
            Storage::disk('public')->delete(
                $aspiration->evidence_photo
            );
        }

        $aspiration->delete();

        return redirect()
            ->route('aspirations.admin')
            ->with('success', 'Aspirasi berhasil dihapus!');
    }
}
