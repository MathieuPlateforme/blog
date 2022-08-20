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
function editCategory($name, $id)
{
    global $dbh;
    $stmt = $dbh->prepare("UPDATE categories
                            SET nom = :a
                            WHERE id = :b");
    $stmt->bindValue('a', $name);
    $stmt->bindValue('b', $id);
    $stmt->execute();   
}
function getCategoryByName($name)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT *
                            FROM categories
                            WHERE name = :a");
    $stmt->bindValue("a", $name);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;       
}
function addArticle($article, $titre, $idUser, $idCategory)
{
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO articles (article, titre, id_utilisateur, id_categorie, date) 
                            VALUES (:a, :b, :c, :d, :e)");
    $stmt->bindValue('a', $article);
    $stmt->bindValue('b', $titre);
    $stmt->bindValue('c', $idUser);
    $stmt->bindValue('d', $idCategory);
    $stmt->bindValue('e', newDate());
    $stmt->execute();   
}

function editArticle($article, $idCategory, $idUser, $idArticle)
{
    global $dbh;
    $stmt = $dbh->prepare("UPDATE articles 
                            SET article = :a,  id_utilisateur = :b, id_categorie = :c
                            WHERE id = :d");
    $stmt->bindValue('a', $article);
    $stmt->bindValue('b', $idUser);
    $stmt->bindValue('c', $idCategory);
    $stmt->bindValue('d', $idArticle);
    $stmt->execute();   
}

function getArticleByCategory($id)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT *
                            FROM articles
                            WHERE id_categorie = :a");
    $stmt->bindValue("a", $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}
