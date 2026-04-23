<x-guest-layout>
<div class="min-h-screen flex items-center justify-center px-6 bg-white">

    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <div class="w-10 h-10 border border-gray-200 rounded-md flex items-center justify-center text-sm font-semibold text-gray-800">
                ET
            </div>
        </div>

        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-xl font-medium text-gray-900">Create account</h2>
            <p class="text-sm text-gray-500 mt-1">Start managing your expenses</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerForm">
            @csrf

            <!-- Name -->
            <div>
                <input type="text" name="name" id="name" placeholder="Name"
                    value="{{ old('name') }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm
                    focus:outline-none focus:border-gray-400 transition"
                    required>
                <x-input-error :messages="$errors->get('name')" class="text-xs text-red-500 mt-1" />
            </div>

            <!-- Email -->
            <div>
                <input type="email" name="email" id="email" placeholder="Email"
                    value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm
                    focus:outline-none focus:border-gray-400 transition"
                    required>
                <x-input-error :messages="$errors->get('email')" class="text-xs text-red-500 mt-1" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="relative">
                    <input type="password" name="password" id="regPassword" placeholder="Password"
                        class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm pr-10
                        focus:outline-none focus:border-gray-400 transition"
                        required>

                    <button type="button" onclick="toggleRegPassword(event)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        👁
                    </button>
                </div>

                <!-- Strength -->
                <div id="strengthWrapper" class="hidden">
                    <div class="h-1 w-full bg-gray-100 rounded">
                        <div id="strengthBar" class="h-full w-0 transition-all"></div>
                    </div>
                    <p id="strengthText" class="text-xs mt-1 text-gray-500"></p>
                </div>

                <x-input-error :messages="$errors->get('password')" class="text-xs text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div>
                <input type="password" name="password_confirmation" id="confirmPassword"
                    placeholder="Confirm password"
                    class="w-full px-3 py-2 border border-gray-200 rounded-md text-sm
                    focus:outline-none focus:border-gray-400 transition"
                    required>

                <p id="matchText" class="text-xs mt-1"></p>
            </div>

            <!-- Button -->
            <button type="submit" id="registerBtn"
                class="w-full bg-black text-white py-2 rounded-md text-sm font-medium hover:bg-gray-900 transition flex items-center justify-center gap-2">

                <span id="regText">Register</span>

                <svg id="regSpinner" class="hidden w-4 h-4 animate-spin" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="3" fill="none"/>
                </svg>
            </button>

            <!-- Login -->
            <p class="text-xs text-center text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-black underline">
                    Login
                </a>
            </p>
        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const passwordInput = document.getElementById('regPassword');
    const confirmInput = document.getElementById('confirmPassword');
    const bar = document.getElementById('strengthBar');
    const text = document.getElementById('strengthText');
    const wrapper = document.getElementById('strengthWrapper');
    const matchText = document.getElementById('matchText');

    window.toggleRegPassword = function (e) {
        const btn = e.target;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            btn.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            btn.textContent = '👁';
        }
    };

    passwordInput.addEventListener('input', () => {
        const val = passwordInput.value;

        if (!val) {
            wrapper.classList.add('hidden');
            return;
        }

        wrapper.classList.remove('hidden');

        let score = 0;
        if (val.length >= 6) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const widths = ['25%', '50%', '75%', '100%'];
        const colors = ['bg-red-400', 'bg-yellow-400', 'bg-blue-400', 'bg-green-500'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong'];

        bar.style.width = widths[score - 1] || '0%';
        bar.className = `h-full transition-all ${colors[score - 1] || ''}`;
        text.textContent = labels[score - 1] || '';
    });

    confirmInput.addEventListener('input', () => {
        if (!confirmInput.value) {
            matchText.textContent = '';
            return;
        }

        if (confirmInput.value === passwordInput.value) {
            matchText.textContent = 'Passwords match';
            matchText.className = 'text-xs text-green-600 mt-1';
        } else {
            matchText.textContent = 'Passwords do not match';
            matchText.className = 'text-xs text-red-500 mt-1';
        }
    });

    document.getElementById('registerForm').addEventListener('submit', function () {
        document.getElementById('regText').textContent = 'Creating...';
        document.getElementById('regSpinner').classList.remove('hidden');
    });

});
</script>

</x-guest-layout>