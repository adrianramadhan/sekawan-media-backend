<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Pemesanan') }}
            </h2>
            <a href="{{route('admin.pemesanan.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($pemesanans as $pemesanan)
                <div class="item-card flex flex-row justify-between items-center">
                    <div class="flex flex-col">
                        <p class="text-slate-500 text-sm">Nama Pemesan, Tujuan</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$pemesanan->user->name}}</h3>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$pemesanan->tujuan}}</h3>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-slate-500 text-sm">Status</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$pemesanan->status}}</h3>
                    </div>
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{route('admin.pemesanan.edit', $pemesanan)}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{route('admin.pemesanan.destroy', $pemesanan)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                @empty
                    <p>Belum ada data Pemesanan, silahkan tambahkan</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
