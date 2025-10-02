<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>SATUNAMA Training Center</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sanchez:ital@0;1&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Vite CSS & JS -->
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Select2 (tetap menggunakan jQuery untuk komponen ini) -->
    <script src="{{ asset('select2/dist/js/jquery.min.js') }}"></script>
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>

    <!-- Custom Tailwind Config -->
{{--    <script>--}}
{{--        tailwind.config = {--}}
{{--            theme: {--}}
{{--                extend: {--}}
{{--                    fontFamily: {--}}
{{--                        'body': ['Titillium Web', 'sans-serif'],--}}
{{--                        'heading': ['Sanchez', 'serif'],--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}

    <style>
        /* Custom styles untuk komponen yang tidak mudah dikonversi ke Tailwind */
        body {
            font-family: 'Titillium Web', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Sanchez', serif;
        }

        /* Scroll to top button custom styles */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid #346a32;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .scroll-to-top:hover {
            background-color: #346a32;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .scroll-to-top:hover svg {
            stroke: white;
        }

        .scroll-to-top svg {
            transition: stroke 0.3s ease;
        }

        /* WhatsApp floating button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 90px;
            right: 20px;
            background-color: #25d366;
            color: white;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #5c9e56;
            transform: scale(1.1);
        }

        .whatsapp-float i {
            margin-top: 16px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Modal backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Chat bubble styles */
        .chat-bubble {
            max-width: 80%;
            word-wrap: break-word;
        }

        .chat-bubble-user {
            background-color: #dcf8c6;
            margin-left: auto;
        }

        .chat-bubble-admin {
            background-color: #ffffff;
            border: 1px solid #e5e5ea;
        }

        @keyframes bounce-slow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse-slow {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .bg-image-overlay {
            background-image: url('/images/contact.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        .bg-image-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.85) 0%, rgba(21, 128, 61, 0.9) 100%);
            z-index: 1;
        }

        .bg-image-overlay > * {
            position: relative;
            z-index: 2;
        }

        * Modal backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Custom styles untuk button */
        .btn-login {
            background: linear-gradient(135deg, #438848 0%, #28a745 100%);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #357a3a 0%, #1e7e34 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 20px 0;
        }

        .divider:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e5e5;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #666;
            font-size: 14px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e5e5;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: #438848;
            background-color: #f8f9fa;
            color: #438848;
        }

        .btn-social i {
            margin-right: 8px;
            font-size: 18px;
        }

        .register-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .logo-img {
            max-width: 120px;
            height: auto;
        }
    </style>
</head>

<body class="font-body" data-bs-spy="scroll" data-bs-target="#navbar-example" data-bs-offset="0">

<!-- Loading Spinner -->
<div id="loading-spinner"
     class="flex justify-center items-center fixed top-0 left-0 w-full h-full bg-white bg-opacity-80 z-50">
    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500"></div>
    <span class="sr-only">Loading...</span>
</div>

<!-- Container untuk Navbar -->
@include('partials.navbar') <!-- Include Navbar -->


<!-- Dynamic Content Section -->
<div>
    @yield('content')
</div>

<!-- Modal Login -->
<div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-6 px-6">
            <!-- Header dengan tombol close -->
            <div class="flex justify-end">
                <button id="closeLoginModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <img src="{{ asset('images/stc.png') }}" alt="Hero Image"
                     class="mx-auto block logo-img mb-4">
                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email atau Username</label>
                        <div class="relative">
                            <input type="text"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                   placeholder="email@example.com / username" name="login">
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="passwordInput"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                   placeholder="Masukan Password anda" name="password">
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                  id="togglePassword">
                                    <i class="fas fa-eye text-gray-400"></i>
                                </span>
                        </div>
                    </div>

                    <input type="hidden" name="redirect_to" value="{{ url()->full() }}">

                    <div class="flex justify-between items-center mb-4">
                        <div class="hidden">
                            <input type="checkbox" id="remember" class="mr-2">
                            <label for="remember" class="text-gray-700">Remember me</label>
                        </div>
                        <button type="button" id="openForgotPasswordModal"
                                class="text-gren-500 hover:text-green-700 text-sm">
                            Lupa Password?
                        </button>
                    </div>

                    <button type="submit" class="btn-login text-white w-full mb-4">Masuk</button>

                    <div class="divider">
                        <span>atau gunakan akun</span>
                    </div>

                    <div class="social-login mb-4">
                        <a href="{{ route('auth.google') }}" class="btn-social">
                            <i class="fab fa-google"></i>Google
                        </a>
                    </div>

                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('daftar') }}" class="text-green-500 hover:underline">Daftar
                            Sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Lupa Password -->
<div id="forgotPasswordModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-6 px-6">
            <!-- Header dengan tombol close -->
            <div class="flex justify-end">
                <button id="closeForgotPasswordModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Gambar diperkecil -->
                <img src="{{ asset('images/stc.png') }}" alt="Hero Image"
                     class="mx-auto block logo-img mb-3" style="max-width: 100px;">

                <h5 class="text-center text-lg font-semibold mb-4">Reset Password</h5>

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email*</label>
                        <div class="relative">
                            <input type="text" name="email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                   placeholder="example@email.com" required>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fab fa-whatsapp text-gray-400"></i>
                                </span>
                        </div>
                    </div>
                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium">
                        Kirim
                    </button>
                </form>

                <div class="text-center mt-4">
                    <button id="backToLoginModal" class="text-green-500 hover:text-green-700">
                        Kembali ke Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
<div id="alertContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" class="scroll-to-top flex justify-center items-center">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#008b8b" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>

<!-- WhatsApp Floating Button -->
<div class="whatsapp-float" id="whatsappBtn">
    <i class="fab fa-whatsapp"></i>
</div>

<!-- WhatsApp Chat Modal -->
<div id="whatsappModal" class="fixed inset-0 z-50 hidden">
    <!-- Modal backdrop -->
    <div class="modal-backdrop fixed inset-0" id="modalBackdrop"></div>

    <!-- Modal content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all">
            <!-- Modal header -->
            <div
                class="bg-gradient-to-r from-green-600 to-green-500 text-white p-4 rounded-t-xl flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-base">SATUNAMA Training Center</h3>
                        <p class="text-green-100 text-xs">Online • Biasanya membalas cepat</p>
                    </div>
                </div>
                <button id="closeModal" class="text-white hover:text-gray-200 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Chat area -->
            <div class="p-3 h-64 overflow-y-auto bg-gray-50 chat-scroll" id="chatArea">
                <!-- Welcome message -->
                <div class="mb-3">
                    <div class="chat-bubble chat-bubble-admin rounded-lg p-2.5 shadow-sm">
                        <p class="text-xs">👋 Halo! Selamat datang di Training Center.</p>
                        <p class="text-xs mt-1">Ada yang ingin dikonsultasikan seputar pelatihan?</p>
                        <span class="text-xs text-gray-500 mt-1.5 block">Baru saja</span>
                    </div>
                </div>
            </div>

            <!-- Quick action buttons -->
            <div class="p-3 border-t border-gray-200">
                <div class="space-y-2 mb-3">
                    <button
                        class="quick-action-btn w-full text-left p-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-xs flex items-center space-x-2">
                        <span class="text-sm">📚</span>
                        <span>Info program pelatihan</span>
                    </button>
                    <button
                        class="quick-action-btn w-full text-left p-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-xs flex items-center space-x-2">
                        <span class="text-sm">💼</span>
                        <span>Konsultasi tentang pelatihan</span>
                    </button>
                    <button
                        class="quick-action-btn w-full text-left p-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-xs flex items-center space-x-2">
                        <span class="text-sm">📅</span>
                        <span>Jadwal & biaya pelatihan</span>
                    </button>
                </div>
            </div>

            <!-- Input area -->
            <div class="p-3 border-t border-gray-200">
                <div class="flex space-x-2">
                    <input type="text" id="messageInput"
                           placeholder="Ketik pesan Anda..."
                           class="flex-1 border border-gray-300 rounded-full px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <button id="sendMessage"
                            class="bg-green-500 text-white rounded-full px-3 py-1.5 hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-100 p-3 rounded-b-xl text-center">
                <button id="openWhatsApp"
                        class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-700 transition-colors font-medium text-xs">
                    <i class="fab fa-whatsapp mr-1.5"></i>
                    Lanjutkan di WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Include Footer -->
@include('partials.footer')

<!-- JavaScript -->
<script>
    // Loading spinner functionality
    window.onload = function () {
        const spinner = document.getElementById("loading-spinner");
        setTimeout(() => {
            spinner.classList.add("hidden");
        }, 500);
    };

    // Scroll to Top functionality
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

    window.onscroll = function () {
        scrollToTopBtn.style.display = document.documentElement.scrollTop > 100 ? "block" : "none";
    };

    function scrollToTop() {
        const currentPosition = window.pageYOffset;
        if (currentPosition > 0) {
            window.requestAnimationFrame(scrollToTop);
            window.scrollTo(0, currentPosition - currentPosition / 10);
        }
    }

    scrollToTopBtn.addEventListener("click", scrollToTop);

    // WhatsApp Modal functionality
    const whatsappBtn = document.getElementById("whatsappBtn");
    const whatsappModal = document.getElementById("whatsappModal");
    const closeModal = document.getElementById("closeModal");
    const modalBackdrop = document.getElementById("modalBackdrop");
    const messageInput = document.getElementById("messageInput");
    const sendMessage = document.getElementById("sendMessage");
    const chatArea = document.getElementById("chatArea");
    const openWhatsApp = document.getElementById("openWhatsApp");

    // Configuration - Ganti dengan nomor WhatsApp Anda
    const whatsappNumber = "6282226887110"; // Ganti dengan nomor WhatsApp Anda (format: 62xxx)
    const companyName = "STC";

    // Open modal
    whatsappBtn.addEventListener("click", function () {
        whatsappModal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
        messageInput.focus();
    });

    // Close modal
    function closeWhatsappModal() {
        whatsappModal.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    }

    closeModal.addEventListener("click", closeWhatsappModal);
    modalBackdrop.addEventListener("click", closeWhatsappModal);

    // Close modal with Escape key
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape" && !whatsappModal.classList.contains("hidden")) {
            closeWhatsappModal();
        }
    });

    // Quick action buttons
    document.querySelectorAll(".quick-action-btn").forEach(button => {
        button.addEventListener("click", function () {
            const message = this.textContent.trim();
            addMessageToChat(message, true);

            // Auto response after 1 second
            setTimeout(() => {
                let response = "";
                if (message.includes("program pelatihan")) {
                    response = "Kami menyediakan berbagai program pelatihan:\n\n• Sekolah Politik \n• Monitoring, Evaluasi dan Learning\n• Kesehatan Jiwa\n• Penyusunan proposal\n\nMau info lebih detail program mana yang Anda minati?";
                } else if (message.includes("tentang pelatihan")) {
                    response = "Layanan konsultasi kami meliputi:\n\n• Pengembangan Karir\n• Analisis Kebutuhan Training\n• Coaching & Mentoring\n\nSilakan ceritakan kebutuhan spesifik Anda!";
                } else if (message.includes("biaya pelatihan")) {
                    response = "Untuk info jadwal dan biaya pelatihan:\n\n📅 Jadwal: Tersedia setiap bulan\n💰 Biaya: Bervariasi per program\n🎯 Batch: Regular & Permintaan\n📍 Lokasi: Online & Offline\n\nProgram mana yang ingin Anda ketahui detailnya?";
                }
                addMessageToChat(response, false);
            }, 1200);
        });
    });

    // Send message function
    function sendMessageFunction() {
        const message = messageInput.value.trim();
        if (message) {
            addMessageToChat(message, true);
            messageInput.value = "";

            // Auto response after 1 second
            setTimeout(() => {
                addMessageToChat("Terima kasih atas pesan Anda! Untuk respon yang lebih cepat, silakan lanjutkan percakapan di WhatsApp dengan klik tombol di bawah.", false);
            }, 1000);
        }
    }

    // Send message event listeners
    sendMessage.addEventListener("click", sendMessageFunction);
    messageInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessageFunction();
        }
    });

    // Add message to chat
    function addMessageToChat(message, isUser) {
        const messageDiv = document.createElement("div");
        messageDiv.className = "mb-4";

        const now = new Date();
        const timeString = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

        if (isUser) {
            messageDiv.innerHTML = `
                    <div class="chat-bubble chat-bubble-user rounded-lg p-3 shadow-sm">
                        <p class="text-sm">${message}</p>
                        <span class="text-xs text-gray-600 mt-2 block text-right">${timeString}</span>
                    </div>
                `;
        } else {
            messageDiv.innerHTML = `
                    <div class="chat-bubble chat-bubble-admin rounded-lg p-3 shadow-sm">
                        <p class="text-sm">${message.replace(/\n/g, '<br>')}</p>
                        <span class="text-xs text-gray-500 mt-2 block">${timeString}</span>
                    </div>
                `;
        }

        chatArea.appendChild(messageDiv);
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    // Open WhatsApp
    openWhatsApp.addEventListener("click", function () {
        // Get all messages from chat
        const messages = [];
        const chatBubbles = chatArea.querySelectorAll(".chat-bubble");

        chatBubbles.forEach(bubble => {
            const messageText = bubble.querySelector("p").textContent;
            const isUser = bubble.classList.contains("chat-bubble-user");

            if (isUser) {
                messages.push("Saya: " + messageText);
            } else if (!messageText.includes("Halo! Selamat datang")) {
                messages.push("CS: " + messageText);
            }
        });

        // Create WhatsApp message
        let whatsappMessage = `Halo ${companyName}! Saya ingin melanjutkan percakapan dari website.`;

        if (messages.length > 0) {
            whatsappMessage += "\n\nRiwayat chat:\n" + messages.join("\n");
        }

        // Open WhatsApp
        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`;
        window.open(whatsappUrl, "_blank");

        // Close modal
        closeWhatsappModal();
    });

    // Modal functionality
    const loginModal = document.getElementById('loginModal');
    const forgotPasswordModal = document.getElementById('forgotPasswordModal');

    // Elements untuk membuka login modal
    const loginBtn = document.getElementById('loginBtn');
    const loginBtnMain = document.getElementById('loginBtnMain');

    // Elements untuk menutup modals
    const closeLoginModal = document.getElementById('closeLoginModal');
    const closeForgotPasswordModal = document.getElementById('closeForgotPasswordModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const forgotModalOverlay = document.getElementById('forgotModalOverlay');

    // Elements untuk navigasi antar modal
    const openForgotPasswordModal = document.getElementById('openForgotPasswordModal');
    const backToLoginModal = document.getElementById('backToLoginModal');

    // Password toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    // Open login modal
    function openLoginModal() {
        loginModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // Focus pada input pertama
        setTimeout(() => {
            const firstInput = loginModal.querySelector('input[name="login"]');
            if (firstInput) firstInput.focus();
        }, 300);

        showAlert('Modal login terbuka', 'info');
    }

    // Close login modal
    function closeLoginModalFunction() {
        loginModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        showAlert('Modal login ditutup', 'info');
    }

    // Open forgot password modal
    function openForgotPasswordModalFunction() {
        loginModal.classList.add('hidden');
        forgotPasswordModal.classList.remove('hidden');

        // Focus pada input nomor HP
        setTimeout(() => {
            const hpInput = forgotPasswordModal.querySelector('input[name="no_hp"]');
            if (hpInput) hpInput.focus();
        }, 300);

        showAlert('Modal reset password terbuka', 'info');
    }

    // Close forgot password modal
    function closeForgotPasswordModalFunction() {
        forgotPasswordModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        showAlert('Modal reset password ditutup', 'info');
    }

    // Back to login modal
    function backToLoginModalFunction() {
        forgotPasswordModal.classList.add('hidden');
        loginModal.classList.remove('hidden');
        showAlert('Kembali ke modal login', 'info');
    }

    // Event listeners
    if (loginBtn) loginBtn.addEventListener('click', openLoginModal);
    if (loginBtnMain) loginBtnMain.addEventListener('click', openLoginModal);

    if (closeLoginModal) closeLoginModal.addEventListener('click', closeLoginModalFunction);
    if (closeForgotPasswordModal) closeForgotPasswordModal.addEventListener('click', closeForgotPasswordModalFunction);

    if (modalOverlay) modalOverlay.addEventListener('click', closeLoginModalFunction);
    if (forgotModalOverlay) forgotModalOverlay.addEventListener('click', closeForgotPasswordModalFunction);

    if (openForgotPasswordModal) openForgotPasswordModal.addEventListener('click', openForgotPasswordModalFunction);
    if (backToLoginModal) backToLoginModal.addEventListener('click', backToLoginModalFunction);

    // Password toggle functionality
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    }

    // Close modal dengan escape key
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (!forgotPasswordModal.classList.contains('hidden')) {
                closeForgotPasswordModalFunction();
            } else if (!loginModal.classList.contains('hidden')) {
                closeLoginModalFunction();
            }
        }
    });

    // Form submissions
    const loginForm = document.getElementById('loginForm');
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const login = formData.get('login');
            const password = formData.get('password');

            // Validasi sederhana
            if (!login || !password) {
                showAlert('Mohon lengkapi semua field', 'error');
                return;
            }

            // Simulasi proses login
            showAlert('Sedang memproses login...', 'info');

            setTimeout(() => {
                // Simulasi login berhasil
                showAlert('Login berhasil! Selamat datang.', 'success');
                closeLoginModalFunction();

                // Reset form
                this.reset();
            }, 2000);
        });
    }

    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const noHp = formData.get('no_hp');

            // Validasi nomor HP
            if (!noHp) {
                showAlert('Mohon masukkan nomor WhatsApp', 'error');
                return;
            }

            // Validasi format nomor HP Indonesia
            if (!noHp.match(/^(08|8|\+62)[0-9]{8,11}$/)) {
                showAlert('Format nomor WhatsApp tidak valid', 'error');
                return;
            }

            // Simulasi proses kirim
            showAlert('Mengirim link reset password...', 'info');

            setTimeout(() => {
                showAlert('Link reset password berhasil dikirim ke WhatsApp!', 'success');
                closeForgotPasswordModalFunction();

                // Reset form
                this.reset();
            }, 2000);
        });
    }

    // Console log untuk debugging
    // console.log('Login modal system initialized');
    // console.log('Available elements:', {
    //     loginModal: !!loginModal,
    //     forgotPasswordModal: !!forgotPasswordModal,
    //     loginBtn: !!loginBtn,
    //     loginBtnMain: !!loginBtnMain
    // });
</script>
</body>

</html>
