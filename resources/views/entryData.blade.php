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
            <div class="flex justify-between">
                <h1 class="block text-xl font-semibold mb-5 text-gray-600">Entry Jurnal</h1>
                @if (session('message'))
                    <div
                        class="flex items-center justify-between bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <p>{{ session('message') }}</p>
                        </div>
                        <button type="button" class="text-gray-500 hover:text-gray-600"
                            onclick="this.parentElement.remove()">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-9a1 1 0 10-2 0v2.586L7.707 11.7a1 1 0 00-1.414 1.414L9.586 15H8a1 1 0 100 2h4a1 1 0 100-2h-1.586l2.293-2.293a1 1 0 10-1.414-1.414L11 11.586V9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            <div class="flex">
                <form action="{{ route('entry-jurnal.store') }}" method="POST">
                    @csrf
                    <div class="flex gap-3">
                        <div class="flex items-center">
                            <label for="bukti_transaksi" class="block text-sm font-semibold my-2 text-gray-600">Bukti
                                Transaksi</label>
                            <input type="text" name="bukti_transaksi" id="bukti_transaksi" maxlength="10"
                                class="ms-6 py-2 px-3 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                                placeholder="" />
                        </div>
                        <div class="flex items-center">
                            <label for="tanggal" class="block text-sm font-semibold my-2 text-gray-600">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="py-2 px-4 mx-2 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                                placeholder="" />
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <label for="keterangan" class="block text-sm font-semibold my-2 text-gray-600">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" maxlength="100"
                            class="py-2 px-3 block w-5/12 border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="" />
                    </div>
                    <div class="flex gap-1 mt-20 text-center">
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 hidden">
                            <label for="id_jurnal" class="block text-sm font-semibold my-2 text-gray-600">ID Jurnal</label>
                            <input type="text" name="id_jurnal" id="id_jurnal" maxlength="5"
                                class="py-1 px-2 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0"
                                placeholder="" />
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 hidden">
                            <label for="no_akun" class="block text-sm font-semibold my-2 text-gray-600">No.
                                Akun</label>
                            <input type="text" name="no_akun" id="no_akun" maxlength="10"
                                class="py-1 px-2 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0"
                                placeholder="" />
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <label for="index_kas" class="block text-sm font-semibold my-2 text-gray-600">Index Kas</label>
                            <select name="index_kas" id="index_kas"
                                class="py-2 px-3 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0">
                                <option value=""></option>
                                <option value="1">1 | Arus Kas Dari Kegiatan Operasi</option>
                                <option value="2">2 | Arus Kas Dari Kegiatan Investasi</option>
                                <option value="3">3 | Arus Kas Dari Kegiatan Pendanaan</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <label for="account_number" class="block text-sm font-semibold my-2 text-gray-600">Kode
                                Rekening</label>
                            <select name="account_number" id="account_number"
                                class="py-2 px-3 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0">
                                <option value=""></option>
                                @foreach ($kodeRekenings as $kodeRekening)
                                    <option value="{{ $kodeRekening->kode_rek }}">{{ $kodeRekening->kode_rek }} |
                                        {{ $kodeRekening->nama_rek }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <label for="id_unit" class="block text-sm font-semibold my-2 text-gray-600">Nama Unit</label>
                            <select name="id_unit" id="id_unit"
                                class="py-2 px-3 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0">
                                <option value=""></option>
                                @foreach ($namaUnits as $namaUnit)
                                    <option value="{{ $namaUnit->id_unit }}">{{ $namaUnit->id_unit }} |
                                        {{ $namaUnit->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <label for="index_unit" class="block text-sm font-semibold my-2 text-gray-600">Index
                                Unit</label>
                            <select name="index_unit" id="index_unit"
                                class="py-2 px-3 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0">
                                <option value=""></option>
                                <option value="1">1 | Transaksi Masuk</option>
                                <option value="2">2 | Transaksi Keluar</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <label for="debet" class="block text-sm font-semibold my-2 text-gray-600">Debet</label>
                            <input type="text" name="debet" id="debet" maxlength="20"
                                class="py-1 px-2 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0"
                                placeholder="" />
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <label for="kredit" class="block text-sm font-semibold my-2 text-gray-600">Kredit</label>
                            <input type="text" name="kredit" id="kredit" maxlength="20"
                                class="py-1 px-2 block w-full border-gray-200 rounded-md text-xs focus:border-blue-600 focus:ring-0"
                                placeholder="" />
                        </div>
                        <div class="w-fit sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <button type="submit"
                                class="btn text-sm text-white font-medium w-full hover:bg-blue-700 my-9">Input</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="w-full whitespace-nowrap overflow-x-auto mt-8" id="dataTransaksiKeuangan">
                <thead class="text-gray-700 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No.</th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID Jurnal</th> --}}
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Bukti Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Account Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Rekening</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Index Kas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Index Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Debet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kredit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
            </table>
            <div class="flex justify-between mt-16">
                <div class="flex items-center gap-3 w-1/3">
                    <button type="submit"
                        class="btn text-sm p-1 text-white font-medium w-1/3 hover:bg-blue-700 my-9 hidden">Jurnal</button>
                    <a href="{{ route('tampil-jurnal') }}"
                        class="btn text-sm p-1 text-white font-medium w-1/3 hover:bg-blue-700 my-9">Record</a>
                </div>
                <div class="flex gap-3">
                    <div class="">
                        <label for="balance" class="block text-sm font-semibold my-2 text-gray-600">Balance</label>
                        <input type="text" name="balance" id="balance"
                            class="py-2 px-3 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Balance" value="{{ 'Rp ' . number_format($totalBalance, 0, ',', '.') }}"
                            disabled />
                    </div>
                    <div class="">
                        <label for="total_debet" class="block text-sm font-semibold my-2 text-gray-600">Total
                            Debet</label>
                        <input type="text" name="total_debet" id="total_debet"
                            class="py-2 px-3 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Total Debet" value="{{ 'Rp ' . number_format($totalDebet, 0, ',', '.') }}"
                            disabled />
                    </div>
                    <div class="">
                        <label for="total_kredit" class="block text-sm font-semibold my-2 text-gray-600">Total
                            Kredit</label>
                        <input type="text" name="total_kredit" id="total_kredit"
                            class="py-2 px-3 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Total Kredit" value="{{ 'Rp ' . number_format($totalKredit, 0, ',', '.') }}"
                            disabled />
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
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: null,
                        name: 'DT_RowIndex'
                    },
                    // {
                    //     data: 'id_jurnal',
                    //     name: 'id_jurnal'
                    // },
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
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }],
                scrollX: true,
                scrollY: true,
                scroller: true
            });
        });
    </script>
@endpush
