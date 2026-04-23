<x-guest-layout>
<div class="min-h-screen flex items-center justify-center px-4
    bg-gradient-to-br from-blue-50 via-white to-indigo-50">

    <div class="w-full max-w-md bg-white border border-gray-100 rounded-2xl shadow-sm p-8">

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center text-lg font-bold shadow">
                ET
            </div>
        </div>

        <!-- Heading -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Create account</h2>
            <p class="text-sm text-gray-500 mt-1">Start managing your expenses</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm">
            @csrf

            <!-- Name -->
            <div class="relative">
    <input type="text" name="name" id="name" placeholder=" "
        value="{{ old('name') }}"
        class="peer w-full px-4 pt-5 pb-2 border rounded-lg
        focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
        required>

    <label for="name"
        class="absolute left-4 top-2 text-gray-400 text-sm transition-all
        peer-placeholder-shown:top-3.5
        peer-placeholder-shown:text-base
        peer-focus:top-2
        peer-focus:text-sm
        peer-focus:text-blue-600">
        Name
    </label>

    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
</div>

            <!-- Email -->
<div class="relative">
    <input type="email" name="email" id="email" placeholder=" "
        value="{{ old('email') }}"
        class="peer w-full px-4 pt-5 pb-2 border rounded-lg
        focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
        required>

    <label for="email"
        class="absolute left-4 top-2 text-gray-400 text-sm transition-all
        peer-placeholder-shown:top-3.5
        peer-placeholder-shown:text-base
        peer-focus:top-2
        peer-focus:text-sm
        peer-focus:text-blue-600">
        Email
    </label>

    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
</div>

            <!-- Password -->
<div class="space-y-2">

    <!-- Input Wrapper ONLY -->
    <div class="relative">

        <input type="password" name="password" id="regPassword" placeholder=" "
            class="peer w-full px-4 pr-10 pt-5 pb-2 border rounded-lg
            focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
            required>

        <label for="regPassword"
            class="absolute left-4 top-2 text-gray-400 text-sm transition-all
            peer-placeholder-shown:top-3.5
            peer-placeholder-shown:text-base
            peer-focus:top-2
            peer-focus:text-sm
            peer-focus:text-blue-600">
            Password
        </label>

        <!-- ✅ PERFECTLY ALIGNED ICON -->
        <button type="button" onclick="toggleRegPassword(event)"
            class="absolute right-3 top-1/2 -translate-y-1/2
            text-gray-400 hover:text-gray-600 transition">
            👁️
        </button>

    </div>

    <!-- Strength (OUTSIDE input wrapper) -->
    <div id="strengthWrapper" class="hidden">
        <div class="h-1.5 w-full bg-gray-200 rounded overflow-hidden">
            <div id="strengthBar" class="h-full w-0 transition-all duration-300"></div>
        </div>
        <p id="strengthText" class="text-xs mt-1 font-medium"></p>
    </div>

    <!-- Error -->
    <x-input-error :messages="$errors->get('password')" class="text-xs text-red-500" />

</div>

            <!-- Confirm Password -->
<div class="relative">
    <input type="password" name="password_confirmation" id="confirmPassword" placeholder=" "
        class="peer w-full px-4 pt-5 pb-2 border rounded-lg
        focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
        required>

    <label for="confirmPassword"
        class="absolute left-4 top-2 text-gray-400 text-sm transition-all
        peer-placeholder-shown:top-3.5
        peer-placeholder-shown:text-base
        peer-focus:top-2
        peer-focus:text-sm
        peer-focus:text-blue-600">
        Confirm Password
    </label>

    <!-- Match indicator -->
    <p id="matchText" class="text-xs mt-1"></p>
</div>

            <!-- Button -->
            <button type="submit" id="registerBtn"
                class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition font-medium flex items-center justify-center gap-2">
                
                <span id="regText">Register</span>

                <svg id="regSpinner" class="hidden w-4 h-4 animate-spin" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"/>
                </svg>
            </button>

            <!-- Login -->
            <p class="text-sm text-center text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
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
    const matchText = document.getElementById('matchText');
    const wrapper = document.getElementById('strengthWrapper');

    // 🔐 Toggle Password
    window.toggleRegPassword = function (e) {
        const btn = e.target;
        const input = document.getElementById('regPassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            btn.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            btn.textContent = '👁️';
        }
    };

    // 💪 Password Strength
    passwordInput.addEventListener('input', () => {
        const val = passwordInput.value;

        if (val.length > 0) {
            wrapper.classList.remove('hidden');
        } else {
            wrapper.classList.add('hidden');
        }

        let score = 0;

        if (val.length >= 6) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const widths = ['25%', '50%', '75%', '100%'];
        const colors = ['bg-red-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong'];

        if (score === 0) {
            bar.style.width = '0%';
            bar.className = 'h-full w-0';
            text.textContent = '';
            return;
        }

        bar.style.width = widths[score - 1];
        bar.className = `h-full transition-all duration-300 ${colors[score - 1]}`;
        text.textContent = labels[score - 1];
        text.className = `text-xs mt-1 font-medium ${colors[score - 1].replace('bg', 'text')}`;
    });

    // ✅ Confirm Password Match
    confirmInput.addEventListener('input', () => {
        if (!confirmInput.value) {
            matchText.textContent = '';
            return;
        }

        if (confirmInput.value === passwordInput.value) {
            matchText.textContent = 'Passwords match';
            matchText.className = 'text-xs text-green-500 mt-1';
        } else {
            matchText.textContent = 'Passwords do not match';
            matchText.className = 'text-xs text-red-500 mt-1';
        }
    });

    // ⏳ Loading Spinner
    document.getElementById('registerForm').addEventListener('submit', function () {
        document.getElementById('regText').textContent = 'Creating...';
        document.getElementById('regSpinner').classList.remove('hidden');
    });

});
</script>


</x-guest-layout>