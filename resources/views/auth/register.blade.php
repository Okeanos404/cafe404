<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - CAFE 404</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @keyframes floaty {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-floaty { animation: floaty 3s ease-in-out infinite; }

        @keyframes fadeSlideIn {
            0% { opacity: 0; transform: translateY(14px) scale(0.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-fade-slide { animation: fadeSlideIn .6s ease forwards; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#0b0b0f] via-[#111827] to-[#000000] flex items-center justify-center p-6 text-white">

    <!-- Background Decoration -->
    <div class="fixed inset-0 opacity-30 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-orange-500 blur-[90px]"></div>
        <div class="absolute top-40 -right-24 w-96 h-96 rounded-full bg-yellow-400 blur-[120px]"></div>
        <div class="absolute -bottom-24 left-1/2 -translate-x-1/2 w-[520px] h-[520px] rounded-full bg-cyan-500 blur-[150px]"></div>
    </div>

    <!-- Card -->
    <div class="relative w-full max-w-md animate-fade-slide">
        <div class="bg-white/10 border border-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden">

            <!-- Top Branding -->
            <div class="p-8 pb-6 bg-gradient-to-r from-white/10 to-transparent border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold tracking-wide flex items-center gap-3">
                            <span class="text-2xl">☕</span>
                            <span>CAFE 404</span>
                        </h1>
                        <p class="text-sm text-gray-300 mt-2">
                            Buat akun baru dan mulai order favoritmu ✨
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-2xl bg-white/10 flex items-center justify-center animate-floaty">
                        <i class="fa-solid fa-user-plus text-yellow-300"></i>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8 text-white">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-sm text-gray-200 mb-2">Nama</label>
                        <div class="relative">
                            <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-white/50"></i>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="nama kamu"
                                class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white/10 border border-white/10
                                       focus:outline-none focus:ring-2 focus:ring-orange-400/60"
                            >
                        </div>
                        @error('name')
                            <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm text-gray-200 mb-2">Email</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-white/50"></i>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="contoh: riyan@gmail.com"
                                class="w-full pl-11 pr-4 py-3 rounded-2xl bg-white/10 border border-white/10
                                       focus:outline-none focus:ring-2 focus:ring-orange-400/60"
                            >
                        </div>
                        @error('email')
                            <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm text-gray-200 mb-2">Password</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-white/50"></i>

                            <input
                                id="registerPassword"
                                type="password"
                                name="password"
                                required
                                placeholder="buat password"
                                class="w-full pl-11 pr-12 py-3 rounded-2xl bg-white/10 border border-white/10
                                       focus:outline-none focus:ring-2 focus:ring-orange-400/60"
                            >

                            <button
                                type="button"
                                id="toggleRegisterPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-xl
                                       bg-white/10 hover:bg-white/20 border border-white/10 transition flex items-center justify-center"
                                aria-label="Toggle password"
                            >
                                <i id="iconRegisterPassword" class="fa-solid fa-eye text-white/70"></i>
                            </button>
                        </div>

                        @error('password')
                            <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm text-gray-200 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <i class="fa-solid fa-key absolute left-4 top-1/2 -translate-y-1/2 text-white/50"></i>

                            <input
                                id="registerConfirmPassword"
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="ulangin password"
                                class="w-full pl-11 pr-12 py-3 rounded-2xl bg-white/10 border border-white/10
                                       focus:outline-none focus:ring-2 focus:ring-orange-400/60"
                            >

                            <button
                                type="button"
                                id="toggleRegisterConfirmPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-xl
                                       bg-white/10 hover:bg-white/20 border border-white/10 transition flex items-center justify-center"
                                aria-label="Toggle password confirmation"
                            >
                                <i id="iconRegisterConfirmPassword" class="fa-solid fa-eye text-white/70"></i>
                            </button>
                        </div>

                        @error('password_confirmation')
                            <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full py-3 rounded-2xl font-semibold shadow-lg transition
                               bg-gradient-to-r from-orange-500 to-yellow-400 text-black hover:opacity-90">
                        <i class="fa-solid fa-user-plus"></i> Buat Akun
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-sm text-gray-300">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">
                            Login
                        </a>
                    </p>
                </form>

                <div class="mt-6 text-xs text-gray-400 text-center">
                    Dengan daftar, kamu otomatis jadi <b class="text-white">Customer</b> ✅
                </div>
            </div>
        </div>
    </div>

<script>
    function setupToggle(inputId, buttonId, iconId) {
        const input = document.getElementById(inputId);
        const btn = document.getElementById(buttonId);
        const icon = document.getElementById(iconId);

        btn.addEventListener('click', () => {
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';

            icon.classList.toggle('fa-eye', !isHidden);
            icon.classList.toggle('fa-eye-slash', isHidden);
        });
    }

    setupToggle('registerPassword', 'toggleRegisterPassword', 'iconRegisterPassword');
    setupToggle('registerConfirmPassword', 'toggleRegisterConfirmPassword', 'iconRegisterConfirmPassword');
</script>

</body>
</html>
