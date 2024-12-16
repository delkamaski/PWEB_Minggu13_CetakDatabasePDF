<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Siswa Baru</title>
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
            max-width: 500px;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        button {
            background-color: #2C78C2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1A5A96;
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
        p {
            color: green;
            font-weight: bold;
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
        <h1>Form Pendaftaran Siswa Baru</h1>
        <form action="daftar.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea>

            <label>Jenis Kelamin:</label>
            <input type="radio" name="jenis_kelamin" value="Laki-Laki" required> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan

            <label for="agama">Agama:</label>
            <select id="agama" name="agama" required>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Buddha">Buddha</option>
                <option value="Hindu">Hindu</option>
                <option value="Konghuchu">Konghuchu</option>
            </select>

            <label for="foto">Foto Diri:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>

            <button type="submit" name="submit">Submit</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $agama = $_POST['agama'];

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;

            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<p style='color: red;'>File bukan gambar.</p>";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "<p style='color: red;'>File sudah ada.</p>";
                $uploadOk = 0;
            }

            if ($_FILES["foto"]["size"] > 2000000) {
                echo "<p style='color: red;'>Ukuran file terlalu besar (maksimal 2MB).</p>";
                $uploadOk = 0;
            }

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                echo "<p style='color: red;'>Hanya file JPG, JPEG, PNG yang diizinkan.</p>";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO siswa (nama, alamat, jenis_kelamin, agama, foto) 
                            VALUES ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$target_file')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Pendaftaran berhasil.</p>";
                    } else {
                        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Error mengunggah foto.</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>