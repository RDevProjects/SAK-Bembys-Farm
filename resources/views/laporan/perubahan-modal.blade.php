<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Modal</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    <style>
        .fixed-width {
            width: 20%;
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
            <h3 class="font-bold text-lg mt-4">Laporan Perubahan Modal</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="px-0 py-1"></th>
                    <th class="px-0 py-1"></th>
                    <th class="px-0 py-1 fixed-width"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-10 py-0.5 text-start font-bold">Modal Awal</td>
                    @foreach ($dataModal as $item)
                        <td class="px-4 py-0.5 text-start">{{ $item->nama_rek }}</td>

                        <td class="px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->saldo_awal, 0, ',', '.') }}
                            </div>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="px-0 py-1">Tambah</th>
                    <th class="px-4 py-1"></th>
                    <th class="px-4 py-1 fixed-width"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-10 py-0.5 text-start fixed-width"></td>
                    <td class="px-4 py-0.5 text-center">Laba Bersih</td>
                    <td class="px-4 py-0.5 text-end fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($dataPendapatan->sum('kredit') - $dataBiaya->sum('debet'), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- Modal Akhir --}}
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="px-0 py-1"></th>
                    <th class="px-0 py-1 fixed-width"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-10 py-0.5 text-start font-bold">Modal Akhir</td>
                    @foreach ($dataModal as $item)
                        <td class="px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->saldo_awal + $dataPendapatan->sum('kredit') - $dataBiaya->sum('debet'), 0, ',', '.') }}
                            </div>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
