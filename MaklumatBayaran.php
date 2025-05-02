<?php require_once('Connections/rsk_kkss.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_rsk_kkss, $rsk_kkss);
$query_Recordset1 = "SELECT * FROM imej";
$Recordset1 = mysql_query($query_Recordset1, $rsk_kkss) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php 
require_once('Connections/rsk_kkss.php');

// Sambungan ke pangkalan data menggunakan MySQLi
$mysqli = new mysqli($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss, $database_rsk_kkss);

// Semak sambungan
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Dapatkan data daripada jadual imej
$query = "SELECT * FROM imej";
$result = $mysqli->query($query);

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
        .btn-light {
            color: #333 !important;
            border: 2px solid white;
            font-weight: bold;
        }
        .btn-light:hover {
            background-color: #f8f9fa !important;
            color: #000 !important;
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
    <center style= "font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif; font-weight: 500;"><h1>RSK-KKSS ADMIN PANEL</h1></center>
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
  <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
              <th>Nama</th>
            <th>NoKP</th>
            <th>Imej</th>
            <th>Muat Turun</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0) { ?>
          <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($row['ID']); ?></td>
              <td><?php echo $row_Recordset1['Nama']; ?></td>
            <td><?php echo htmlspecialchars($row['NoKP']); ?></td>
            <td><img src="uploads/<?php echo htmlspecialchars($row['Imej']); ?>" alt="Imej" width="100" id="Imej"></td>
            <td><a href="uploads/<?php echo htmlspecialchars($row['Imej']); ?>" download class="btn btn-success btn-sm"><i class="fas fa-download"></i> Muat Turun</a></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td colspan="5" class="text-center">Tidak ada rekod dijumpai</td>
          </tr>
          <?php } ?>
        </tbody>
    </table>
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
mysql_free_result($Recordset1);

// Tutup hasil dan sambungan MySQLi
$result->free();
$mysqli->close();
?>