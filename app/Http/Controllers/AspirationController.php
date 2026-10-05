<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    // READ
    public function index()
    {
        $aspirations = Aspiration::latest()->get();

        return view('aspirations.index', compact('aspirations'));
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Aspiration::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'status' => 'Menunggu',
            'votes' => 0,
        ]);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }

    // HALAMAN ADMIN
    public function admin()
    {
        $aspirations = Aspiration::latest()->get();

        return view('aspirations.admin', compact('aspirations'));
    }

    // UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
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

    // HALAMAN EDIT
    public function edit($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        return view('aspirations.edit', compact('aspiration'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $aspiration = Aspiration::findOrFail($id);

        $aspiration->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('aspirations.admin')
            ->with('success', 'Aspirasi berhasil diperbarui!');
    }

    // DELETE
    public function destroy($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        $aspiration->delete();

        return redirect()
            ->route('aspirations.admin')
            ->with('success', 'Aspirasi berhasil dihapus!');
    }
}