@extends('layouts.form') 
@section('title', 'Signup') 

@section('content')
    <form id="signup_form" class="w-100 flex flex-col gap-3">
        <h1 class="text-3xl font-bold pb-5">Account Signup</h1>
        <label for="name">Full Name</label>
        <div class="relative">
            <i class="fas fa-user absolute top-3 left-2"></i>
            <input
                name="name"
                class="w-full border-1 rounded border-gray-800 p-2 pl-8"
                type="text"
                placeholder="ex. John Doe"
            />
        </div>
        <span class="err name"></span>
        <label for="email">E-mail</label>
        <div class="relative">
            <i class="fas fa-at absolute top-3 left-2"></i>
            <input
                name="email"
                class="w-full border-1 rounded border-gray-800 p-2 pl-8"
                type="email"
                placeholder="E-mail"
            />
        </div>
        <span class="err email"></span>
        <label for="password">Password</label>
        <div class="relative">
            <i class="fas fa-lock absolute top-3 left-2"></i>
            <input
            name="password"
            class="w-full border-1 rounded border-gray-800 p-2 pl-8"
            type="password"
            placeholder="password"
        />
        </div>
        <span class="err password"></span>
        <button
            class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-gray-800 border-none text-white text-bold rounded-full cursor-pointer"
        >
            Signup
        </button>
                <a
            href="/auth/redirect"
            class="flex items-center justify-center gap-2 w-full px-4 py-3 text-gray-800 "
        >
            <img
                src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                alt="Google"
                class="w-5 h-5"
            />
            <span class="text-sm font-medium">Sign in with Google</span>
        </a>
        <a class="text-center" href="/login">Already have an account? Login</a>
    </form>
@endsection

@vite(['resources/js/submit_signup.js'])