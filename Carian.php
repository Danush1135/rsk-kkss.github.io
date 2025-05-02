<?php require_once('Connections/rsk_kkss.php'); ?>
<?php
$connection = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$colname_Recordset1 = "-1";
if (isset($_GET['NoKP'])) {
    $colname_Recordset1 = $_GET['NoKP'];
}

$query = "SELECT * FROM pelajar WHERE NoKP = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $colname_Recordset1);
$stmt->execute();
$result = $stmt->get_result();
$row_Recordset1 = $result->fetch_assoc();
?>
<!doctype html>
<html lang="ms">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RSK-KKSS - Rumah Sewa Kolej Komuniti Sungai Siput">
    <title>RSK-KKSS - Rumah Sewa</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }
        .navbar {
            background-color: #ff6347;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            width: 120px;
        }
        .navbar-nav .nav-link {
            font-size: 16px;
            color: white !important;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #000;
        }
        .container {
            margin-top: 50px;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
  <center><h1>RSK-KKSS ADMIN PANEL</h1></center>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img src="imej/SUNGAI SIPUT-outlines.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
			  <li><a href="admin.html" class="btn btn-light mr-2">Laman Utama</a></li>
                    <a href="Index.html" class="btn btn-danger">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2 class="text-center">Cari Pelajar</h2>
    <hr>
    <form action="cari_pelajar.php" method="GET" class="mt-4">
        <div class="form-group">
            <label for="NoKP">No Kad Pengenalan:</label>
            <input type="text" name="NoKP" id="NoKP" class="form-control" placeholder="Masukkan No KP" required>
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

<footer class="footer">
    <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
<?php
$stmt->close();
$connection->close();
?>
