<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Penutupan</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    <style>
        .fixed-width-10 {
            width: 10%;
        }

        .fixed-width {
            width: 20%;
        }

        .fixed-width-15 {
            width: 15%;
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
            <h3 class="font-bold text-lg mt-4">Jurnal Penutupan</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="border border-black px-0 py-1">TANGGAL</th>
                    <th class="border border-black px-4 py-1">NAMA REKENING</th>
                    <th class="border border-black px-4 py-1">DEBET</th>
                    <th class="border border-black px-4 py-1">KREDIT</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDebet = 0;
                    $totalKredit = 0;
                @endphp

                <!-- Penjualan -->
                @foreach ($dataPendapatan as $item)
                    <tr>
                        <td class="border border-black px-4 py-0.5 text-center fixed-width-15">31 Mei</td>
                        <td class="border border-black px-4 py-0.5 text-start">{{ $item['nama_rek'] }}</td>
                        <td class="border border-black px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item['saldo'], 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                    </tr>
                    @php $totalDebet += $item['saldo']; @endphp
                @endforeach

                <!-- Laba/Rugi Bulan Ini (Credit) -->
                <tr>
                    <td class="border border-black px-4 py-0.5 text-center fixed-width-15"></td>
                    <td class="border border-black px-4 py-0.5 text-start">Laba/Rugi Bulan Ini</td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($dataPendapatan[0]['saldo'], 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                @php $totalKredit += $dataPendapatan[0]['saldo']; @endphp

                <!-- Laba/Rugi Bulan Ini (Debit) -->
                <tr>
                    <td class="border border-black px-4 py-0.5 text-center fixed-width-15">31 Mei</td>
                    <td class="border border-black px-4 py-0.5 text-start">Laba/Rugi Bulan Ini</td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($dataHargaPokokPenjualan[0]['saldo'] + $dataHargaPokokPenjualan[1]['saldo'] + $dataBeban[0]['saldo'] + $dataBeban[1]['saldo'], 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                </tr>
                @php $totalDebet += $dataHargaPokokPenjualan[0]['saldo'] + $dataHargaPokokPenjualan[1]['saldo'] + $dataBeban[0]['saldo'] + $dataBeban[1]['saldo']; @endphp

                <!-- Biaya Listrik dan Air -->
                @foreach ($dataBeban as $item)
                    <tr>
                        <td class="border border-black px-4 py-0.5 text-center fixed-width-15"></td>
                        <td class="border border-black px-4 py-0.5 text-start">{{ $item['nama_rek'] }}</td>
                        <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                        <td class="border border-black px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item['saldo'], 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                    @php $totalKredit += $item['saldo']; @endphp
                @endforeach

                <!-- Biaya Pakan Ternak dan Vaksin & Obat -->
                @foreach ($dataHargaPokokPenjualan as $item)
                    <tr>
                        <td class="border border-black px-4 py-0.5 text-center fixed-width-15"></td>
                        <td class="border border-black px-4 py-0.5 text-start">{{ $item['nama_rek'] }}</td>
                        <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                        <td class="border border-black px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item['saldo'], 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                    @php $totalKredit += $item['saldo']; @endphp
                @endforeach

                <!-- Laba/Rugi Bulan Ini (Debit) -->
                <tr>
                    <td class="border border-black px-4 py-0.5 text-center fixed-width-15">31 Mei</td>
                    <td class="border border-black px-4 py-0.5 text-start">Laba/Rugi Bulan Ini</td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($labaBersih, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                </tr>
                @php $totalDebet += $labaBersih; @endphp

                <!-- Laba Ditahan Tahun Lalu -->
                <tr>
                    <td class="border border-black px-4 py-0.5 text-center fixed-width-15"></td>
                    <td class="border border-black px-4 py-0.5 text-start">Laba Ditahan Tahun Lalu</td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width"></td>
                    <td class="border border-black px-4 py-0.5 text-end fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($labaBersih, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                @php $totalKredit += $labaBersih; @endphp

                <!-- Total -->
                <tr>
                    <td class="border border-black px-8 py-1 text-center font-bold" colspan="2">Jumlah</td>
                    <td class="border border-black px-4 py-1 text-end font-bold">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalDebet, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="border border-black px-4 py-1 text-end font-bold">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalKredit, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
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
