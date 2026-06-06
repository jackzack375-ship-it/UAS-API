@extends('layouts.app')
@section('title', 'Hubungi Kami')
@section('content')
<div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg mt-10">
    <h1 class="text-3xl font-bold mb-6 dark:text-white">Hubungi Kami</h1>
    <form action="#" class="space-y-4">
        <input type="text" placeholder="Nama" class="w-full bg-gray-50 dark:bg-gray-700 border dark:border-gray-500 rounded-xl px-4 py-3">
        <input type="email" placeholder="Email" class="w-full bg-gray-50 dark:bg-gray-700 border dark:border-gray-500 rounded-xl px-4 py-3">
        <textarea rows="4" placeholder="Pesan" class="w-full bg-gray-50 dark:bg-gray-700 border dark:border-gray-500 rounded-xl px-4 py-3"></textarea>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">Kirim Pesan</button>
    </form>
</div>
@endsection