<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neraca</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    <style>
        .fixed-width {
            width: 5%;
        }

        /* * {
            border: 1px solid red;
        } */
    </style>
</head>

<body>
    <div class="container mx-auto my-8">
        <div class="text-center">
            <h1 class="font-bold text-xl my-4">{{ env('APP_BRAND') }}</h1>
            {{-- <h2 class="font-semibold text-lg">SINAR NUSANTARA</h2>
            <p>Jl. KH. Samanhudi No. 84-86 Mangkunyudan, Solo</p> --}}
            <hr class="border-t-2 border-gray-900 my-1">
            <hr class="border-t-4 border-gray-900">
            <h3 class="font-bold text-lg mt-4">Neraca</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <div class="w-full flex gap-2">
            <div class="w-3/5">
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-1 w-1/5 text-start" colspan="2">AKTIVA LANCAR</th>
                            <th class="px-4 py-1 fixed-width"></th>
                            <th class="px-4 py-1 fixed-width"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktivaLancar as $item)
                            <tr>
                                <td class="px-3 py-0.5 text-start"> {{ $item->kode_rek }}</td>
                                <td class="px-3 py-0.5 text-start"> {{ $item->nama_rek }}</td>
                                <td class="px-4 py-0.5 text-end fixed-width">
                                    <div class="flex justify-between">
                                        <span>Rp.</span>
                                        {{ number_format($item->saldo_awal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="px-3 py-1 text-start font-bold">Jumlah Aktiva Lancar</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($aktivaLancarTotal, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-1 w-1/5 text-start" colspan="2">AKTIVA TETAP</th>
                            <th class="px-0 py-1"></th>
                            <th class="px-4 py-1 fixed-width"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktivaTetap as $item)
                            <tr>
                                <td class="px-3 py-0.5 text-start">{{ $item->kode_rek }}</td>
                                <td class="px-3 py-0.5 text-start">{{ $item->nama_rek }}</td>
                                <td class="px-4 py-0.5 text-end fixed-width">
                                    <div class="flex justify-between">
                                        <span>Rp.</span>
                                        {{ number_format($item->saldo_awal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="px-3 py-1 text-start font-bold">Jumlah Aktiva Tetap</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($aktivaTetapTotal, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-1 w-1/5 text-start" colspan="2">AKTIVA LAIN-LAIN</th>
                            <th class="px-0 py-1"></th>
                            <th class="px-4 py-1 fixed-width"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktivaLainLain as $item)
                            <tr>
                                <td class="px-3 py-0.5 text-start">{{ $item->kode_rek }}</td>
                                <td class="px-3 py-0.5 text-start">{{ $item->nama_rek }}</td>
                                <td class="px-4 py-0.5 text-end fixed-width">
                                    <div class="flex justify-between">
                                        <span>Rp.</span>
                                        {{ number_format($item->saldo_awal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="px-3 py-1 text-start font-bold">Jumlah Aktiva Lain-Lain</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($aktivaLainLainTotal, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-10 py-0 text-start"></th>
                            <th class="px-4 py-0 w-1/4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="px-3 py-1 text-start font-bold">Grand Total Aktiva</td>
                        <td class="px-4 py-1 text-end font-bold">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($totalSemua, 0, ',', '.') }}
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
            <div class="w-2/5">
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-1 w-1/5 text-start" colspan="2">KEWAJIBAN</th>
                            <th class="px-4 py-1 fixed-width"></th>
                            <th class="px-4 py-1 fixed-width"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-3 py-1 w-1/5 text-start font-bold" colspan="2">Hutang Jangka Pendek</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($hutangJangkaPendek as $item)
                            <tr>
                                <td class="px-3 py-0.5 text-start"> {{ $item->kode_rek }}</td>
                                <td class="px-3 py-0.5 text-start"> {{ $item->nama_rek }}</td>
                                <td class="px-4 py-0.5 text-end fixed-width">
                                    <div class="flex justify-between">
                                        <span>Rp.</span>
                                        {{ number_format($item->saldo_awal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="px-3 py-1 text-end font-bold" colspan="2">Jumlah Hutang Jangka Pendek</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($jumlahHutangJangkaPendek, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-1 w-1/5 text-start" colspan="2">Hutang Jangka Panjang</th>
                            <th class="px-0 py-1"></th>
                            <th class="px-4 py-1 fixed-width"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hutangJangkaPanjang as $item)
                            <tr>
                                <td class="px-3 py-0.5 text-start">{{ $item->kode_rek }}</td>
                                <td class="px-3 py-0.5 text-start">{{ $item->nama_rek }}</td>
                                <td class="px-4 py-0.5 text-end fixed-width">
                                    <div class="flex justify-between">
                                        <span>Rp.</span>
                                        {{ number_format($item->saldo_awal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="px-3 py-1 text-end font-bold" colspan="2">Jumlah Hutang Jangka Panjang</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($jumlahHutangJangkaPanjang, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-start font-bold" colspan="2">Jumlah Kewajiban</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($totalKewajiban, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-1 w-1/5 text-start" colspan="2">MODAL</th>
                            <th class="px-0 py-1"></th>
                            <th class="px-4 py-1 fixed-width"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modal as $item)
                            <tr>
                                <td class="px-3 py-0.5 text-start">{{ $item->kode_rek }}</td>
                                <td class="px-3 py-0.5 text-start">{{ $item->nama_rek }}</td>
                                <td class="px-4 py-0.5 text-end fixed-width">
                                    <div class="flex justify-between">
                                        <span>Rp.</span>
                                        {{ number_format($item->saldo_awal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="px-3 py-0.5 text-start"></td>
                            <td class="px-3 py-0.5 text-start">Laba/Rugi bulan ini</td>
                            <td class="px-4 py-0.5 text-end fixed-width">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($labaBersihRounded, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="px-3 py-1 text-start font-bold">Jumlah Modal</td>
                            <td class="px-4 py-1 text-end font-bold" colspan="2">
                                <div class="flex justify-between">
                                    <span>Rp.</span>
                                    {{ number_format($jumlahModal, 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="mx-auto w-full bg-white border border-black text-sm">
                    <thead>
                        <tr>
                            <th class="px-10 py-0 text-start"></th>
                            <th class="px-4 py-0 w-1/4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="px-3 py-1 text-start font-bold">Grand Total Pasiva</td>
                        <td class="px-4 py-1 text-end font-bold">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($totalPasiva, 0, ',', '.') }}
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
