<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Terdaftar</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .content {
            text-align: center;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #2C78C2;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .logo img {
            height: 50px;
            cursor: pointer;
        }
        .logo a {
            text-decoration: none;
        }
        .button-container {
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #2C78C2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #1b5c91;
        }
    </style>
</head>
<body>
    <div class="logo">
        <a href="index.php">
            <img src="image.png" alt="Home">
        </a>
    </div>
    <div class="content">
        <h1>Siswa Terdaftar</h1>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT nama, alamat, jenis_kelamin, agama, foto FROM siswa");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td><img src='{$row['foto']}' alt='Foto' width='50'></td>
                            <td>{$row['nama']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['jenis_kelamin']}</td>
                            <td>{$row['agama']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Siswa tidak ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <form action="cetak_pdf.php" method="post" target="_blank">
                <button type="submit">Cetak PDF</button>
            </form>
        </div>
    </div>
</body>
</html>
