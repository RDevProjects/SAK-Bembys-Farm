<!-- resources/views/buku-besar/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Besar</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    <style>
        /* * {
            border: 1px solid red;
        } */
    </style>
</head>

<body>
    <div class="container mx-auto my-8">
        <h3 class="font-bold text-xl mt-4 text-center">BUKU BESAR</h3>
        <form action="{{ route('laporan-buku-besar') }}" method="POST">
            @csrf
            <div class="flex items-center justify-center mb-2 my-5">
                <label for="kode_rek" class="mr-2 font-bold">KODE REK :</label>
                <select name="kode_rek" id="kode_rek" class="border rounded-md px-2 py-1">
                    @foreach ($kodeRekenings as $rek)
                        <option value="{{ $rek->kode_rek }}">{{ $rek->kode_rek }} - {{ $rek->nama_rek }}</option>
                    @endforeach
                </select>
                <div>
                    <button type="submit" class="btn bg-gray-700 px-4 py-2 ml-2">Cari</button>
                    <a href="{{ route('home') }}" class="btn px-4 py-2 ml-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
