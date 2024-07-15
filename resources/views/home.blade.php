@extends('layout.default')
@section('content')
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-2">
            <div class="card">
                <div class="card-body">
                    <div class="sm:flex block justify-between mb-5">
                        <h4 class="text-gray-600 text-lg font-semibold sm:mb-0 mb-2">Sales Overview
                        </h4>
                    </div>
                    <div class="">
                        <div class="grid grid-cols-3 gap-4">
                            <a href="{{ route('laporan-jurnal-umum') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Jurnal Umum</a>
                            <a href="{{ route('laporan-buku-besar') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Buku Besar</a>
                            <a href="{{ route('laporan-neraca-saldo') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Neraca Saldo</a>
                            <a href="{{ route('laporan-laba-rugi') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Laba Rugi</a>
                            <a href="{{ route('laporan-perubahan-modal') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Perubahan Modal</a>
                            <a href="{{ route('laporan-neraca') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Neraca</a>
                            <a href="{{ route('laporan-arus-kas') }}" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan Arus Kas</a>
                            <a href="#" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan 8</a>
                            <a href="#" target="_blank"
                                class="bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Laporan 9</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
@endsection
