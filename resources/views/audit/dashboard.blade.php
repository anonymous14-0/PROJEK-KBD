<x-app-layout>
    <header class="bg-white py-6 px-10 shadow-sm border-b border-gray-100">
        <h2 class="font-black text-xl text-gray-900 leading-tight uppercase tracking-tight">
            PUSAT AUDIT SISTEM INFORMASI AKADEMIK
        </h2>
    </header>

    <div class="py-12 bg-[#f3f4f6] min-h-screen font-sans">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-[0_10px_50px_rgba(0,0,0,0.08)] rounded-[2rem] min-h-[600px] border-t-8 border-white">
                <div class="p-10 md:p-16">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-4xl font-extrabold font-serif text-[#f87171] tracking-tight italic">
                            Log Aktivitas Seluruh Pengguna
                        </h3>
                        <div class="bg-[#fecaca] text-[#ef4444] px-6 py-2 rounded-md font-bold text-sm tracking-widest uppercase opacity-80">
                            Mode Pengawas
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-xl border border-gray-200 shadow-2xl">
                        <table class="w-full text-center border-collapse">
                            <thead>
                                <tr class="bg-[#7c9aff] text-white font-mono uppercase tracking-wider text-lg border-b border-gray-300">
                                    <th class="py-5 border-r border-blue-300 w-[18%]">Waktu</th>
                                    <th class="py-5 border-r border-blue-300 w-[20%]">User</th>
                                    <th class="py-5 border-r border-blue-300 w-[10%]">Role</th>
                                    <th class="py-5 border-r border-blue-300 w-[15%]">IP Address</th>
                                    <th class="py-5 w-[37%]">Deskripsi Aktivitas</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 font-medium text-sm">
                                @forelse($logs as $log)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition even:bg-gray-50/50">
                                        <td class="py-4 border-r border-gray-200 font-mono text-xs">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="py-4 border-r border-gray-200 text-gray-800">{{ $log->user->nama_lengkap ?? 'System' }}</td>
                                        <td class="py-4 border-r border-gray-200">
                                            <span class="bg-[#fce7f3] text-[#be185d] px-4 py-1 rounded font-bold text-[10px] uppercase">
                                                {{ $log->user->role ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="py-4 border-r border-gray-200 font-mono text-xs">{{ $log->ip_address ?? '-' }}</td>
                                        <td class="py-4 text-left px-8"><span class="whitespace-pre-line">{{ $log->aktivitas }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 italic text-gray-400">Belum ada log aktivitas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@1,700&display=swap');
        .font-serif {
            font-family: 'Crimson Pro', serif;
        }
    </style>
</x-app-layout>
