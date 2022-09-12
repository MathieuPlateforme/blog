<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

if(array_key_exists('comment', $_POST))
{
    $comment = $_POST['comment'];
    $idUtilisateur = $_POST['idUser'];
    $idArticle = $_POST['idArticle'];
    if (strlen($comment) < COMMENT_MAX)
    {
        addComment($comment, newDate(), $idUtilisateur, $idArticle);
    }
    else
    {
        $error = "Limite de caractères atteintes: (".COMMENT_MAX.")";
    }
}
else
{
    header("Location: index.php");
}
