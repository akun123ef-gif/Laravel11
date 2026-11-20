<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Manajemen User',
            'user' => User::latest()->paginate(10),
            'content' => 'admin.user.index',
        ]);
    }

    public function create()
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Tambah User',
            'content' => 'admin.user.create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            're_password' => ['required', 'same:password'],
            'role' => ['required', 'string', 'in:admin,kasir'],
        ]);
        unset($data['re_password']);
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.layouts.wrapper', [
            'title' => 'Edit User',
            'user' => $user,
            'content' => 'admin.user.create',
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'min:6'],
            're_password' => ['required_with:password', 'same:password'],
            'role' => ['required', 'string', 'in:admin,kasir'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        if (!empty($data['password'])) $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
