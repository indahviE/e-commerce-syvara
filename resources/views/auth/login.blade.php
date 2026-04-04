<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
<div class="min-h-screen bg-white flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-6xl">
        <!-- Container -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-0 items-center">

            <!-- Left Side - Hero Section -->
            <div class="hidden lg:flex flex-col justify-center items-center bg-gradient-to-br from-gray-900 to-gray-800 rounded-l-3xl p-12 min-h-[600px]">
                <div class="text-center">
                    <div class="mb-8">
                        <svg class="w-20 h-20 mx-auto text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm-5-9h10v2H7z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Your beauty journey starts here!</h1>
                    <p class="text-gray-400 text-lg">Temukan skincaremu di Syvara!</p>

                    <!-- Floating Circle -->
                    <div class="mt-12 relative h-40 w-40 mx-auto">
                        <div class="absolute inset-0 bg-pink-500 rounded-full opacity-20 blur-3xl animate-pulse"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 bg-pink-500 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="bg-white lg:bg-gray-50 rounded-3xl lg:rounded-r-3xl p-8 sm:p-12 lg:rounded-l-none shadow-xl lg:shadow-none lg:min-h-[600px] flex flex-col justify-center">

                <!-- Session Status -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                        <div class="text-red-800 font-semibold">{{ __('Error') }}</div>
                        <ul class="text-red-700 text-sm mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome back to Scanova</h2>
                    <p class="text-gray-600">Sign in to your account to continue</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                            {{ __('Email') }}
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="name@example.com"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all duration-200 @error('email') border-red-500 @enderror"
                        />
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                            {{ __('Password') }}
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 outline-none transition-all duration-200 @error('password') border-red-500 @enderror"
                        />
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500 cursor-pointer"
                            />
                            <span class="ms-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm text-pink-600 hover:text-pink-700 font-semibold transition-colors"
                            >
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-lg mt-8"
                    >
                        {{ __('Login') }}
                    </button>

                    <!-- Sign Up Link -->
                    @if (Route::has('register'))
                        <p class="text-center text-gray-600 text-sm">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}" class="text-pink-600 hover:text-pink-700 font-semibold transition-colors">
                                {{ __('Sign up') }}
                            </a>
                        </p>
                    @endif
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
