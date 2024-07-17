<!-- resources/views/buku-besar/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Besar</title>
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
</head>

<body>
    <div class="container mx-auto my-8">
        <h3 class="font-bold text-lg mt-4">BUKU BESAR</h3>
        <form action="{{ route('laporan-buku-besar') }}" method="POST">
            @csrf
            <div class="flex items-center mb-2">
                <label for="kode_rek" class="mr-2 font-bold">KODE REK :</label>
                <select name="kode_rek" id="kode_rek" class="border">
                    @foreach ($kodeRekenings as $rek)
                        <option value="{{ $rek->kode_rek }}">{{ $rek->kode_rek }} - {{ $rek->nama_rek }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit</button>
        </form>
    </div>
</body>

</html>
