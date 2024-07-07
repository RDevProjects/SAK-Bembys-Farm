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
            <h1 class="font-bold text-xl my-4">Baby's Farm</h1>
            {{-- <h2 class="font-semibold text-lg">SINAR NUSANTARA</h2>
            <p>Jl. KH. Samanhudi No. 84-86 Mangkunyudan, Solo</p> --}}
            <hr class="border-t-2 border-gray-900 my-1">
            <hr class="border-t-4 border-gray-900">
            <h3 class="font-bold text-lg mt-4">JURNAL UMUM</h3>
            <p class="mb-5">09/07/2020</p>
        </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-1">TANGGAL</th>
                    <th class="border border-gray-300 px-4 py-1">KETERANGAN</th>
                    <th class="border border-gray-300 px-4 py-1">REF</th>
                    <th class="border border-gray-300 px-4 py-1">DEBET</th>
                    <th class="border border-gray-300 px-4 py-1">KREDIT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-1">
                            {{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d/m/Y') }}</td>
                        <td class="border border-gray-300 px-4 py-1">{{ $item->keterangan }}</td>
                        <td class="border border-gray-300 px-4 py-1 text-center">{{ $item->account_number }}</td>
                        <td class="border border-gray-300 px-4 py-1 text-start">
                            <p class="float-start">Rp. </p>
                            <p class="float-end">{{ $item->debet }}</p>
                        </td>
                        <td class="border border-gray-300 px-4 py-1 text-end">Rp. {{ $item->kredit }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border border-gray-300 px-4 py-1" colspan="5"></td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-1 text-center font-bold" colspan="3">Total</td>
                    <td class="border border-gray-300 px-4 py-1 text-end font-bold">
                        {{ $data->sum('debet') }}</td>
                    <td class="border border-gray-300 px-4 py-1 text-end font-bold">
                        {{ $data->sum('kredit') }}</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-1 text-center font-bold" colspan="3">Balance</td>
                    <td class="border border-gray-300 px-4 py-1 text-center font-bold" colspan="2">
                        {{ $data->sum('debet') - $data->sum('kredit') }}</td>
                </tr>
                </tr>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>
