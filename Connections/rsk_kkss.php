<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_rsk_kkss = "localhost";
$database_rsk_kkss = "rsk-kkss";
$username_rsk_kkss = "root";
$password_rsk_kkss = "";
$rsk_kkss = @mysql_pconnect($hostname_rsk_kkss, $username_rsk_kkss, $password_rsk_kkss) or trigger_error(mysql_error(),E_USER_ERROR); 
?>