@extends('layout.default')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush

@push('styles')
    <style>
        /* Mengatur lebar tabel */
        #dataRekeningTable_wrapper {
            width: 91%;
            /* mx-auto */
            margin: auto;
            border: 1px solid #dee2e6;
        }

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

        table.dataTable tfoot th {
            font-weight: bold;
            text-align: right;
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <div class="card bg-gray-50">
        <div class="card-body">
            <h1 class="block text-xl font-semibold mb-5 text-gray-600">Jurnal Umum</h1>
            <div class="gap-5 border">
                <div class="text-center mt-5">
                    <h2 class="text-xl font-bold mb-5 text-gray-600">Babys Farm</h2>
                    <hr>
                    <h3 class="text-lg font-bold my-7 text-gray-600">Jurnal Umum</h3>
                </div>
                <table class="w-11/12" id="dataRekeningTable">
                    <thead class="text-gray-700 bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">TANGGAL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">KETERANGAN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">REF</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">DEBET</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">KREDIT</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total:</th>
                            <th id="totalDebetFooter"></th>
                            <th id="totalKreditFooter"></th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-right">Balance:</th>
                            <th colspan="2" id="balanceFooter"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="mt-5">
                <button id="downloadButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Download
                </button>
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
            var table = $('#dataRekeningTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false, // Disable search bar
                paging: false, // Disable page number
                info: false, // Disable "data of" information
                ajax: {
                    url: "{{ route('laporan-jurnal-umum.get') }}",
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
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'account_number',
                        name: 'account_number'
                    },
                    {
                        data: 'debet',
                        name: 'debet'
                    },
                    {
                        data: 'kredit',
                        name: 'kredit'
                    }
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // Convert to integer function
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    totalDebet = api
                        .column(3)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    totalKredit = api
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(3).footer()).html(totalDebet);
                    $(api.column(4).footer()).html(totalKredit);
                    $('#balanceFooter').html(totalDebet - totalKredit);
                }
            });
        });
    </script>
@endpush
