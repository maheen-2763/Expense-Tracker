<x-guest-layout>
<div class="min-h-screen flex items-center justify-center px-4 bg-gray-50">

    <!-- Card -->
    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-10 h-10 bg-black text-white rounded-xl flex items-center justify-center font-semibold">
                ET
            </div>
        </div>

        <!-- Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

            <h2 class="text-2xl font-semibold text-gray-900 text-center">
                Welcome back
            </h2>
            <p class="text-sm text-gray-500 text-center mt-1 mb-6">
                Sign in to continue
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
                @csrf

                <!-- Email -->
               <div class="relative">
    <input id="email" type="email" name="email" required placeholder=" "
        class="peer w-full px-4 pt-5 pb-2 border border-gray-200 rounded-lg
        focus:ring-2 focus:ring-black focus:border-black transition bg-white">

    <label class="absolute left-4 top-2 text-gray-400 text-sm transition-all
        peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base
        peer-focus:top-2 peer-focus:text-sm peer-focus:text-black">
        Email address
    </label>
    <x-input-error :messages="$errors->get('email')" class="text-xs text-red-500 mt-1" />

</div>


                <!-- Password -->
               <div class="relative">
    <input id="regPassword" type="password" name="password" required placeholder=" "
        class="peer w-full px-4 pr-10 pt-5 pb-2 border border-gray-200 rounded-lg
        focus:ring-2 focus:ring-black focus:border-black transition bg-white">

    <label class="absolute left-4 top-2 text-gray-400 text-sm transition-all
        peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-base
        peer-focus:top-2 peer-focus:text-sm peer-focus:text-black">
        Password
    </label>

    <button type="button" onclick="togglePassword()"
        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black transition">

        <span id="eye-open">👁️</span>
        <span id="eye-slash" class="hidden">🙈</span>

    </button>
    <x-input-error :messages="$errors->get('password')" class="text-xs text-red-500 mt-1" />
</div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" class="rounded border-gray-300">
                        Remember me
                    </label>

                    <a href="{{ route('password.request') }}"
                       class="text-black hover:underline">
                        Forgot password?
                    </a>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-black text-white py-2.5 rounded-lg font-medium
                    hover:bg-gray-900 active:scale-[0.98] transition flex items-center justify-center gap-2">

                    <span id="btnText">Sign in</span>

                    <svg id="spinner" class="hidden w-4 h-4 animate-spin" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"/>
                    </svg>
                </button>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-4">
                    <div class="h-px bg-gray-200 flex-1"></div>
                    <span class="text-xs text-gray-400">OR</span>
                    <div class="h-px bg-gray-200 flex-1"></div>
                </div>

                <!-- Google -->
                <button type="button"
                    class="w-full border border-gray-300 py-2.5 rounded-lg text-sm hover:bg-gray-50 transition">
                    Continue with Google
                </button>

                <!-- Signup -->
                <p class="text-sm text-center text-gray-500 mt-4">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-black font-medium hover:underline">
                        Sign up
                    </a>
                </p>
            </form>

        </div>

        <!-- Footer -->
        <p class="text-xs text-center text-gray-400 mt-6">
            Secure authentication powered by Laravel
        </p>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('regPassword');
    const open = document.getElementById('eye-open');
    const close = document.getElementById('eye-slash');

    const isHidden = input.type === 'password';

    input.type = isHidden ? 'text' : 'password';

    open.classList.toggle('hidden');
    close.classList.toggle('hidden');
}

document.getElementById('loginForm').addEventListener('submit', () => {
    document.getElementById('btnText').textContent = 'Signing in...';
    document.getElementById('spinner').classList.remove('hidden');
});
</script>

</x-guest-layout>