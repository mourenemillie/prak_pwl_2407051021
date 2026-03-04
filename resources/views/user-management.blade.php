<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            text-align: center;
        }

        h1 {
            margin-top: 30px;
            color: #42edea;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        table {
            margin: 0 auto; /* bikin tabel ke tengah */
            border-collapse: collapse;
            width: 70%;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th {
            background-color: #11919d;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center; /* isi tabel rata tengah */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf2ff;
        }
    </style>
</head>

<body>
    <h1>User Management</h1>
    <p>Ini adalah halaman user management</p>

    <table>
        <tr>
            <th>Nama</th>
            <th>NPM</th>
            <th>Jurusan</th>
            <th>Prodi</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user['nama'] }}</td>
                <td>{{ $user['npm'] }}</td>
                <td>{{ $user['jurusan'] }}</td>
                <td>{{ $user['prodi'] }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>