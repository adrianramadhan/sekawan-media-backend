<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Kendaraan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto px-4">
                <form method="POST" class="grid gap-4 md:grid-cols-2" action="{{route('admin.kendaraan.update', $kendaraan)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nomor_plat" class="block mb-2 text-sm font-medium text-gray-900">Nomor Plat</label>
                        <input type="text" id="nomor_plat" name="nomor_plat" placeholder="Nomor Plat" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{$kendaraan->nomor_plat}}">
                    </div>
                    <div class="mb-4">
                        <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900">Jenis</label>
                        <input type="text" id="jenis" name="jenis" placeholder="Jenis" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{$kendaraan->jenis}}">
                    </div>
                    <div class="mb-4">
                        <label for="merk" class="block mb-2 text-sm font-medium text-gray-900">Merk</label>
                        <input type="text" id="merk" name="merk" placeholder="Merk" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{$kendaraan->merk}}">
                    </div>
                    <div class="mb-4">
                        <label for="model" class="block mb-2 text-sm font-medium text-gray-900">Model</label>
                        <input type="text" id="model" name="model" placeholder="Model" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{$kendaraan->model}}">
                    </div>
                    <div class="mb-4">
                        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                        <input type="text" id="tahun" name="tahun" placeholder="Tahun" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{$kendaraan->tahun}}">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="tersedia" {{$kendaraan->status == 'tersedia' ? 'selected' : ''}}>Tersedia</option>
                            <option value="digunakan" {{$kendaraan->status == 'digunakan' ? 'selected' : ''}}>Digunakan</option>
                            <option value="perbaikan" {{$kendaraan->status == 'perbaikan' ? 'selected' : ''}}>Perbaikan</option>
                        </select>
                    </div>
                    {{-- Button Submit --}}
                    <div class="mb-4">
                        <button type="submit" class="py-4 px-6 bg-indigo-700 text-white rounded-full">Update</button>
                    </div>
                </form>
            </div>
</x-app-layout>
