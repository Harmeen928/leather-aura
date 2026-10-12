@extends('admin.layout')
@section('title', 'Settings')

@section('content')
<h1>Settings</h1>
<p class="sub">Update the website contact details and your admin login here.</p>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')

    <div class="card">
        <h3 style="margin-bottom:16px">Website Contact Details</h3>
        <div class="grid2">
            <div>
                <label>Phone Number *</label>
                <input type="text" name="phone" value="{{ old('phone', $settings['phone']) }}" required>
                @error('phone')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Email (inquiries are sent here) *</label>
                <input type="email" name="email" value="{{ old('email', $settings['email']) }}" required>
                @error('email')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div class="full">
                <label>Address *</label>
                <input type="text" name="address" value="{{ old('address', $settings['address']) }}" required>
                @error('address')<div class="err">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom:16px">Admin Login</h3>
        <div class="grid2">
            <div class="full">
                <label>Login Email *</label>
                <input type="email" name="admin_email" value="{{ old('admin_email', $user->email) }}" required>
                @error('admin_email')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>New Password</label>
                <input type="password" name="password" autocomplete="new-password">
                <div class="hint">Leave empty to keep the current password. Minimum 8 characters.</div>
                @error('password')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" autocomplete="new-password">
            </div>
        </div>
    </div>

    <button class="btn" type="submit">Save Settings</button>
</form>
@endsection
