@extends('layouts.app')

@section('content')
<div class="text-center mt-12">
    <h1 class="text-4xl font-bold text-red-600 mb-4">404 - Page Not Found</h1>
    <p class="text-gray-600 mb-6">Oops! Halaman yang kamu cari tidak ditemukan.</p>
    <a href="{{ route('posts.index') }}" class="text-blue-500 underline">Kembali ke Beranda</a>
</div>
@endsection
