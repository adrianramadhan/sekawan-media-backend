<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Kendaraan') }}
            </h2>
            <a href="{{route('admin.kendaraan.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($kendaraans as $kendaraan)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Nomor Plat, Jenis Kendaraan</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$kendaraan->nomor_plat}}</h3>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$kendaraan->jenis}}</h3>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Model, Merk Kendaraan</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$kendaraan->model}}</h3>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$kendaraan->merk}}</h3>
                        </div>
                    </div>
                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Tahun Kendaraan</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$kendaraan->tahun}}</h3>
                        <p class="text-slate-500 text-sm">Status</p>
                        @switch($kendaraan->status)
                            @case('tersedia')
                                <div class="bg-green-200 rounded-md px-2 py-1">
                                    <h3 class="text-green-600 text-xl font-bold">{{$kendaraan->status}}</h3>
                                </div>
                                @break
                            @case('perbaikan')
                                <div class="bg-yellow-200 rounded-md px-2 py-1">
                                    <h3 class="text-yellow-600 text-xl font-bold">{{$kendaraan->status}}</h3>
                                </div>
                                @break
                            @case('digunakan')
                                <div class="bg-red-200 rounded-md px-2 py-1">
                                    <h3 class="text-red-600 text-xl font-bold">{{$kendaraan->status}}</h3>
                                </div>
                                @break
                            @default
                                <div class="bg-gray-200 rounded-md px-2 py-1">
                                    <h3 class="text-gray-600 text-xl font-bold">{{$kendaraan->status}}</h3>
                                </div>
                        @endswitch
                    </div>


                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{route('admin.kendaraan.edit', $kendaraan)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{route('admin.kendaraan.destroy', $kendaraan)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                @empty
                    <p>Belum ada data Kendaraan, silahkan tambahkan</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
