<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Driver') }}
            </h2>
            <a href="{{route('admin.driver.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($drivers as $driver)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Nama Driver, Nomor SIM</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$driver->nama}}</h3>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$driver->nomor_sim}}</h3>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <p class="text-slate-500 text-sm">Status</p>
                            @if($driver->status == 'aktif')
                                <div class="bg-green-200 rounded-md px-2 py-1">
                                    <h3 class="text-green-600 text-xl font-bold">{{$driver->status}}</h3>
                                </div>
                            @elseif($driver->status == 'tidak aktif')
                                <div class="bg-red-200 rounded-md px-2 py-1">
                                    <h3 class="text-red-600 text-xl font-bold">{{$driver->status}}</h3>
                                </div>
                            @else
                                <div class="bg-gray-200 rounded-md px-2 py-1">
                                    <h3 class="text-gray-600 text-xl font-bold">{{$driver->status}}</h3>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{route('admin.driver.edit', $driver)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{route('admin.driver.destroy', $driver)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                @empty
                    <p>Belum ada data Driver, silahkan tambahkan</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
