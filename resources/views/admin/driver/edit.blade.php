<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Driver') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto px-4">
                <form method="POST" action="{{ route('admin.driver.update', $driver)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input value="{{$driver->nama}}" type="text" id="nama" name="nama" placeholder="Nama" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="nomor_sim" class="block mb-2 text-sm font-medium text-gray-900">Nomor SIM</label>
                        <input value="{{$driver->nomor_sim}}" type="text" id="nomor_sim" name="nomor_sim" placeholder="Nomor SIM" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="aktif" {{$driver->status == 'aktif' ? 'selected' : ''}}>Aktif</option>
                            <option value="tidak aktif" {{$driver->status == 'tidak aktif' ? 'selected' : ''}}>TIdak Aktif</option>
                        </select>
                    </div>
                    {{-- Button Submit --}}
                    <div class="mb-4">
                        <button type="submit" class="py-4 px-6 bg-indigo-700 text-white rounded-full">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
