<?php 
require_once('Connections/rsk_kkss.php');

// Sambung ke database dengan MySQLi
$conn = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Semak jika form dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "form") {
    $nama = $conn->real_escape_string($_POST['Nama']);
    $noKP = $conn->real_escape_string($_POST['NoKP']);
    
    if (isset($_FILES['Imej']) && $_FILES['Imej']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Imej']['tmp_name'];
        $fileName = basename($_FILES['Imej']['name']);
        $fileSize = $_FILES['Imej']['size'];
        $fileType = $_FILES['Imej']['type'];

        $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($fileType, $allowedTypes)) {
            echo "Hanya fail JPG, PNG, dan GIF dibenarkan.";
            exit;
        }

        if ($fileSize > 2 * 1024 * 1024) {
            echo "Saiz fail tidak boleh melebihi 2MB.";
            exit;
        }

        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $newFileName = uniqid() . "_" . $fileName;
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $stmt = $conn->prepare("INSERT INTO imej (Nama, NoKP, Imej) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $noKP, $newFileName);
            
            if ($stmt->execute()) {
                echo "<div class='alert alert-success text-center'>Rekod berjaya ditambah.</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Ralat database: " . $stmt->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Ralat memuat naik fail.</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Ralat fail: " . $_FILES['Imej']['error'] . "</div>";
    }
}

$conn->close();
?>

<!doctype html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSK-KKSS - Bayaran</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

        .footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .payment-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>

<!-- Header -->
<center><h1 style="font-family: Impact, Haettenschweiler, 'Arial Black', sans-serif;">RSK-KKSS</h1></center>
<center><h2 style="font-family: Impact, Haettenschweiler, 'Arial Black', sans-serif;">RUMAH SEWA KOPERASI KOLEJ KOMUNITI SUNGAI SIPUT</h2></center>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="imej/SUNGAI SIPUT-outlines.png" alt="Logo Kolej Komuniti Sungai Siput">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="Index.html" class="nav-link text-light">Laman Utama</a></li>
            <li class="nav-item"><a href="RumahSewa.html" class="nav-link text-light">Rumah Sewa Lelaki</a></li>
            <li class="nav-item"><a href="RumahSewaPerempuan.html" class="nav-link text-light">Rumah Sewa Perempuan</a></li>
            <li class="nav-item"><a href="About.html" class="nav-link text-light">Tentang Kami</a></li>
            <li class="nav-item"><a href="HubungiKami.php" class="nav-link text-light">Hubungi Kami</a></li>
            <li class="nav-item"><a href="Upload.php" class="nav-link text-light">Bayaran</a></li>
            <li class="nav-item"><a href="Semakan.php" class="nav-link text-light">Semak</a></li>
            <li class="nav-item"><a href="LamanUtama.php" class="btn btn-primary">Login Admin</a></li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<main class="container">
    <h2 class="text-center mb-4">Bukti Bayaran</h2>
    <p class="text-center">Sila buat bayaran secara online dan hantar bukti pembayaran melalui borang di bawah.</p>
    <p class="text-center">Recipient reference: <strong>Nama dan Nombor Kad Pengenalan</strong></p>

    <!-- Gambar Bukti -->
    <div class="text-center mb-4">
        <img src="imej/Screenshot 2025-04-21 092330.png" class="payment-image" alt="Bukti Bayaran Maybank">
    </div>

    <!-- Form Upload -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="Nama" class="form-control" required></td>
            </tr>
            <tr>
                <td>No Kad Pengenalan</td>
                <td><input type="text" name="NoKP" class="form-control" required></td>
            </tr>
            <tr>
                <td>Upload Imej</td>
                <td><input type="file" name="Imej" class="form-control-file" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-success">Hantar</button></td>
            </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form">
    </form>
</main>

<!-- Footer -->
<footer class="footer">
  <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
