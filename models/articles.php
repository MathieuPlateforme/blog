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
function addArticle($article, $idCategory, $idUser)
{
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO articles (article, id_utilisateur, id_categorie) 
                            VALUES (:a, :b, :c)");
    $stmt->bindValue('a', $article);
    $stmt->bindValue('b', $idUser);
    $stmt->bindValue('c', $idCategory);
    $stmt->execute();   
}
