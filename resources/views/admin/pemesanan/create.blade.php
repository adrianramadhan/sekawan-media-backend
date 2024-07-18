<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Pemesanan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto px-4">
                <form method="POST" action="{{ route('admin.pemesanan.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900">User</label>
                        <select id="user_id" name="user_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="approver1_id" class="block mb-2 text-sm font-medium text-gray-900">Approver 1</label>
                        <select id="approver1_id" name="approver1_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($approvers as $approver)
                                <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="approver2_id" class="block mb-2 text-sm font-medium text-gray-900">Approver 2</label>
                        <select id="approver2_id" name="approver2_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($approvers as $approver)
                                <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="kendaraan_id" class="block mb-2 text-sm font-medium text-gray-900">Kendaraan</label>
                        <select id="kendaraan_id" name="kendaraan_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($kendaraan as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->nomor_plat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="driver_id" class="block mb-2 text-sm font-medium text-gray-900">Driver</label>
                        <select id="driver_id" name="driver_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="waktu_mulai" class="block mb-2 text-sm font-medium text-gray-900">Waktu Mulai</label>
                        <input type="datetime-local" id="waktu_mulai" name="waktu_mulai" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="waktu_selesai" class="block mb-2 text-sm font-medium text-gray-900">Waktu Selesai</label>
                        <input type="datetime-local" id="waktu_selesai" name="waktu_selesai" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="tujuan" class="block mb-2 text-sm font-medium text-gray-900">Tujuan</label>
                        <input type="text" id="tujuan" name="tujuan" placeholder="Tujuan" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui_level1">Disetujui Level 1</option>
                            <option value="disetujui_level2">Disetujui Level 2</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="py-4 px-6 bg-indigo-700 text-white rounded-full">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
