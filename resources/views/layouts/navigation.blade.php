<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <!-- justify-between akan memaksa elemen pertama ke kiri dan elemen terakhir ke kanan -->
        <div class="flex justify-between h-20"> 
            
            <!-- 1. GRUP KIRI: Logo & Nama Sekolah -->
            <!-- Kita tidak menggunakan flex-1 di sini agar dia hanya memakan ruang selebar isinya -->
            <div class="flex items-center space-x-4 shrink-0">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/LogosekolahK.jpeg') }}" alt="Logo" class="block h-12 w-auto object-contain" 
                             onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=S&background=1e4066&color=fff';">
                    </a>
                </div>
                <div class="flex flex-col justify-start uppercase">
                    <span class="font-Narnoor text-black-900 text-lg tracking-tighter leading-none">
                        SMA NEGERI 1 KEMIREN
                    </span>
                </div>
            </div>

            <!-- 2. GRUP TENGAH: Indikator Dashboard -->
            <!-- justify-center akan membuat teks "Dashboard" berada tepat di tengah-tengah navbar -->
            <div class="hidden md:flex flex-1 justify-start ms-20">
                <div class="border-b-4 border-blue-500 flex items-center px-6">
                    <span class="text-gray-400 font-Niramit uppercase text-xs tracking-[0.2em]">Dashboard</span>
                </div>
            </div>

            <!-- 3. GRUP KANAN: Profile & Dropdown -->
            <!-- shrink-0 memastikan bagian profil tidak tertekan/gepeng -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 shrink-0">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center space-x-3 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-bold text-gray-800 text-sm tracking-tight hidden lg:block">
                                {{ Auth::user()->nama_lengkap }}
                            </div>

                            <div class="relative">
                                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-100 shadow-sm hover:border-blue-400 transition-all">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=EBF4FF&color=7F9CF5" 
                                         alt="Profile" class="w-full h-full object-cover">
                                </div>
                            </div>

                            <svg class="fill-current h-4 w-4 text-blue-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 ...">
                   <!-- Ikon SVG tetap sama -->
                </button>
            </div>
        </div>
    </div>
</nav>