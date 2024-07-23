@extends('layout.default')
@push('css')
@endpush
@push('styles')
    {{-- <style>
        * {
            border: 1px solid red;
        }
    </style> --}}
@endpush
@section('content')
    <!-- Main Content -->
    <div class="card bg-gray-50">
        <div class="card-body">
            <div class="flex justify-between">
                <h1 class="block text-xl font-semibold mb-5 text-gray-600">Tutup Buku</h1>
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
            <div class="flex justify-center">
                <form id="tutupBukuForm" action="{{ route('penutupan-akuntansi') }}" method="POST">
                    @csrf
                    @foreach ($result as $index => $item)
                        <input type="hidden" name="result[{{ $index }}][kode_rek]" value="{{ $item['kode_rek'] }}">
                        <input type="hidden" name="result[{{ $index }}][nama_rek]" value="{{ $item['nama_rek'] }}">
                        <input type="hidden" name="result[{{ $index }}][kelompok_rek]"
                            value="{{ $item['kelompok_rek'] }}">
                        <input type="hidden" name="result[{{ $index }}][saldo]" value="{{ $item['saldo'] }}">
                    @endforeach
                    <div class="w-full flex flex-col text-center font-bold">
                        <span>TUTUP BUKU SISTEM INFORMASI LAPORAN KEUANGAN</span>
                        <span>Bemby's Farm</span>
                        <div class="bg-red-600 text-gray-50 py-3 px-5 my-4 flex flex-col">
                            <span>BACKUP DATA DAHULU !</span>
                            <div class="text-start w-4/5 mx-auto my-3">
                                <span>Proses ini akan menghapus Data Transaksi Keuangan selama satu bulan.</span>
                                <span>Saldo Akun Nominal akan ditutup atau di-nolkan dan Saldo Akun Rill akan di pindahkan
                                    untuk saldo awal bulan berikutnya.</span>
                            </div>
                        </div>
                    </div>
                    <i class="text-sm">Cek Data : Laba Bersih Bulan ini adalah <b> Rp.
                            {{ number_format($labaBersih, 0, ',', '.') }}</b></i>
                    <!-- Tambahkan button atau elemen lain yang diperlukan -->
                    <button type="button"
                        class="btn text-sm text-white font-bold w-full hover:bg-blue-700 mt-2 disabled:cursor-not-allowed disabled:bg-red-600 disabled:hover:bg-red-700"
                        {{ $labaBersih == 0 ? 'disabled' : '' }} onclick="openModal()">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Content End -->

    <!-- Modal -->
    <div id="confirmationModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Tutup Buku</h2>
            <p class="mb-4">Apakah Anda yakin ingin menutup buku? Proses ini tidak bisa dibatalkan.</p>
            <div class="flex justify-end">
                <button type="button" class="btn bg-gray-500 text-white px-4 py-2 mr-2"
                    onclick="closeModal()">Batal</button>
                <button type="button" class="btn bg-red-600 text-white px-4 py-2" onclick="submitForm()">Lanjutkan</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openModal() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        function submitForm() {
            document.getElementById('tutupBukuForm').submit();
        }
    </script>
@endpush
