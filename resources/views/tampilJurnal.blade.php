@extends('layout.default')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush
@push('styles')
    <style>
        table.dataTable tbody td {
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
            {{-- table id_jurnal, no_akun (bukti_transaksi), account_number (kode_rek), index_kas, nama_unit, index_unit, debet, kredit --}}
            <table class="w-full whitespace-nowrap overflow-x-auto mt-8" id="dataTransaksiKeuangan">
                <thead class="text-gray-700 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Bukti Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Account Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Rekening</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Index Kas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Index Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Debet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kredit</th>
                    </tr>
                </thead>
            </table>
            <div class="flex justify-between mt-5">
                <div class="flex items-center gap-3 w-1/3">
                    <a href="{{ route('entry-jurnal') }}"
                        class="btn text-sm p-1 text-white font-medium w-1/3 hover:bg-blue-700 my-9">Kembali</a>
                </div>
                <div class="flex gap-3">
                    <div class="">
                        <label for="balance" class="block text-sm font-semibold my-2 text-gray-600">Balance</label>
                        <input type="text" name="balance" id="balance"
                            class="py-1 px-2 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Balance" value="{{ $totalBalance }}" disabled />
                    </div>
                    <div class="">
                        <label for="total_debet" class="block text-sm font-semibold my-2 text-gray-600">Total
                            Debet</label>
                        <input type="text" name="total_debet" id="total_debet"
                            class="py-1 px-2 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Total Debet" value="{{ $totalDebet }}" disabled />
                    </div>
                    <div class="">
                        <label for="total_kredit" class="block text-sm font-semibold my-2 text-gray-600">Total
                            Kredit</label>
                        <input type="text" name="total_kredit" id="total_kredit"
                            class="py-1 px-2 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Total Kredit" value="{{ $totalKredit }}" disabled />
                    </div>
                </div>
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
            $('#dataTransaksiKeuangan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('entry-jurnal.get') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'tanggal_transaksi',
                        name: 'tanggal_transaksi',
                        render: function(data) {
                            var date = new Date(data);
                            var day = ("0" + date.getDate()).slice(-2);
                            var month = ("0" + (date.getMonth() + 1)).slice(-2);
                            var year = date.getFullYear();
                            return day + '/' + month + '/' + year;
                        }
                    },
                    {
                        data: 'no_akun',
                        name: 'no_akun'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'account_number',
                        name: 'account_number'
                    },
                    {
                        data: 'nama_rek',
                        name: 'nama_rek'
                    },
                    {
                        data: 'index_kas',
                        name: 'index_kas'
                    },
                    {
                        data: 'nama_unit',
                        name: 'nama_unit'
                    },
                    {
                        data: 'index_unit',
                        name: 'index_unit'
                    },
                    {
                        data: 'debet',
                        name: 'debet'
                    },
                    {
                        data: 'kredit',
                        name: 'kredit'
                    },
                ],
                scrollX: true,
                scrollY: true,
                scroller: true,
                lengthMenu: [25, 50, 100],
                searching: false
            });
        });
    </script>
@endpush
