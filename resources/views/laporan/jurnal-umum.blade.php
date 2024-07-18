<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Umum</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
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
            <h3 class="font-bold text-lg mt-4">JURNAL UMUM</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <table class="mx-auto w-10/12 bg-white border border-black">
            <thead>
                <tr>
                    <th class="border border-black px-4 py-1 w-2">TANGGAL</th>
                    <th class="border border-black px-4 py-1">KETERANGAN</th>
                    <th class="border border-black px-4 py-1">REF</th>
                    <th class="border border-black px-4 py-1">DEBET</th>
                    <th class="border border-black px-4 py-1">KREDIT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="border border-black px-4 py-0.5 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d/M/Y') }}</td>
                        <td class="border border-black px-4 py-0.5">{{ $item->keterangan }}</td>
                        <td class="border border-black px-4 py-0.5 text-center">{{ $item->account_number }}</td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->debet, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="border border-black px-4 py-0.5 text-end">
                            <div class="flex justify-between">
                                <span>Rp.</span>
                                {{ number_format($item->kredit, 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border border-black px-8 py-1 text-end font-bold" colspan="3">Total</td>
                    <td class="border border-black px-4 py-1 text-end font-bold">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($data->sum('debet'), 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="border border-black px-4 py-1 text-end font-bold">
                        <div class="flex justify-between">
                            <span>Rp.</span>
                            {{ number_format($data->sum('kredit'), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="border border-black px-8 py-1 text-end font-bold" colspan="3">Balance</td>
                    <td class="border border-black px-4 py-1 text-center font-bold" colspan="2">
                        <div class="flex justify-center">
                            <span>Rp.</span>
                            {{ $data->sum('debet') - $data->sum('kredit') }}
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
