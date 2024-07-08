<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKU BESAR</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
</head>

<body>
    <div class="container mx-auto my-8">
        <div class="text-center">
            <h1 class="font-bold text-xl my-4">{{ env('APP_BRAND') }}</h1>
            {{-- <h2 class="font-semibold text-lg">SINAR NUSANTARA</h2>
            <p>Jl. KH. Samanhudi No. 84-86 Mangkunyudan, Solo</p> --}}
            <hr class="border-t-2 border-gray-900 my-1">
            <hr class="border-t-4 border-gray-900">
            <h3 class="font-bold text-lg mt-4">BUKU BESAR</h3>
            <p class="mb-5">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <div class="mx-auto w-10/12 my-4">
            <div class="flex items-center mb-2">
                <label for="kode_rek" class="mr-2 font-bold">KODE REK :</label>
                {{-- {{ $kode_rek }} --}}
                </select>
            </div>

            <div class="flex items-center mb-2">
                <label for="nama_rek" class="mr-2 font-bold">NAMA REK :</label>
                {{-- {{ $nama_rek }} --}}
            </div>

            <div class="flex items-center mb-2">
                <label for="saldo_awal" class="mr-2 font-bold">SALDO AWAL :</label>
                {{-- {{ $saldo_awal }} --}}
            </div>

            <div class="flex items-center mb-2">
                <label for="tipe_rek" class="mr-2 font-bold">TIPE REK :</label>
                {{-- {{ $tipe_rek }} --}}
            </div>
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
                        <td class="border border-black px-4 py-0.5 text-end">{{ $item->debet }}</td>
                        <td class="border border-black px-4 py-0.5 text-end">{{ $item->kredit }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border border-black px-8 py-1 text-end font-bold" colspan="3">Total</td>
                    <td class="border border-black px-4 py-1 text-end font-bold">
                        {{ $data->sum('debet') }}</td>
                    <td class="border border-black px-4 py-1 text-end font-bold">
                        {{ $data->sum('kredit') }}</td>
                </tr>
                <tr>
                    <td class="border border-black px-8 py-1 text-end font-bold" colspan="3">Balance</td>
                    <td class="border border-black px-4 py-1 text-center font-bold" colspan="2">
                        {{ $data->sum('debet') - $data->sum('kredit') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</body>

</html>
