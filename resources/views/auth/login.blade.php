@extends('layouts.form') 
@section('title', 'Login') 

@section('content')
<form id="login_form" 
    class="bg-[rgba(255,255,255,0.1)] backdrop-blur w-100 flex flex-col gap-3 p-5 rounded"
>
    <h1 class="text-3xl font-bold pb-5">Account Login</h1>
    <label for="email">E-mail</label>
    <div class="relative">
        <i class="fas fa-at absolute top-3 left-2"></i>
        <input
            name="email"
            class="w-full outline-none border-1 rounded border-gray-800 p-2 pl-8"
            type="email"
            placeholder="ex. example@email.com"
        />
    </div>
    <span class="err email"></span>
    <label for="password">password</label>
    <div class="relative">
        <i class="fas fa-lock absolute top-3 left-2"></i>
        <input
            name="password"
            class="w-full outline-none border-1 rounded border-gray-800 p-2 pl-8"
            type="password"
            placeholder="must be 8 characters (numbers, symbols)"
        />
    </div>
    <span class="err password"></span>
    <button
        class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-gray-800 border-none text-white text-bold rounded-full cursor-pointer"
    >
        Login
    </button>
    
    <a
        href="/auth/redirect"
        class="flex items-center justify-center gap-2 w-full px-4 py-2 rounded transition hover:bg-gray-50"
    >
        <img
            src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
            alt="Google"
            class="w-5 h-5"
        />
        <span class="text-sm font-medium">Sign in with Google</span>
    </a>
    <a class="text-center" href="/signup">Dont have an account? Signup</a>
</form>
@endsection 

@vite(['resources/js/submit_login.js'])
