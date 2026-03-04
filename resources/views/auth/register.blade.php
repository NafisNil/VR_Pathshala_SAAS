
<x-guest-layout title="Register">

     <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group mb-3">
            
            <x-text-input id="name" class="form-control" type="text" name="name" placeholder="Name" :value="old('name')" required autofocus autocomplete="name" />
            <div class="input-group-text">
                <span class="bi bi-person"></span>
              </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-group mb-3">
           
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
             <div class="input-group-text">
                <span class="bi bi-envelope"></span>
              </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
           

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required autocomplete="new-password" />
<div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
              </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="input-group mb-3">
           

            <x-text-input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirm Password"
                            required autocomplete="new-password" />
                          
<div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
              </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="btn btn-primary ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
