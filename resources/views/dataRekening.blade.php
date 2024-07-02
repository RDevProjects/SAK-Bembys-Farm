@extends('layout.default')
@push('styles')
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f7fafc;
        }

        .table tr:nth-child(even) {
            background-color: #f7fafc;
        }
    </style>
@endpush
@section('content')
    <!-- Main Content -->
    <div class="card bg-gray-50">
        <div class="card-body">
            <h1 class="block text-xl font-semibold mb-5 text-gray-600">Input Rekening</h1>
            <div class="flex gap-5">
                {{-- buatkan input Kelompok Rekening (name: kode_rek), Kode Rekening (name: nama_rek), Nama Rekening (name: kelompok_rek), Tipe Rekening (name: tipe_rek), Saldo (name: saldo_awal), dan dibagian kanan terdapat tabel --}}
                <form action="{{-- {{ route('dataRekening.store') }} --}}" method="POST" class="w-2/3">
                    @csrf
                    <div>
                        <label for="nama_rek" class="block text-sm font-semibold my-2 text-gray-600">Kode Rekening</label>
                        <input type="text" name="nama_rek" id="nama_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Kode Rekening" />
                    </div>
                    <div>
                        <label for="kode_rek" class="block text-sm font-semibold my-2 text-gray-600">Kelompok
                            Rekening</label>
                        <input type="text" name="kode_rek" id="kode_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Kelompok Rekening" />
                    </div>
                    <div>
                        <label for="kelompok_rek" class="block text-sm font-semibold my-2 text-gray-600">Nama
                            Rekening</label>
                        <input type="text" name="kelompok_rek" id="kelompok_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Nama Rekening" />
                    </div>
                    <div>
                        <label for="tipe_rek" class="block text-sm font-semibold my-2 text-gray-600">Tipe Rekening</label>
                        <input type="text" name="tipe_rek" id="tipe_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Tipe Rekening" />
                    </div>
                    <div>
                        <label for="saldo_awal" class="block text-sm font-semibold my-2 text-gray-600">Saldo</label>
                        <input type="text" name="saldo_awal" id="saldo_awal"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Saldo" />
                    </div>
                    <div class="flex gap-3">
                        <a href="" class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Batal</a>
                        <a href=""
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Submit</a>
                        <a href="{{ route('home') }}"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Kembali</a>
                    </div>
                </form>
                <table class="table w-1/3">
                    <thead>
                        <tr>
                            <th>Kode Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Kelompok Rekening</th>
                            <th>Tipe Rekening</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($dataRekening as $rekening) --}}
                        <tr>
                            <td>{{-- {{ $rekening->kode_rek }} --}}</td>
                            <td>{{-- {{ $rekening->nama_rek }} --}}</td>
                            <td>{{-- {{ $rekening->kelompok_rek }} --}}</td>
                            <td>{{-- {{ $rekening->tipe_rek }} --}}</td>
                            <td>{{-- {{ $rekening->saldo_awal }} --}}</td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
@endsection
