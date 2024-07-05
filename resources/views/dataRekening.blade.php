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

        <style>table.dataTable tbody td {
            border: 1px solid #dee2e6;
            font-size: 0.8rem;
        }

        table.dataTable tbody tr:nth-child(odd) {
            background-color: white;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #edf2f7;
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
                        <label for="kelompok_rek" class="block text-sm font-semibold my-2 text-gray-600">Kelompok
                            Rekening</label>
                        <select name="kelompok_rek" id="kelompok_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                            <option value="">Kelompok Rekening</option>
                            <option value="11">11 | Aktiva Lancar</option>
                            <option value="12">12 | Aktiva Tetap</option>
                            <option value="13">13 | Aktiva Lain-Lain</option>
                            <option value="21">21 | Hutang Jangka Pendek</option>
                            <option value="22">22 | Hutang Jangka Panjang</option>
                            <option value="3">3 | Modal</option>
                            <option value="4">4 | Pendapatan</option>
                            <option value="5">5 | Beban</option>
                            <option value="6">6 | Pendapatan Lain-lain</option>
                            <option value="7">7 | Beban Lain-lain</option>
                        </select>
                    </div>
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
                        <label for="tipe_rek" class="block text-sm font-semibold my-2 text-gray-600">Tipe Rekening</label>
                        <select name="tipe_rek" id="tipe_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                            <option value="">Tipe Rekening</option>
                            <option value="DEBET">Debet</option>
                        </select>
                    </div>
                    <div>
                        <label for="saldo_awal" class="block text-sm font-semibold my-2 text-gray-600">Saldo Awal</label>
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
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kode Rekening</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Rekening</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kelompok Rekening
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tipe Rekening</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Saldo Awal</th>
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
                order: [
                    [0, 'desc']
                ],
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'DT_RowIndex',
                    //     width: '50px',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'kode_rek',
                        name: 'kode_rek'
                    },
                    {
                        data: 'nama_rek',
                        name: 'nama_rek'
                    },
                    {
                        data: 'kelompok_rek',
                        name: 'kelompok_rek'
                    },
                    {
                        data: 'tipe_rek',
                        name: 'tipe_rek'
                    },
                    {
                        data: 'saldo_awal',
                        name: 'saldo_awal'
                    },
                ],
                scrollX: true,
                scrollY: '50vh',
                scroller: true
            });
        });
    </script>
@endpush
