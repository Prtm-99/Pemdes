<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Animasi untuk logo */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .logo {
            animation: float 3s ease-in-out infinite;
        }

        /* Efek hover untuk card */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Efek hover untuk tombol */
        .btn-primary {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2563eb; /* Warna biru yang lebih gelap */
            transform: translateY(-2px);
        }

        /* Efek untuk input saat fokus */
        .input-group:focus-within {
            border-color: #60a5fa; /* Warna biru yang lebih terang */
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.5);
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md">
        <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-6">
                    <img class="logo mx-auto" src="{{ url('/storage/Logo0.png') }}" alt="logo" style="height: 100px;">
                </div>
                <h2 class="text-center text-2xl font-bold text-gray-800">Selamat Datang</h2>
                <p class="text-center text-gray-600 mb-6">Silakan masuk untuk melanjutkan</p>
                <form action="{{ route('masuk') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                        <div class="input-group flex items-center border rounded-lg overflow-hidden">
                            <span class="px-3 py-2 bg-gray-100 text-gray-500"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan email" required>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <div class="input-group flex items-center border rounded-lg overflow-hidden">
                            <span class="px-3 py-2 bg-gray-100 text-gray-500"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password"
                                class="w-full px-3 py-2 outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan password" required>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="spinner hidden animate-spin"></span>
                        <span>Masuk</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const submitButton = form.querySelector('button[type="submit"]');
            const spinner = submitButton.querySelector('.spinner');

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                spinner.classList.remove('hidden');
                submitButton.querySelector('span:last-child').textContent = 'Memproses...';
            });
        });
    </script>
</body>
</html>