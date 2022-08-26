<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

if(isLogged() == "navAdmin" && array_key_exists('id', $_POST))
{
    $id = $_POST['id'];
    $idArticle = $_POST['idArticle'];
    deleteContent('commentaires', $id);
    header("Location: article.php?id=".$idArticle);
}
else
{
    header("Location: index.php");
}
