@extends('layouts.form')
@section('title', 'Signup')

@push('styles')
<style>
    .input-group:focus-within {
        transform: translateY(-1px);
    }
    .input-group:focus-within .input-icon {
        color: #3b82f6;
    }
    .password-strength {
        height: 3px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    .strength-weak { background: #ef4444; }
    .strength-medium { background: #f59e0b; }
    .strength-strong { background: #10b981; }
    .signup-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        transition: all 0.3s ease;
    }
    .signup-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }
    .google-btn {
        border: 2px solid #e5e7eb;
        transition: all 0.2s ease;
    }
    .google-btn:hover {
        border-color: #d1d5db;
        background-color: #f9fafb;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<form id="signup_form" class="w-100 flex flex-col gap-3">
    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-1">Create Account</h1>
        <p class="text-gray-600 text-sm">Join us today and get started</p>
    </div>
    
    <!-- Full Name -->
    <div class="flex flex-col gap-1">
        <label for="name" class="text-sm font-semibold text-gray-700">Full Name</label>
        <div class="input-group relative transition-all duration-200">
            <i class="input-icon fas fa-user absolute top-1/2 left-4 -translate-y-1/2 text-gray-400 text-lg transition-colors"></i>
            <input 
                id="name"
                name="name" 
                class="w-full border-2 rounded-2xl border-gray-200 outline-none text-md p-3 pl-12 focus:border-blue-500 transition-colors"
                type="text" 
                placeholder="Enter your full name"
            />
        </div>
        <span class="err name text-sm text-red-500 h-4"></span>
    </div>
    
    <!-- Email -->
    <div class="flex flex-col gap-1">
        <label for="email" class="text-sm font-semibold text-gray-700">Email Address</label>
        <div class="input-group relative transition-all duration-200">
            <i class="input-icon fas fa-envelope absolute top-1/2 left-4 -translate-y-1/2 text-gray-400 text-lg transition-colors"></i>
            <input 
                id="email"
                name="email" 
                class="w-full border-2 rounded-2xl border-gray-200 outline-none text-md p-3 pl-12 focus:border-blue-500 transition-colors"
                type="email" 
                placeholder="Enter your email"
            />
        </div>
        <span class="err email text-sm text-red-500 h-4"></span>
    </div>
    
    <!-- Password -->
    <div class="flex flex-col gap-1">
        <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
        <div class="input-group relative transition-all duration-200">
            <i class="input-icon fas fa-lock absolute top-1/2 left-4 -translate-y-1/2 text-gray-400 text-lg transition-colors"></i>
            <input 
                id="password"
                name="password" 
                class="w-full border-2 rounded-2xl border-gray-200 outline-none text-md p-3 pl-12 pr-12 focus:border-blue-500 transition-colors"
                type="password" 
                placeholder="Create a strong password"
            />
            <button type="button" id="togglePassword" class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        <div class="flex flex-col gap-1">
            <div class="password-strength w-full bg-gray-200 mt-1" id="passwordStrength"></div>
        </div>
        <span class="err password text-sm text-red-500 h-4"></span>
    </div>
    
    <!-- Confirm Password -->
    <div class="flex flex-col gap-1">
        <label for="confirmPassword" class="text-sm font-semibold text-gray-700">Confirm Password</label>
        <div class="input-group relative transition-all duration-200">
            <i class="input-icon fas fa-lock absolute top-1/2 left-4 -translate-y-1/2 text-gray-400 text-lg transition-colors"></i>
            <input 
                id="confirmPassword"
                name="confirmPassword" 
                class="w-full border-2 rounded-2xl border-gray-200 outline-none text-md p-3 pl-12 focus:border-blue-500 transition-colors"
                type="password" 
                placeholder="Confirm your password"
            />
        </div>
        <span class="err confirmPassword text-sm text-red-500 h-4"></span>
    </div>
    
    {{-- <!-- Remember Me -->
    <div class="flex items-center gap-3 mt-1">
        <input 
            id="remember" 
            name="remember" 
            type="checkbox" 
            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
        />
        <label for="remember" class="text-sm text-gray-700">Remember me</label>
    </div>
    
    <!-- Terms Checkbox -->
    <div class="flex items-start gap-3 mt-1">
        <input 
            id="terms" 
            name="terms" 
            type="checkbox" 
            class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
        />
        <label for="terms" class="text-sm text-gray-600">
            I agree to the <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Terms of Service</a> 
            and <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Privacy Policy</a>
        </label>
    </div> --}}
    
    <!-- Submit Button -->
    <div class="relative mt-4">
        <button type="submit"
            class="signup-btn bg-gray-800 flex items-center justify-center gap-2 w-full px-4 py-3 border-none text-white text-lg font-bold rounded-2xl cursor-pointer">
            <span id="btnText">Create Account</span>
        </button>
        <div class="indicator hidden absolute inset-0 flex items-center justify-center bg-gray-600 rounded-2xl" role="status">
            <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin fill-white mr-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="text-white">Creating account...</span>
        </div>
    </div>
    
    <!-- Divider -->
    <div class="flex items-center my-4">
        <div class="flex-1 border-t border-gray-300"></div>
        <span class="px-4 text-gray-500 text-sm">or continue with</span>
        <div class="flex-1 border-t border-gray-300"></div>
    </div>
    
    <!-- Google Sign Up -->
    <a href="/auth/redirect" class="google-btn flex items-center justify-center gap-3 w-full px-4 py-3 rounded-2xl font-medium text-gray-700 hover:text-gray-800">
        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-6 h-6" />
        <span>Sign up with Google</span>
    </a>
    
    <!-- Login Link -->
    <p class="text-center text-gray-600 mt-3">
        Already have an account? 
        <a class="text-blue-600 hover:text-blue-500 font-semibold transition-colors" href="/login">Sign in here</a>
    </p>
</form>

@endsection

@vite(['resources/js/submit_signup.js'])