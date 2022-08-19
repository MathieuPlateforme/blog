<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "addArticle";
$article = "";
$error = "";

if(isLogged() == "navAdmin")
{
    $categories = listContent('categories', 100);
    if(array_key_exists('article', $_POST))
    {
        $article = $_POST['article'];
        $idCategory = $_POST['category'];
        $idUser = $_SESSION['user']['id'];

        if(strlen($article) < 50000)
        {
            addArticle($article, $idCategory, $idUser);
            header('Location: listArticle.php');
        }
        else
        {
            $error = "Limite de caractères atteints";
        }
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
