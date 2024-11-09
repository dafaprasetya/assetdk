<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #d12b2b;
            text-align: left;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #d12b2b;
        }
        .sub-header {
            font-size: 18px;
            color: #d12b2b;
            font-weight: bold;
            margin: 5px 0;
        }
        .address {
            font-size: 16px;
            color: #d12b2b;
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .content {
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .content div {
            margin: 5px 0;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            margin-left: 100px
        }
        .signature div {
            width: 45%;
            text-align: center;
        }
        .signature img {
            text-align: center;
            margin-left: -80px;
            margin-bottom: -40px;
        }
        .signature .receiver {
            margin-top: -30px;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 10px;
            text-align: center;
        }
        .date-place {
            text-align: center;
            margin-bottom: 40px;
            font-style: italic;
        }
        .note {
            font-size: 12px;
            color: #d12b2b;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">RRK</div>
        <div class="sub-header">Raja Rasa Kuliner corp.</div>
        <div class="address">D'Kriuk Fried Chicken<br>Jl. Berkerikil Ujung 1, Bubulak</div>
        <div class="title">TANDA TERIMA</div>
        <hr>
        <div class="content">
            <table>
                <tr>
                    <td style="width: 200px">Telah terima dari</td>
                    <td>:</td>
                    <td>{{ $asset->nama_penyerah }}</td>
                </tr>
                <tr>
                    <td>Untuk:</td>
                    <td>:</td>
                    <td>{{ $asset->nama_penerima }}</td>
                </tr>
                <tr>
                    <td>Tempat & Tanggal</td>
                    <td>:</td>
                    <td>{{ $asset->tempat }}, {{ $asset->waktu }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>{{ $asset->deskripsi }}</td>
                </tr>
            </table>
            
        </div>
        <div class="signature">
            <div class="giver">
                <img src="{{ asset('storage/signature_asset/'.$asset->ttd_penyerah) }}" width="150" style="max-width: 150px" alt="">
                <div class="signature-line">Yang Menyerahkan</div>
            </div>
            <div class="giver">
                <img src="{{ asset('storage/signature_asset/'.$asset->ttd_penerima) }}" width="150" style="max-width: 150px" alt="">
                <div class="signature-line">Yang Menerima</div>
            </div>
        </div>
        <div class="note">Tidak berlaku sebagai tanda terima yang sah / cash / giro / cek</div>
    </div>
</body>
</html>
