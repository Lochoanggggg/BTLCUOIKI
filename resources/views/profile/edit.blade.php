@extends('layouts.app')
@section('title', 'Hồ sơ cá nhân | BTL Clothing')
@section('content')
<div class="mx-auto max-w-3xl px-6 py-16"><p class="text-sm font-bold uppercase tracking-widest text-amber-600">Tài khoản</p><h1 class="mt-2 text-4xl font-black">Hồ sơ cá nhân</h1><form method="POST" action="{{ route('profile.update') }}" class="mt-8 space-y-5 rounded-2xl bg-white p-8 shadow-sm ring-1 ring-stone-200">@csrf @method('PUT')
    <div class="grid gap-5 md:grid-cols-2"><div><label class="mb-2 block text-sm font-semibold" for="name">Họ và tên</label><input class="w-full rounded-lg border-stone-300" id="name" name="name" value="{{ old('name', $user->name) }}" required>@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div><div><label class="mb-2 block text-sm font-semibold" for="email">Email</label><input class="w-full rounded-lg border-stone-300" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>@error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div></div>
    <div class="grid gap-5 md:grid-cols-2"><div><label class="mb-2 block text-sm font-semibold" for="phone">Số điện thoại</label><input class="w-full rounded-lg border-stone-300" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"></div><div><label class="mb-2 block text-sm font-semibold" for="role">Vai trò</label><input class="w-full rounded-lg border-stone-300 bg-stone-100" id="role" value="{{ $user->role === 'owner' ? 'Chủ cửa hàng' : 'Khách hàng' }}" disabled></div></div>
    <div><label class="mb-2 block text-sm font-semibold" for="address">Địa chỉ</label><textarea class="w-full rounded-lg border-stone-300" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea></div>
    <button class="rounded-lg bg-stone-900 px-6 py-3 font-bold text-white hover:bg-amber-700" type="submit">Lưu thay đổi</button>
</form></div>
@endsection
