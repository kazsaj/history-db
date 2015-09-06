<?php

if (!isset($_POST['hostname']) || !isset($_POST['command'])) {
    die('Invalid request');
}

# TODO reading should also require password
#require_once('../php/password.php');
require_once('../php/add.php');

$db_conn->close();
