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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['UserName'])) {
  $loginUsername=$_POST['UserName'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin.html";
  $MM_redirectLoginFailed = "wrongPassword.html";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_rsk_kkss, $rsk_kkss);
  
  $LoginRS__query=sprintf("SELECT AdminId, AdminPassword FROM `admin` WHERE AdminId=%s AND AdminPassword=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
   
  $LoginRS = mysql_query($LoginRS__query, $rsk_kkss) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="RSK-KKSS - Rumah Sewa Kolej Komuniti Sungai Siput">
  <title>RSK-KKSS - Rumah Sewa</title>
  
  <!-- Bootstrap CSS -->
  <style>
  @import url("css/bootstrap-4.4.1.css");

    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
	     .navbar {
            background-color: #ff6347;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            width: 120px;
        }

    .navbar {
      background-color: #ff6347;
    }

    .footer {
      background-color: #333;
      color: white;
      padding: 15px 0;
    }

    .footer p {
      margin: 0;
    }

    .login-container {
      display: flex;
      justify-content: center;
      margin-top: 50px;
    }

    .login-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 350px;
    }
  </style>
  <link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
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
	<header>
		<h1>RSK-KKSS ADMIN PANEL</h1>
	</header>
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
           
                    <a href="Index.html" class="btn btn-danger">Back</a>
              </li>
            </ul>
        </div>
    </nav>

  <header></header>
  
  <div class="login-container">
    <div class="login-box">
      <h4 class="text-center">Login Admin</h4>
      <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" onSubmit="MM_validateForm('username','','R','password','','R');return document.MM_returnValue">
        <div class="form-group">
          <label for="username">Username:</label>
          <input name="UserName" type="text" class="form-control" id="username" placeholder="Masukkan Username">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input name="Password" type="password" class="form-control" id="password" placeholder="Masukkan Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <footer class="footer text-center mt-5">
    <div class="container">
      <p>&copy; 2025 RSK-KKSS. Semua hak cipta terpelihara.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.4.1.js"></script>

</body>

</html>
