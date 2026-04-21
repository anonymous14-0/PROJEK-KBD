<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Audit Keamanan Basis Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-red-600">Log Aktivitas Seluruh Pengguna</h3>
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs font-bold uppercase">Mode Pengawasan</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-800 text-white">
                                    <th class="p-3 border">Waktu</th>
                                    <th class="p-3 border">User</th>
                                    <th class="p-3 border">Role</th>
                                    <th class="p-3 border">Aktivitas / Query</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="p-3 text-sm text-gray-600">{{ $log->created_at }}</td>
                                    <td class="p-3 font-medium text-blue-600">{{ $log->user->nama_lengkap }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded text-xs {{ $log->user->role == 'admin' ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ strtoupper($log->user->role) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-sm italic">"{{ $log->aktivitas }}"</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>