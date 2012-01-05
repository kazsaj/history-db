<?php

if (!isset($_POST['hostname']) || !isset($_POST['command'])) {
   echo "invalid request";
   die;
}

$link = mysql_connect("FIXMEmysql-server", "FIXMEmysql-database", "FIXMEmysql-password");
if (!$link) {
   die('Could not connect: ' . mysql_error());
}
mysql_select_db("FIXMEmysql-database", $link);
$command = mysql_real_escape_string(urldecode($_POST['command']));
$hostname = mysql_real_escape_string(urldecode($_POST['hostname']));
$duplicate_count = mysql_fetch_array(mysql_query("select count(*) as count from history where command='$command';"));
if ($duplicate_count[0] == "0") {
   $result = mysql_query("insert into history set command='$command', hostname='$hostname', count=1;", $link);
   if (!$result) {
          die('Invalid query: ' . mysql_error());
   }
} else {
   $result = mysql_query("update history set timestamp=now(), count=count+1 where command='$command';", $link);
   if (!$result) {
          die('Invalid query: ' . mysql_error());
   }
}
mysql_close($link);




?>
