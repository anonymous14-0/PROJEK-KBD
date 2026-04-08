<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log Aktivitas Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr class="border border-gray-300 block md:table-row">
                            <th class="p-2 text-left font-bold md:border md:border-grey-500 block md:table-cell">Waktu</th>
                            <th class="p-2 text-left font-bold md:border md:border-grey-500 block md:table-cell">Pelaku</th>
                            <th class="p-2 text-left font-bold md:border md:border-grey-500 block md:table-cell">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                        @foreach($logs as $log)
                        <tr class="bg-white border border-gray-300 block md:table-row">
                            <td class="p-2 md:border md:border-grey-500 block md:table-cell">{{ $log->created_at }}</td>
                            <td class="p-2 md:border md:border-grey-500 block md:table-cell font-semibold">{{ $log->user->nama_lengkap ?? 'System' }}</td>
                            <td class="p-2 md:border md:border-grey-500 block md:table-cell">{{ $log->aktivitas }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>