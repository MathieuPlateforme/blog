<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "editArticle";
$error = "";

if(isLogged() == "navAdmin")
{
    if (array_key_exists('id', $_POST))
    {
        $id = $_POST['id'];
        $data = getContent('articles', $id);
        $categories = listContent('categories', 100);

    }
    if (array_key_exists('article', $_POST))
    {
        $article = $_POST['article'];
        $idCategory = $_POST['category'];
        $idArticle = $_POST['id'];
        $idUser = $_SESSION['user']['id'];
        if(strlen($article) < 50000)
        {
            editArticle($article, $idCategory, $idUser, $idArticle);
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
