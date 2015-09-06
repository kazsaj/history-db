<?php

$db_host = '';
$db_user = '';
$db_pass = '';
$db_name = '';
$db_port = 3306;

$db_conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

if (!$db_conn) {
    die('Could not connect: ' . mysqli_error($db_conn));
}
