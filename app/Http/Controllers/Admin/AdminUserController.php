<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        // Get related data
        $tempatWisata = \App\Models\TempatWisata::where('user_id', $user->id)->first();
        $tourGuide = \App\Models\TourGuide::where('user_id', $user->id)->first();

        return view('admin.users.show', compact('user', 'tempatWisata', 'tourGuide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,tour_guide,tempat_wisata',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'role.required' => 'Role harus dipilih',
            'role.in' => 'Role tidak valid',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        // Update password jika ada
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            
            $file = $request->file('photo');
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('users/photos', $filename, 'public');
            $updateData['photo'] = $photoPath;
        }

        $user->update($updateData);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto jika ada
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        // Hapus user (cascade akan menghapus tempat wisata/tour guide terkait)
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Reset password user
     */
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        
        // Generate random password
        $newPassword = \Illuminate\Support\Str::random(12);
        $user->update(['password' => Hash::make($newPassword)]);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Password berhasil direset! Password baru: <strong>' . $newPassword . '</strong> (Catat password ini dan berikan ke user)');
    }
}

