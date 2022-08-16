<?php

$dbh = dbConnections();

function addCategory($name)
{
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO categories (nom)
                            VALUES (:a)");
    $stmt->bindValue('a', $name);
    $stmt->execute();     
}
function getCategories()
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT *
                            FROM categories)");
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;       
}
function getCategoryByName($name)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT *
                            FROM categories
                            WHERE name = :a)");
    $stmt->bindValue("a", $name);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;       
}

