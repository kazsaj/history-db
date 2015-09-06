<?php

require_once('db.php');

$command = trim(isset($_POST['command']) ? $_POST['command'] : implode(" ", array_slice($argv, 2)));
$hostname = isset($_POST['hostname']) ? $_POST['hostname'] : $_SERVER['HOSTNAME'];
$username = isset($_POST['username']) ? $_POST['username'] : isset($_SERVER['SUDO_USER']) ? $_SERVER['SUDO_USER'] : isset($_SERVER['USERNAME']) ? $_SERVER['USERNAME'] : $_SERVER['LOGNAME'];

$hash = sha1($command.$hostname.$username);

$command = $db_conn->real_escape_string($command);
$hostname = $db_conn->real_escape_string($hostname);
$username = $db_conn->real_escape_string($username);

$result = $db_conn->query("INSERT INTO `history` (`history_hash`, `username`, `hostname`, `command`) VALUES ('{$hash}', '{$username}', '{$hostname}', '{$command}') ON DUPLICATE KEY UPDATE `count` = `count` + 1");

if (!$result) {
    $error = "Invalid query: #{$db_conn->errno} {$db_conn->error}";
    $db_conn->close();
    die($error);
}
