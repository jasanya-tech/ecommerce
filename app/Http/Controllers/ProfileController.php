<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('customer.profile', [
            'title' => 'profile'
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:6',
            'email' => 'email:rfc,dns|unique:users,email,' . $user->id,
            'phone_number' => 'required|numeric|unique:users,phone_number,' . $user->id,
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 6',
            'email.required' => 'tidak boleh dikosongkan',
            'email.email' => 'invalid email',
            'email.unique' => 'email sudah terdaftar',
            'phone_number.unique' => 'nomer handphone sudah terdaftar',
            'phone_number.required' => 'tidak boleh dikosongkan',
            'phone_number.numeric' => 'harus berupa angka',
        ]);

        $user->update([
            'email' => $data['email'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
        ]);

        return back()->with([
            'success' => 'update profile berhasil',
        ]);
    }
    public function updateImage(Request $request, User $user)
    {
        $data = $request->validate([
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'image.max' => 'maximal 2mb',
            'image.mimes' => 'invalid image, image harus jpeg,png,jpg,gif,svg,webp',
        ]);

        $oldImage = $user->image;
        $image = FileHelper::optimizeAndUploadPicture($data['image'], 'users');
        $user->update([
            'image' => $image,
        ]);
        FileHelper::deleteImage('users', $oldImage);

        return back()->with([
            'success' => 'update image profile berhasil',
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        // Validasi input form
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ], [
            'password.min' => 'minimal karakter 6',
            'password.required' => 'tidak boleh dikosongkan',
            'password.confirmed' => 'password dan konfirmasi password tidak sesuai',
            'old_password.required' => 'tidak boleh dikosongkan',
        ]);

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui.');
        } else {
            return redirect()->back()->withErrors(['old_password' => 'Kata sandi lama tidak valid.']);
        }
    }
}
