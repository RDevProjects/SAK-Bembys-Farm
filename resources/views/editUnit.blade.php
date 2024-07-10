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
            <h1 class="block text-xl font-semibold mb-5 text-gray-600">Edit Unit</h1>
            <div class="flex justify-between gap-5">
                <form action="{{ route('entry-jurnal.updateNamaUnit', $unit->id_unit) }}" method="POST" class="w-2/5 my-auto">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="id_unit" class="block text-sm font-semibold my-2 text-gray-600">ID Unit</label>
                        <input type="text" name="id_unit" id="id_unit" maxlength="5"
                            class="py-3 px-4 block w-full bg-gray-400 border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="ID Unit" value="{{ $unit->id_unit }}" disabled />
                    </div>
                    <div>
                        <label for="nama_unit" class="block text-sm font-semibold my-2 text-gray-600">Nama Unit</label>
                        <input type="text" name="nama_unit" id="nama_unit" maxlength="50"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Nama Unit" value="{{ $unit->nama_unit }}" />
                    </div>
                    <div class="flex gap-3">
                        <a href="javascript:location.reload(true)"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Batal</a>
                        <button type="submit"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Update</button>
                        <a href="{{ route('entry-jurnal.showNamaUnit') }}"
                            class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-5">Kembali</a>
                    </div>
                </form>
                <table class="w-1/3 whitespace-nowrap overflow-x-auto text-center" id="dataInputUnit">
                    <thead class="text-gray-700 bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">ID Unit</th>
                            <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Nama Unit</th>
                            <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-3">{{ $unit->id_unit }}</td>
                            <td class="px-6 py-3">{{ $unit->nama_unit }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('entry-jurnal.editNamaUnit', $unit->id_unit) }}"
                                    class="btn text-sm text-white font-medium w-full hover:bg-blue-700">Edit</a>
                                <form action="{{ route('entry-jurnal', $unit->id_unit) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn text-sm text-white font-medium w-full hover:bg-blue-700 mt-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
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
            $('#dataInputUnit').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('entry-jurnal.getNamaUnit') }}",
                },
                columns: [{
                        data: 'id_unit',
                        name: 'id_unit',

                    },
                    {
                        data: 'nama_unit',
                        name: 'nama_unit',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
