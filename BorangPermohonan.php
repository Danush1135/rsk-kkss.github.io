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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO pelajar (Nama, Jantina, Semester, Unit, NoTel, NoTel_Ibu_Bapa, NoPendaftaran, NoKP, alamat, Status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['jantina'], "text"),
                       GetSQLValueString($_POST['semester'], "text"),
                       GetSQLValueString($_POST['program'], "text"),
                       GetSQLValueString($_POST['no_tel'], "int"),
                       GetSQLValueString($_POST['no_telB'], "int"),
                       GetSQLValueString($_POST['NomborPenfaftaraan'], "text"),
                       GetSQLValueString($_POST['no_kp'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['status'], "text"));

  mysql_select_db($database_rsk_kkss, $rsk_kkss);
  $Result1 = mysql_query($insertSQL, $rsk_kkss) or die(mysql_error());
  
  $successMessage = "Pendaftaran berjaya!";
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Borang Pendaftaran Rumah Sewa KKSS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      padding: 20px;
    }
    .navbar {
      background-color: #ff6347;
    }
    .navbar-brand img {
      width: 150px;
    }
    .form-container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: auto;
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    textarea {
      height: 80px;
    }
    .form-buttons {
      text-align: center;
      margin-top: 20px;
    }
    .form-buttons input {
      background-color: #ff6347;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .form-buttons input:hover {
      background-color: #e53e36;
    }
    .footer {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
      margin-top: 20px;
    }
    .notification {
      display: block;
      padding: 10px;
      margin-top: 20px;
      border-radius: 5px;
      text-align: center;
    }
    .notification.success {
      background-color: #28a745;
      color: white;
    }
    .notification.error {
      background-color: #dc3545;
      color: white;
    }
  </style>
</head>
<body>

<h1 class="text-center" style="font-family: Impact; font-weight: 500;">RSK-KKSS</h1>
<h2 class="text-center" style="font-family: Impact; font-weight: 500;">RUMAH SEWA KOPERASI KOLEJ KOMUNITI SUNGAI SIPUT</h2>
<br>

<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#">
    <img src="imej/SUNGAI SIPUT-outlines.png" alt="Logo Kolej Komuniti Sungai Siput" />
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

<div class="form-container">
  <h2>Borang Pendaftaran</h2>

  <?php if (isset($successMessage)): ?>
    <div class="notification success"><?php echo $successMessage; ?></div>
  <?php endif; ?>

  <form method="POST" action="<?php echo $editFormAction; ?>" name="form">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" required>

    <label for="NomborPenfaftaraan">Nombor Pendaftaraan</label>
    <input type="text" id="NomborPenfaftaraan" name="NomborPenfaftaraan" required>

    <label for="jantina">Jantina</label>
    <select id="jantina" name="jantina" required>
      <option value="">Sila Pilih</option>
      <option value="Lelaki">Lelaki</option>
      <option value="Perempuan">Perempuan</option>
    </select>

    <label for="semester">Semester</label>
    <select id="semester" name="semester" required>
      <option value="Sila Pilih">Sila Pilih</option>
      <option value="Semester 1">Semester 1</option>
      <option value="Semester 2">Semester 2</option>
      <option value="Semester 3">Semester 3</option>
      <option value="Semester 4 (LI)">Semester 4 (LI)</option>
    </select>

    <label for="program">Program</label>
    <select id="program" name="program" required>
      <option value="">Sila Pilih</option>
      <option value="Sijil Teknologi Maklumat">Sijil Teknologi Maklumat</option>
      <option value="Sijil Teknologi Elektrik">Sijil Teknologi Elektrik</option>
      <option value="Sijil Teknologi Automotif">Sijil Teknologi Automotif</option>
      <option value="Sijil Pengembaraan Pelancongan">Sijil Pengembaraan Pelancongan</option>
    </select>

    <label for="no_kp">No. Kad Pengenalan</label>
    <input type="text" id="no_kp" name="no_kp" required>

    <label for="alamat">Alamat</label>
    <textarea id="alamat" name="alamat" required></textarea>

    <label for="no_tel">No. Telefon</label>
    <input type="text" id="no_tel" name="no_tel" required>

    <label for="no_telB">No. Telefon Ibu Bapa</label>
    <input type="text" id="no_telB" name="no_telB" required>

    <input type="hidden" name="status" value="Dalam Proses">

    <div class="form-buttons">
      <input type="submit" value="Hantar">
      <input type="reset" value="Reset">
    </div>
    <input type="hidden" name="MM_insert" value="form">
  </form>

  <div class="text-center mt-3">
    <a href="Index.html" class="btn btn-primary">Kembali</a>
  </div>
</div>

<footer class="footer">
  <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
