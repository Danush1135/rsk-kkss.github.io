<?php
require_once('Connections/rsk_kkss.php');

// Cipta sambungan
$connection = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

// Semak sambungan
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$successMessage = "";

// Kemaskini status pelajar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Hantar"])) {
    foreach ($_POST['Status'] as $id => $status) {
        $status = $connection->real_escape_string($status);
        $id = intval($id);
        $updateSQL = "UPDATE pelajar SET Status = ? WHERE ID = ?";
        $stmt = $connection->prepare($updateSQL);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }
    $successMessage = "Status berjaya dikemaskini!";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Padam pelajar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Padam"])) {
    $deleteId = intval($_POST['delete_id']);
    $deleteSQL = "DELETE FROM pelajar WHERE ID = ?";
    $stmt = $connection->prepare($deleteSQL);
    $stmt->bind_param("i", $deleteId);
    if ($stmt->execute()) {
        $successMessage = "Rekod berjaya dipadam!";
    } else {
        $successMessage = "Ralat semasa memadam rekod.";
    }
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Dapatkan data pelajar
$query_Recordset1 = "SELECT * FROM pelajar";
$Recordset1 = $connection->query($query_Recordset1);
?>

<!doctype html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RSK-KKSS - Senarai Pelajar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f6f9; }
        .navbar { background-color: #ff6347; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .navbar-brand img { width: 120px; }
        .container { margin-top: 50px; }
        .footer { background-color: #333; color: white; padding: 15px; text-align: center; margin-top: 30px; }
        .btn-light {
            color: #333 !important;
            border: 2px solid white;
            font-weight: bold;
        }
        .btn-light:hover {
            background-color: #f8f9fa !important;
            color: #000 !important;
        }
    </style>
    <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>
<body>

<header>
  <center><h1 style="font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif;">RSK-KKSS ADMIN PANEL</h1></center>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><img src="imej/SUNGAI SIPUT-outlines.png" alt="Logo"></a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li><a href="admin.html" class="btn btn-light mr-2">Laman Utama</a></li>
                <li><a href="Index.html" class="btn btn-danger">Log Out</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2 class="text-center">Senarai Pelajar</h2>
    <hr>

    <?php if (!empty($successMessage)) { ?>
        <div class="alert alert-success text-center"><?= $successMessage ?></div>
    <?php } ?>

    <?php if ($Recordset1->num_rows > 0) { ?>
    <form method="POST">
        <table width="100%" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No Kad Pengenalan</th>
                    <th>No Pendaftaran</th>
                    <th>Jantina</th>
                    <th>Semester</th>
                    <th>Unit</th>
                    <th>No Tel</th>
                    <th>No Tel Ibu Bapa</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $Recordset1->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['ID']) ?></td>
                    <td><?= htmlspecialchars($row['Nama']) ?></td>
                    <td><?= htmlspecialchars($row['NoKP']) ?></td>
                    <td><?= htmlspecialchars($row['NoPendaftaran']) ?></td>
                    <td><?= htmlspecialchars($row['Jantina']) ?></td>
                    <td><?= htmlspecialchars($row['Semester']) ?></td>
                    <td><?= htmlspecialchars($row['Unit']) ?></td>
                    <td><?= htmlspecialchars($row['NoTel']) ?></td>
                    <td><?= htmlspecialchars($row['NoTel_Ibu_Bapa']) ?></td>
                    <td>
                        <select name="Status[<?= $row['ID'] ?>]" class="form-control">
                            <option  value="Dalam Proses" <?= $row['Status'] == 'Dalam Proses' ? 'selected' : '' ?>>Dalam Proses</option>
                            <option value="NO.271 Taman Makmur" <?= $row['Status'] == 'NO.271 Taman Makmur' ? 'selected' : '' ?>>NO.271 Taman Makmur</option>
                            <option value="NO.115 Taman Makmur" <?= $row['Status'] == 'NO.115 Taman Makmur' ? 'selected' : '' ?>>NO.115 Taman Makmur</option>
                            <option value="NO.1005 Taman Tun Sambathan" <?= $row['Status'] == 'NO.1005 Taman Tun Sambathan' ? 'selected' : '' ?>>NO.1005 Taman Tun Sambathan</option>
                            <option value="NO.997 Taman Tun Sambathan" <?= $row['Status'] == 'NO.997 Taman Tun Sambathan' ? 'selected' : '' ?>>NO.997 Taman Tun Sambathan</option>
                            <option value="Rumah kedai 88, Belakang Maybank" <?= $row['Status'] == 'Rumah kedai 88, Belakang Maybank' ? 'selected' : '' ?>>Rumah kedai 88, Belakang Maybank</option>
                            <option value="Rumah Kedai 89, Belakang Maybank" <?= $row['Status'] == 'Rumah Kedai 89, Belakang Maybank' ? 'selected' : '' ?>>Rumah Kedai 89, Belakang Maybank</option>
                            <option value="Rumah Kedai Jalong 1, Taman Jalong" <?= $row['Status'] == 'Rumah Kedai Jalong 1, Taman Jalong' ? 'selected' : '' ?>>Rumah Kedai Jalong 1, Taman Jalong</option>
                            <option value="Rumah Kedai Jalong 2, Taman Jalong" <?= $row['Status'] == 'Rumah Kedai Jalong 2, Taman Jalong' ? 'selected' : '' ?>>Rumah Kedai Jalong 2, Taman Jalong</option>
                        </select>
                    </td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Anda pasti mahu padam rekod ini?');">
                            <input type="hidden" name="delete_id" value="<?= $row['ID'] ?>">
                            <button type="submit" name="Padam" class="btn btn-danger btn-sm">Padam</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-center">
            <input type="submit" name="Hantar" value="Kemaskini Semua Status" class="btn btn-success">
        </div>
    </form>
    <?php } else { ?>
        <div class="alert alert-warning text-center">Tiada rekod ditemui.</div>
    <?php } ?>
</div>

<footer class="footer">
    <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$Recordset1->free();
$connection->close();
?>