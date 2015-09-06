<?php

$query = $db_conn->query("SELECT unix_timestamp(`timestamp`) AS timestamp, `command` FROM `history` ORDER BY `timestamp` ASC");

while ($row = $query->fetch_assoc()) {
    printf("#%s\n%s\n", $row['timestamp'], $row['command']);
}

$db_conn->close();
