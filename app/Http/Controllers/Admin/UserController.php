<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->filter(request(['search', 'role', 'sort_option']))->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:6',
            'email' => 'email:rfc,dns|unique:users,email',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'password' => 'required|min:6',
            'role' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 6',
            'email.required' => 'tidak boleh dikosongkan',
            'email.email' => 'invalid email',
            'email.unique' => 'email sudah terdaftar',
            'phone_number.unique' => 'nomer handphone sudah terdaftar',
            'phone_number.required' => 'tidak boleh dikosongkan',
            'phone_number.numeric' => 'harus berupa angka',
            'password.min' => 'minimal karakter 6',
            'password.required' => 'tidak boleh dikosongkan',
            'role.required' => 'tidak boleh dikosongkan',
            'image.required' => 'tidak boleh dikosongkan',
            'image.max' => 'maximal 10 image',
            'image.max' => 'maximal 2mb',
            'image.mimes' => 'invalid image, image harus jpeg,png,jpg,gif,svg,webp',
        ]);

        $image = FileHelper::optimizeAndUploadPicture($data['image'], 'users');
        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'image' => $image,
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('user.create')->with([
            'message' => 'created user berhasil',
            'status' => 'success',
        ]);
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:6',
            'email' => 'email:rfc,dns|unique:users,email,' . $user->id,
            'phone_number' => 'required|numeric|unique:users,phone_number,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 6',
            'email.required' => 'tidak boleh dikosongkan',
            'email.email' => 'invalid email',
            'email.unique' => 'email sudah terdaftar',
            'phone_number.unique' => 'nomer handphone sudah terdaftar',
            'phone_number.required' => 'tidak boleh dikosongkan',
            'phone_number.numeric' => 'harus berupa angka',
            'password.min' => 'minimal karakter 6',
            'role.required' => 'tidak boleh dikosongkan',
            'image.max' => 'maximal 10 image',
            'image.max' => 'maximal 2mb',
            'image.mimes' => 'invalid image, image harus jpeg,png,jpg,gif,svg,webp',
        ]);

        $oldImage = $user->image;
        if ($request->password && $request->hasFile('image')) {
            $image = FileHelper::optimizeAndUploadPicture($data['image'], 'users');
            $user->update([
                'email' => $data['email'],
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'image' => $image,
                'password' => bcrypt($data['password']),
            ]);
            FileHelper::deleteImage('users', $oldImage);
        } elseif ($request->password) {
            $user->update([
                'email' => $data['email'],
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'password' => bcrypt($data['password']),
            ]);
        } elseif ($request->hasFile('image')) {
            $image = FileHelper::optimizeAndUploadPicture($data['image'], 'users');
            $user->update([
                'email' => $data['email'],
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'image' => $image,
                'password' => bcrypt($data['password']),
            ]);
            FileHelper::deleteImage('users', $oldImage);
        } else {
            $user->update([
                'email' => $data['email'],
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
            ]);
        }

        return redirect()->route('user.edit', $user->id)->with([
            'message' => 'updated user berhasil',
            'status' => 'success',
        ]);
    }

    public function destroy(User $user)
    {
        $adminCount = User::where('role', 1)->count();

        if ($user->role == 1 && $adminCount === 1) {
            return redirect()->route('user.index')->with([
                'message' => 'Tidak Dapat delet akun admin, karena ini akun admin satu-satu nya',
                'status' => 'warning',
            ]);
        }

        $user->delete();
        FileHelper::deleteImage('users', $user->image);
        return redirect()->route('user.index')->with([
            'message' => 'deleted user berhasil',
            'status' => 'success',
        ]);
    }
}
