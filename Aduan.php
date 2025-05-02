<?php 
require_once('Connections/rsk_kkss.php'); 

// Database connection
$conn = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to escape values safely
function GetSQLValueString($conn, $theValue, $theType) {
    switch ($theType) {
        case "text":
            return "'" . $conn->real_escape_string($theValue) . "'";
        case "int":
            return is_numeric($theValue) ? intval($theValue) : "NULL";
        case "double":
            return is_numeric($theValue) ? doubleval($theValue) : "NULL";
        case "date":
            return "'" . $conn->real_escape_string($theValue) . "'";
        default:
            return "NULL";
    }
}

// Default query to fetch all messages
$query = "SELECT * FROM mesej";

// Check for filters
if (!empty($_GET['ID'])) {
    $colname = GetSQLValueString($conn, $_GET['ID'], "int");
    $query = "SELECT * FROM mesej WHERE ID = $colname";
} elseif (!empty($_GET['Emel'])) {
    $colname = GetSQLValueString($conn, $_GET['Emel'], "text");
    $query = "SELECT * FROM mesej WHERE Emel = $colname";
}

$result = $conn->query($query);
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
        body { font-family: 'Arial', sans-serif; background-color: #f4f6f9; }
        .navbar { background-color: #ff6347; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .navbar-brand img { width: 120px; }
        .btn-light {
            font-weight: bold;
            border-radius: 8px;
            padding: 6px 16px;
            border: 2px solid white;
        }
        .btn-light:hover {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        .container { margin-top: 50px; }
        .no-record { text-align: center; font-size: 18px; color: #555; margin-top: 20px; }
        .footer { background-color: #333; color: white; padding: 15px; text-align: center; margin-top: 30px; }

        /* 🔧 Cetakan */
        @media print {
            body * {
                visibility: hidden;
            }
            .container, .container * {
                visibility: visible;
            }
            .container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .navbar, .footer, .btn, .btn-danger, .btn-light {
                display: none !important;
            }
        }
    </style>
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <center style="font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif; font-weight: 500;">
        <h1>RSK-KKSS ADMIN PANEL</h1>
    </center>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><img src="imej/SUNGAI SIPUT-outlines.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="admin.html" class="btn btn-light mr-2">Laman Utama</a>
                </li>
                <li class="nav-item">
                    <a href="Index.html" class="btn btn-danger">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2 class="text-center mb-4">Senarai Mesej</h2>

    <!-- 🔧 Butang Cetak -->
    <div class="text-right mb-3">
        <button class="btn btn-info" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
    </div>

    <?php if ($result && $result->num_rows > 0) { ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NoTel</th>
                    <th>Mesej</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ID']) ?></td>
                        <td><?= htmlspecialchars($row['Nama']) ?></td>
                        <td><?= htmlspecialchars($row['Emel']) ?></td>
                        <td><?= htmlspecialchars($row['Mesej']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="no-record">⚠ Tiada rekod dijumpai.</p>
    <?php } ?>
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
$conn->close();
?>
