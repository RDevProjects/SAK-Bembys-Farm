@extends('layout.default')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var saldoAwal = document.getElementById('saldo_awal');
            var form = saldoAwal.closest('form');

            // Format initial value
            if (saldoAwal.value) {
                saldoAwal.value = formatRupiah(saldoAwal.value, 'Rp ');
            }

            saldoAwal.addEventListener('keyup', function(e) {
                saldoAwal.value = formatRupiah(this.value, 'Rp ');
            });

            form.addEventListener('submit', function(e) {
                saldoAwal.value = saldoAwal.value.replace(/[^,\d]/g, '');
            });
        });
    </script>
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
            <h1 class="block text-xl font-semibold mb-5 text-gray-600">Edit Rekening</h1>
            <div class="flex gap-5">
                {{-- buatkan input Kelompok Rekening (name: kode_rek), Kode Rekening (name: nama_rek), Nama Rekening (name: kelompok_rek), Tipe Rekening (name: tipe_rek), Saldo (name: saldo_awal), dan dibagian kanan terdapat tabel --}}
                <form action="{{ route('data-rekening.update', $data->kode_rek) }}" method="POST" class="w-2/3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="kelompok_rek" class="block text-sm font-semibold my-2 text-gray-600">Kelompok
                            Rekening</label>
                        <select name="kelompok_rek" id="kelompok_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                            <option value="">Kelompok Rekening</option>
                            <option value="Aktiva Lancar" {{ $data->kelompok_rek == 'Aktiva Lancar' ? 'selected' : '' }}>11
                                | Aktiva Lancar</option>
                            <option value="Aktiva Tetap" {{ $data->kelompok_rek == 'Aktiva Tetap' ? 'selected' : '' }}>12 |
                                Aktiva Tetap</option>
                            <option value="Aktiva Lain-Lain"
                                {{ $data->kelompok_rek == 'Aktiva Lain-Lain' ? 'selected' : '' }}>13 | Aktiva Lain-Lain
                            </option>
                            <option value="Hutang Jangka Pendek"
                                {{ $data->kelompok_rek == 'Hutang Jangka Pendek' ? 'selected' : '' }}>21 | Hutang Jangka
                                Pendek</option>
                            <option value="Hutang Jangka Panjang"
                                {{ $data->kelompok_rek == 'Hutang Jangka Panjang' ? 'selected' : '' }}>22 | Hutang Jangka
                                Panjang</option>
                            <option value="Modal" {{ $data->kelompok_rek == 'Modal' ? 'selected' : '' }}>3 | Modal</option>
                            <option value="Pendapatan" {{ $data->kelompok_rek == 'Pendapatan' ? 'selected' : '' }}>4 |
                                Pendapatan</option>
                            <option value="Beban" {{ $data->kelompok_rek == 'Beban' ? 'selected' : '' }}>5 | Beban</option>
                            <option value="Pendapatan Lain-lain"
                                {{ $data->kelompok_rek == 'Pendapatan Lain-lain' ? 'selected' : '' }}>6 | Pendapatan
                                Lain-lain</option>
                            <option value="Beban Lain-lain"
                                {{ $data->kelompok_rek == 'Beban Lain-lain' ? 'selected' : '' }}>7 | Beban Lain-lain
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="kode_rek" class="block text-sm font-semibold my-2 text-gray-600">Kode Rekening</label>
                        <input type="text" name="kode_rek" id="kode_rek" maxlength="20"
                            class="py-3 px-4 block w-full bg-gray-400 border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Kode Rekening" value="{{ $data->kode_rek }}" disabled />
                    </div>
                    <div>
                        <label for="nama_rek" class="block text-sm font-semibold my-2 text-gray-600">Nama
                            Rekening</label>
                        <input type="text" name="nama_rek" id="nama_rek" maxlength="50"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Nama Rekening" value="{{ $data->nama_rek }}" />
                    </div>
                    <div>
                        <label for="tipe_rek" class="block text-sm font-semibold my-2 text-gray-600">Tipe Rekening</label>
                        <select name="tipe_rek" id="tipe_rek"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0">
                            <option value="">Tipe Rekening</option>
                            <option value="DEBET" {{ $data->tipe_rek == 'DEBET' ? 'selected' : '' }}>Debet</option>
                            <option value="KREDIT" {{ $data->tipe_rek == 'KREDIT' ? 'selected' : '' }}>Kredit</option>
                        </select>
                    </div>
                    <div>
                        <label for="saldo_awal" class="block text-sm font-semibold my-2 text-gray-600">Saldo Awal</label>
                        <input type="text" name="saldo_awal" id="saldo_awal" maxlength="20"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Saldo" value="{{ $data->saldo_awal }}" />
                    </div>
                    <div class="flex gap-3">
                        <a href="javascript:location.reload(true)"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Batal</a>
                        <button type="submit"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Update</button>
                        <a href="{{ route('data-rekening') }}"
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
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
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
                    [0, 'asc']
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
                        name: 'saldo_awal',
                        render: function(data) {
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(data);
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                scrollX: true,
                scrollY: '63vh',
                scroller: true
            });
        });
    </script>
@endpush
