@extends('layout.default')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush
@push('styles')
    <style>
        /* Mengatur lebar tabel */
        #dataRekeningTable_wrapper {
            width: 65%;
            /* Menjadikan tabel terpusat */
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
                <form action="{{ route('data-rekening.store') }}" method="POST" class="w-2/3">
                    @csrf
                    <div>
                        <label for="kode_rek" class="block text-sm font-semibold my-2 text-gray-600">Kode Rekening</label>
                        <input type="text" name="kode_rek" id="kode_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Kode Rekening" />
                    </div>
                    <div>
                        <label for="nama_rek" class="block text-sm font-semibold my-2 text-gray-600">Nama
                            Rekening</label>
                        <input type="text" name="nama_rek" id="nama_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Nama Rekening" />
                    </div>
                    <div>
                        <label for="kelompok_rek" class="block text-sm font-semibold my-2 text-gray-600">Kelompok
                            Rekening</label>
                        <input type="text" name="kelompok_rek" id="kelompok_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Kelompok Rekening" />
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
                        <a href="javascript:location.reload(true)"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Batal</a>
                        <button type="submit"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Submit</button>
                        <a href="{{ route('home') }}"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Kembali</a>
                    </div>
                </form>
                <table class="w-1/3 whitespace-nowrap overflow-x-auto" id="dataRekeningTable">
                    <thead class="text-gray-700 bg-gray-50">
                        <tr>
                            <th>Kode Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Kelompok Rekening</th>
                            <th>Tipe Rekening</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataRekeningTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('data-rekening.get') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'kode_rek',
                        name: 'kode_rek',
                        width: '50px'
                    },
                    {
                        data: 'nama_rek',
                        name: 'nama_rek',
                        width: '150px'
                    },
                    {
                        data: 'kelompok_rek',
                        name: 'kelompok_rek',
                        width: '100px'
                    },
                    {
                        data: 'tipe_rek',
                        name: 'tipe_rek',
                        width: '100px'
                    },
                    {
                        data: 'saldo_awal',
                        name: 'saldo_awal',
                        width: '100px'
                    }
                ],
                scrollX: true,
                scrollY: '50vh',
                scroller: true
            });
        });
    </script>
@endpush
