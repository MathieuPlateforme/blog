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

function editArticle($titre, $article, $idCategory, $idUser, $idArticle)
{
    global $dbh;
    $stmt = $dbh->prepare("UPDATE articles 
                            SET titre = :a, article = :b,  id_utilisateur = :c, id_categorie = :d
                            WHERE id = :e");
    $stmt->bindValue('a', $titre);
    $stmt->bindValue('b', $article);
    $stmt->bindValue('c', $idUser);
    $stmt->bindValue('d', $idCategory);
    $stmt->bindValue('e', $idArticle);
    $stmt->execute();   
}

function getArticleByCategory($id)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT *
                            FROM articles
                            WHERE id_categorie = :a
                            ORDER BY date DESC");
    $stmt->bindValue("a", $id);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function addComment($comment, $date, $idUtilisateur, $idArticle)
{
    global $dbh;
    $stmt = $dbh->prepare("INSERT INTO commentaires (commentaires, date, id_utilisateur, id_article)
                            VALUES (:a, :b, :c, :d)");
    $stmt->bindValue('a', $comment);
    $stmt->bindValue('b', $date);
    $stmt->bindValue('c', $idUtilisateur);
    $stmt->bindValue('d', $idArticle);
    $stmt->execute();     
}
function listComment($idArticle)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT *
                            FROM commentaires
                            WHERE id_article = :a
                            ORDER BY date DESC");
    $stmt->bindValue("a", $idArticle);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}