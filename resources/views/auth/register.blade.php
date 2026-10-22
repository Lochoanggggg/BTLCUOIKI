@extends('layouts.app')
@section('title', 'Đăng ký | BTL Clothing')
@section('content')
<div class="mx-auto max-w-md px-6 py-16">
    <div class="mb-8 text-center"><p class="text-sm font-bold uppercase tracking-widest text-amber-600">Bắt đầu hành trình</p><h1 class="mt-2 text-3xl font-black">Tạo tài khoản</h1></div>
    <form method="POST" action="{{ route('register.store') }}" class="space-y-5 rounded-2xl bg-white p-8 shadow-sm ring-1 ring-stone-200">
        @csrf
        <div><label class="mb-2 block text-sm font-semibold" for="name">Họ và tên</label><input class="w-full rounded-lg border-stone-300" id="name" name="name" value="{{ old('name') }}" required>@error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
        <div><label class="mb-2 block text-sm font-semibold" for="email">Email</label><input class="w-full rounded-lg border-stone-300" id="email" name="email" type="email" value="{{ old('email') }}" required>@error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
        <div><label class="mb-2 block text-sm font-semibold" for="password">Mật khẩu</label><input class="w-full rounded-lg border-stone-300" id="password" name="password" type="password" required>@error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror</div>
        <div><label class="mb-2 block text-sm font-semibold" for="password_confirmation">Nhập lại mật khẩu</label><input class="w-full rounded-lg border-stone-300" id="password_confirmation" name="password_confirmation" type="password" required></div>
        <button class="w-full rounded-lg bg-stone-900 px-4 py-3 font-bold text-white hover:bg-amber-700" type="submit">Tạo tài khoản</button>
        <p class="text-center text-sm text-stone-500">Đã có tài khoản? <a class="font-semibold text-amber-700" href="{{ route('login') }}">Đăng nhập</a></p>
    </form>
</div>
@endsection
