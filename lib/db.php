<?php

function dbConnections()
{
    $dbh = new PDO("mysql:host=localhost;dbname=blog2", USERNAME, PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}