<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKU BESAR</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    <style>
        .fixed-width-10 {
            width: 10%;
        }

        .fixed-width-20 {
            width: 20%;
        }
    </style>
</head>

<body>
    <div class="container mx-auto my-8">
        <div class="text-center">
            <div class="flex items-center justify-between">
                <img src="{{ asset('logo.png') }}" alt="logo" class="w-14">
                <div class="ml-0">
                    <h1 class="font-bold text-xl">{{ env('APP_BRAND') }}</h1>
                    <p class="text-center">Jl. Tanggunggunung, Kalidawir, Tulungagung, Jawa Timur</p>
                </div>
                <div class="w-14"></div>
            </div>
            <hr class="border-t-2 border-gray-900 my-1">
            <hr class="border-t-4 border-gray-900">
            <h3 class="font-bold text-lg mt-4">BUKU BESAR</h3>
            <p class="mb-5 font-bold">Periode {{ \Carbon\Carbon::parse('May')->format('M Y') }}</p>
        </div>
        <div class="mx-auto w-10/12 my-4">
            <div class="flex items-center mb-2">
                <label for="kode_rek" class="mr-2 font-bold">KODE REK :</label>
                {{ $kodeRekening->kode_rek }}
            </div>

            <div class="flex items-center mb-2">
                <label for="nama_rek" class="mr-2 font-bold">NAMA REK :</label>
                {{ $kodeRekening->nama_rek }}
            </div>

            <div class="flex items-center mb-2">
                <label for="saldo_awal" class="mr-2 font-bold">SALDO AWAL :</label>
                {{ number_format($kodeRekening->saldo_awal, 0, ',', '.') }}
            </div>

            <div class="flex items-center mb-2">
                <label for="tipe_rek" class="mr-2 font-bold">TIPE REK :</label>
                {{ $kodeRekening->tipe_rek }}
            </div>
        </div>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="border border-black px-4 py-1 w-2">TANGGAL</th>
                    <th class="border border-black px-4 py-1">KETERANGAN</th>
                    <th class="border border-black px-2 py-1 fixed-width-10">DEBIT</th>
                    <th class="border border-black px-2 py-1 fixed-width-10">KREDIT</th>
                    <th class="border border-black px-4 py-1 fixed-width-20">SALDO (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $saldo = $kodeRekening->saldo_awal;
                @endphp
                <tr>
                    <td class="border border-black px-4 py-0.5 text-center">
                        {{ \Carbon\Carbon::parse('May')->startOfMonth()->format('d/M/Y') }}</td>
                    <td class="border border-black px-4 py-0.5">Saldo Awal</td>
                    @if ($kodeRekening->tipe_rek === 'DEBET')
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>{{ number_format($saldo, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>0
                            </div>
                        </td>
                    @else
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>0
                            </div>
                        </td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($saldo, 0, ',', '.') }}
                            </div>
                        </td>
                    @endif
                    <td class="border border-black px-4 py-0.5 text-end">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($saldo, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                @foreach ($transaksiKeuangans as $transaksi)
                    @php
                        if ($kodeRekening->tipe_rek === 'DEBET') {
                            $saldo += $transaksi->debet;
                            $saldo -= $transaksi->kredit;
                        } else {
                            $saldo -= $transaksi->debet;
                            $saldo += $transaksi->kredit;
                        }
                    @endphp
                    <tr>
                        <td class="border border-black px-4 py-0.5 text-center">
                            {{ \Carbon\Carbon::parse($transaksi->buktiTransaksi->tanggal_transaksi)->format('d/M/Y') }}
                        </td>
                        <td class="border border-black px-4 py-0.5">{{ $transaksi->buktiTransaksi->keterangan }}</td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($transaksi->debet, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($transaksi->kredit, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($saldo, 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-8">
            <div class="flex justify-end">
                <div class="w-1/3">
                    <p class="text-center">Tertanda,</p>
                    <p class="text-center">Bagian Keuangan</p>
                    <br>
                    <br>
                    <br>
                    <p class="text-center">______________________</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
