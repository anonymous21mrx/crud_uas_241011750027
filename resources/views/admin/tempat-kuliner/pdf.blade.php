<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Tempat Kuliner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Laporan Data Tempat Kuliner</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Jenis Makanan</th>
                <th>Jam Operasional</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_tempat }}</td>
                <td>{{ $item->jenis_makanan }}</td>
                <td>{{ $item->jam_operasional }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
