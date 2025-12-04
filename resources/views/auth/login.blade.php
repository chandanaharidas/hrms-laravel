<x-guest-layout>
    <!-- Session Status-->
    <x-auth-session-status class="mb-4" :status="session('status')" /> 



    <form method="POST" action="{{ route('login') }}">
        @csrf
<h3 class="text-indigo-600 text-center font-bold text-2xl mb-6 tracking-wide uppercase">LOGIN</h3>
       

                          <!-- Role -->

        <div>
            <x-input-label for="role" value="Role" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md focus:ring-indigo-700" required autofocus autocomplete="username">
                <option value ="">Select Role</option>
                <option value ="Admin">Admin</option>
                <option value ="Employee">Employee</option>
            </select> 
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>


                          <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


                            <!-- Password -->

        <div class="mt-4">
            <x-input-label for="password" value="Password" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

                           <!-- Remember Me --> 
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

                       <!--Forgot Password Link -->        
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ ('Forgot your password?') }}
                </a>
            @endif

                      <!--Login Button -->
            <x-primary-button class="ml-3" >
                {{ ('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
