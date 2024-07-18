<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laba Rugi</title>
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
            <div class="flex items-center justify-center">
                <img src="{{ asset('logo.png') }}" alt="logo" class="w-14 -ml-14">
                <div class="ml-0">
                    <h1 class="font-bold text-xl">{{ env('APP_BRAND') }}</h1>
                    <p class="text-center">Jl. Tanggunggunung, Kalidawir, Tulungagung, Jawa Timur</p>
                </div>
            </div>
            <hr class="border-t-2 border-gray-900 my-1">
            <hr class="border-t-4 border-gray-900">
            <h3 class="font-bold text-lg mt-4">Laba Rugi</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="px-0 py-1">PENDAPATAN</th>
                    <th class="px-4 py-1"></th>
                    <th class="px-4 py-1 fixed-width"></th>
                    <th class="px-4 py-1 fixed-width"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPendapatan as $item)
                    <tr>
                        <td class="px-10 py-0.5 text-start">{{-- {{ $item->kode_rek }} --}}</td>
                        <td class="px-4 py-0.5 text-start">{{ $item->nama_rek }}</td>
                        <td class="px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->kredit, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end">
                            <div class="flex justify-between fixed-width">
                                {{-- <span>Rp.</span>
                                {{ $item->kredit }} --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td class="px-4 py-1 text-start font-bold">Total Pendapatan</td>
                    <td class="px-4 py-1 text-end font-bold">
                        <div class="flex justify-between">
                            {{-- <span>Rp.</span>
                            {{ $dataPendapatan->sum('debet') }} --}}
                        </div>
                    </td>
                    <td class="px-4 py-1 text-end font-bold fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($dataPendapatan->sum('kredit'), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="ps-0 py-1">BIAYA</th>
                    <th class="px-4 py-1"></th>
                    <th class="px-4 py-1 fixed-width"></th>
                    <th class="px-4 py-1 fixed-width"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataBiaya as $item)
                    <tr>
                        <td class="px-10 py-0.5 text-start">{{-- {{ $item->kode_rek }} --}}</td>
                        <td class="px-4 py-0.5 text-start">{{ $item->nama_rek }}</td>
                        <td class="px-4 py-0.5 text-end fixed-width">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->debet, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-4 py-0.5 text-end">
                            <div class="flex justify-between fixed-width">
                                {{-- <span>Rp.</span>
                                {{ $item->kredit }} --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td class="px-4 py-1 text-start font-bold">Total Biaya</td>
                    <td class="px-4 py-1 text-end font-bold">
                        <div class="flex justify-between">
                            {{-- <span>Rp.</span>
                            {{ $dataBiaya->sum('debet') }} --}}
                        </div>
                    </td>
                    <td class="px-4 py-1 text-end font-bold fixed-width">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($dataBiaya->sum('debet'), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="px-10 py-0 text-start"></th>
                    <th class="px-4 py-0"></th>
                    <th class="px-4 py-0"></th>
                    <th class="px-4 py-0"></th>
                </tr>
            </thead>
            <tbody>
                <td></td>
                <td class="px-0 py-1 text-start font-bold">Laba/Rugi bersih</td>
                <td class="px-4 py-1 text-end font-bold">
                    <div class="flex justify-between">
                        {{-- <span>Rp.</span>
                        {{ $dataBiaya->sum('debet') }} --}}
                    </div>
                </td>
                <td class="px-4 py-1 text-end font-bold">
                    <div class="flex justify-between">
                        <span>Rp.</span>
                        {{ number_format($dataPendapatan->sum('kredit') - $dataBiaya->sum('debet'), 0, ',', '.') }}
                    </div>
                </td>
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
