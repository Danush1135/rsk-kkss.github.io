<!doctype html>
<html lang="ms">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RSK-KKSS - Rumah Sewa Kolej Komuniti Sungai Siput">
    <title>RSK-KKSS - Rumah Sewa</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .navbar {
            background-color: #ff6347;
        }

        .navbar-brand img {
            width: 150px;
        }

        .container {
            margin-top: 50px;
        }

        .house-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .house-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .house-card h5 {
            font-size: 22px;
            font-weight: bold;
            color: #ff6347;
            margin-bottom: 15px;
        }

        .house-card p {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            font-size: 14px;
            font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .welcome-text {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-top: 30px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .admin-link {
            display: inline-block;
            background-color: blue;
            color: white !important;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .admin-link:hover {
            background-color: darkblue;
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

<header>
    <h1>
        <center style="font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif">RSK-KKSS</center>
    </h1>
    <h2>
        <center style="font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif">
            RUMAH SEWA KOPERASI KOLEJ KOMUNITI SUNGAI SIPUT
        </center>
    </h2>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img src="imej/SUNGAI SIPUT-outlines.png" alt="Logo Kolej Komuniti Sungai Siput" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="Index.html" class="nav-link text-light">Laman Utama</a></li>
                <li class="nav-item"><a href="RumahSewa.html" class="nav-link text-light">Rumah Sewa Lelaki</a></li>
                <li class="nav-item active"><a href="RumahSewaPerempuan.html" class="nav-link text-light">Rumah Sewa Perempuan</a></li>
                <li class="nav-item"><a href="About.html" class="nav-link text-light">Tentang Kami</a></li>
                <li class="nav-item"><a href="HubungiKami.php" class="nav-link text-light">Hubungi Kami</a></li>
                <li class="nav-item"><a href="Upload.php" class="nav-link text-light">Bayaran</a></li>
				<li class="nav-item"><a href="Semakan.php" class="nav-link text-light">Semak</a></li>
                <li class="nav-item"><a href="LamanUtama.php" class="btn btn-primary">Login Admin</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2 class="text-center">Semak Status Pelajar</h2>
    <form method="POST" action="">
        <table width="432" border="1" class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center"><strong>Semak Status</strong></td>
                </tr>
                <tr>
                    <td>No KP</td>
                    <td><input type="text" name="NoKP" id="NoKP" class="form-control" value=""></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="Cari" id="Cari" value="Submit" class="btn btn-primary"></td>
                </tr>
            </tbody>
        </table>
    </form>

    <?php
    if (isset($_POST['Cari']) && isset($_POST['NoKP'])) {
        $NoKP = $_POST['NoKP'];
        
        // Semak jika NoKP dimasukkan
        if (!empty($NoKP)) {
            require_once('Connections/rsk_kkss.php');
            // Cipta sambungan ke pangkalan data
            $connection = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // SQL untuk mencari NoKP
            $query = "SELECT * FROM pelajar WHERE NoKP = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $NoKP);
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();

            $stmt->close();
            $connection->close();

            // Paparkan hasil carian
            if ($student) {
                echo '<table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>No Kad Pengenalan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>' . htmlspecialchars($student['ID']) . '</td>
                                <td>' . htmlspecialchars($student['Nama']) . '</td>
                                <td>' . htmlspecialchars($student['NoKP']) . '</td>
                                <td>' . htmlspecialchars($student['Status']) . '</td>
                            </tr>
                        </tbody>
                    </table>';
            } else {
                echo '<p class="alert alert-warning">NoKP tidak dijumpai.</p>';
            }
        } else {
            echo '<p class="alert alert-danger">Sila masukkan NoKP.</p>';
        }
    }
    ?>
</div>

<footer class="footer">
    <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
