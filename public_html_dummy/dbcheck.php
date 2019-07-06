<?php

$dsn = 'mysql:host=db';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

$sql = "SELECT version();";

foreach ($dbh->query($sql, PDO::FETCH_ASSOC) as $row) {
    print_r($row);
}
