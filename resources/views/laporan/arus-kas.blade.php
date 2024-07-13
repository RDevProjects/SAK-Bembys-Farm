<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arus Kas</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    <style>
        .fixed-width {
            width: 20%;
        }

        /* * {
            border: 1px solid red;
        } */

        .border-x-1 {
            border-left: 1px solid black;
            border-right: 1px solid black;
        }
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
            <h3 class="font-bold text-lg mt-4">LAPORAN ARUS KAS</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <table class="mx-auto w-10/12 bg-white border border-black ">
            <thead>
                <tr>
                    <th class="px-3 py-1 text-start border border-black" colspan="2">KETERANGAN</th>
                    <th class="px-4 py-1 border border-black">DEBET</th>
                    <th class="px-4 py-1 fixed-width border border-black">KREDIT</th>
                    <th class="px-4 py-1 fixed-width border border-black"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-3 py-0.5 font-bold text-start border-x-1 border-black" colspan="2">Arus Kas dari
                        kegiatan
                        Investasi</td>
                    <td class="px-4 py-0.5 text-start fixed-width border-x-1 border-black"></td>
                    <td class="px-4 py-0.5 text-end fixed-width border-x-1 border-black"></td>
                    <td class="px-4 py-0.5 text-end border-x-1 border-black"></td>
                </tr>
                @foreach ($arusKasInvestasi as $item)
                    <tr>
                        <td class="px-10 py-0.5 text-start border-x-1 border-black" colspan="2">
                            {{ $item->buktiTransaksi->keterangan }}
                        </td>
                        <td class="px-4 py-0.5 text-start fixed-width border-x-1 border-black">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->debet, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end fixed-width border-x-1 border-black">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->kredit, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end">
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2"></td>
                    <td class="px-4 py-1 text-end font-bold border-y-2 border-black border-x-1 fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalDebetArusKasInvestasi, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-4 py-1 text-end font-bold border-y-2 border-x-1 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalKreditArusKasInvestasi, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalArusKasInvestasi, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="px-3 py-0.5 font-bold text-start border-x-1 border-black" colspan="2">Arus Kas dari
                        kegiatan
                        Operasi</td>
                    <td class="px-4 py-0.5 text-start fixed-width border-x-1 border-black"></td>
                    <td class="px-4 py-0.5 text-end fixed-width border-x-1 border-black"></td>
                    <td class="px-4 py-0.5 text-end border-x-1 border-black"></td>
                </tr>
                @foreach ($arusKasOperasi as $item)
                    <tr>
                        <td class="px-10 py-0.5 text-start border-x-1 border-black" colspan="2">
                            {{ $item->buktiTransaksi->keterangan }}
                        </td>
                        <td class="px-4 py-0.5 text-start fixed-width border-x-1 border-black">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->debet, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end fixed-width border-x-1 border-black">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->kredit, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end">
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2"></td>
                    <td class="px-4 py-1 text-end font-bold border-y-2 border-black border-x-1 fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalDebetArusKasOperasi, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-4 py-1 text-end font-bold border-y-2 border-x-1 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalKreditArusKasOperasi, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalArusKasOperasi, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="px-3 py-0.5 font-bold text-start border-x-1 border-black" colspan="2">Arus Kas dari
                        kegiatan
                        Pendanaan</td>
                    <td class="px-4 py-0.5 text-start fixed-width border-x-1 border-black"></td>
                    <td class="px-4 py-0.5 text-end fixed-width border-x-1 border-black"></td>
                    <td class="px-4 py-0.5 text-end border-x-1 border-black"></td>
                </tr>
                @foreach ($arusKasPendanaan as $item)
                    <tr>
                        <td class="px-10 py-0.5 text-start border-x-1 border-black" colspan="2">
                            {{ $item->buktiTransaksi->keterangan }}
                        </td>
                        <td class="px-4 py-0.5 text-start fixed-width border-x-1 border-black">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->debet, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end fixed-width border-x-1 border-black">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->kredit, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end">
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2"></td>
                    <td class="px-4 py-1 text-end font-bold border-y-2 border-black border-x-1 fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalDebetArusKasPendanaan, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-4 py-1 text-end font-bold border-y-2 border-x-1 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalKreditArusKasPendanaan, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalArusKasPendanaan, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-1 text-start font-bold border-x-1 border-black" colspan="2">Kenaikan Kas</td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-black fixed-width"></td>
                    <td class="px-4 py-1 text-end font-bold border-x-1 border-b-2 border-black fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($totalKenaikanKas, 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
