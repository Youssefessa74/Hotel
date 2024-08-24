<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Termwind\render;

class AdminsController extends Controller
{


    public function index(AdminDataTable $adminDataTable)
    {
        return $adminDataTable->render('admin.all_admins.index');
    }

    public function create()
    {
        return view('admin.all_admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'], // Ensure passwords match and have a minimum length
            'role_level' => ['required', 'integer'],
            'role' => ['required', 'in:admin'],
        ]);
        $user = new User();
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->password  = Hash::make($request->password);
        $user->role_level  = $request->role_level;
        $user->role  = $request->role;
        $user->save();
        toastr('Admin Saved Successfully', 'success');
        return to_route('all.admins');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.all_admins.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id], // Ignore the current user's email
            'password' => ['nullable', 'confirmed', 'min:8'], // Password is optional
            'role_level' => ['required', 'integer'],
            'role' => ['required', 'in:admin'],
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role_level = $request->role_level;
        $user->role = $request->role;
        $user->save();

        toastr('Admin Updated Successfully', 'success');

        return redirect()->route('all.admins');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toastr('Data Deleted Successfully', 'success');
        return redirect()->route('all.admins');
    }
}
