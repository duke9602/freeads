@extends('user.layout')

@section('content')

<main class="flex-1 p-6 bg-gray-50">
        <h2 class="text-2xl font-semibold mb-4">Welcome {{ auth()->user()->name }} 👋</h2>
        <p class="text-gray-600">Welcome to your dashboard</p>
        
</main>

@endsection