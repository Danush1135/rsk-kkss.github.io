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
  $insertSQL = sprintf("INSERT INTO mesej (Nama, Mesej, Emel) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Nama'], "text"),
                       GetSQLValueString($_POST['Mesej'], "text"),
                       GetSQLValueString($_POST['NoTel'], "text"));

  mysql_select_db($database_rsk_kkss, $rsk_kkss);
  $Result1 = mysql_query($insertSQL, $rsk_kkss) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_rsk_kkss, $rsk_kkss);
$query_Recordset1 = sprintf("SELECT * FROM mesej WHERE ID = %s ORDER BY ID ASC", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $rsk_kkss) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="RSK-KKSS - Rumah Sewa Kolej Komuniti Sungai Siput">
  <title>Hubungi Kami - RSK-KKSS</title>
  
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
  
  <!-- jQuery -->
  <script src="jQueryAssets/jquery-1.11.1.min.js"></script>
  
  <style>
    body{
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
    }

   
    .form-group label {
      font-weight: bold;
    }

    .form-control {
      border-radius: 5px;
    }

    .admin-login {
      display: inline-block;
      background-color: blue;
      color: white !important;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .admin-login:hover {
      background-color: darkblue;
    }
  </style>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
  </script>
</head>

<body>

  <!-- Header Section -->
  <header>
    <h1 style= "font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif; font-weight: 500;">RSK-KKSS</h1>
	  <center>
	    <h2 style= "font-family: Impact, Haettenschweiler, 'Franklin Gothic Bold', 'Arial Black', sans-serif; font-weight: 500;">RUMAH SEWA KOPERASI KOLEJ KOMUNITI SUNGAI  SIPUT</h2>
	  </center>
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
  </header>

  <!-- Contact Form Section -->
  <main class="container my-5">
    <h3>Maklumbalas</h3>
    <p>Jika anda mempunyai sebarang pertanyaan atau ingin mendapatkan lebih banyak maklumat, sila hubungi kami melalui borang di bawah.</p>

    <form action="<?php echo $editFormAction; ?>" method="POST" name="form" onSubmit="MM_validateForm('name','','R','message','','R');return document.MM_returnValue">
      <div class="form-group">
        <label for="name">Nama Penuh:</label>
        <input name="Nama" type="text" class="form-control" id="name" placeholder="Masukkan nama penuh anda">
      </div>
      <div class="form-group">
        <label for="email">NoTel:</label>
       <input name="NoTel" type="text" class="form-control" id="name" placeholder="Nombor Telefon anda">
      </div>
      <div class="form-group">
        <label for="message">Mesej:</label>
        <textarea name="Mesej" rows="4" class="form-control" id="message" placeholder="Masukkan mesej anda"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Hantar</button>
      <input type="hidden" name="MM_insert" value="form">
    </form>
</main>

  <!-- Footer Section -->
  <footer class="footer py-3 mt-5">
    <div class="container text-center">
      <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
    </div>
  </footer>

  <!-- Bootstrap JS dan Popper.js -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.4.1.js"></script>
  
</body>

</html>
<?php
mysql_free_result($Recordset1);
?>
