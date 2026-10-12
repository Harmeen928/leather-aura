<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.settings', ['settings' => Setting::pairs(), 'user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'phone'       => 'required|string|max:40',
            'email'       => 'required|email|max:150',
            'address'     => 'required|string|max:255',
            'admin_email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'password'    => 'nullable|string|min:8|confirmed',
        ]);

        Setting::put('phone', $data['phone']);
        Setting::put('email', $data['email']);
        Setting::put('address', $data['address']);

        $user->email = $data['admin_email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return back()->with('success', 'Settings saved.');
    }
}
