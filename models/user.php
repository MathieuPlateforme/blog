<?php

$dbh = dbConnections();

function addUser($username, $email, $password, $rank)
{
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO utilisateurs (username, email, password, id_droits)
                            VALUES (:a, :b, :c, :d)");
    $stmt->bindValue('a', $username);
    $stmt->bindValue('b', $email);
    $stmt->bindValue('c', $password);
    $stmt->bindValue('d', $rank);
    $stmt->execute();           
}