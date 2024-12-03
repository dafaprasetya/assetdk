<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Asset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .qr-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .qr-code {
            margin: 10px;
            text-align: center;
        }
        svg {
            /* border: 10px solid #ccc; */
            margin-bottom: -10px;
        }
        p{
            color: #646464;
        }
        @media print {
            body {
                margin: 0;
            }
            img {
                page-break-inside: avoid;
            }
            button{
                display: none;
            }
        }
    </style>
</head>
<body>
    <h1>QR ASSET</h1>
    {{-- total asset = {{ $asset->count() }} --}}
    <div class="qr-container">
        @foreach ($asset as $asset)
        <div class="qr-code">
            {!! QrCode::size(90)->generate(route('detailasset',$asset->dkasset)); !!}
            <p>{{ $asset->dkasset }}</p>
            <p>{{ $asset->kondisi }}</p>
            </div>
        @endforeach
    </div>
    <button onclick="window.print()">Print Semua</button>
</body>
</html>
