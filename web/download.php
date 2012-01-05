<?php

if ($_GET['passwd'] != "downloadpassword") {
   echo "invalid request";
   die;
}

$link = mysql_connect("FIXMEmysql-server", "FIXMEmysql-username", "FIXMEmysql-password");
if (!$link) {
   die('Could not connect: ' . mysql_error());
}
mysql_select_db("FIXMEmysql-database", $link);
$query = mysql_query("select unix_timestamp(timestamp) as timestamp, command from history order by timestamp asc;");
while ($row = mysql_fetch_array($query)) { 
   printf("#%s\n%s\n", $row[0], $row[1]); 
}
mysql_close($link);




?>
