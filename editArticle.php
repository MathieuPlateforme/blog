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
        $titre = $_POST['titre'];
        $article = $_POST['article'];
        $idCategory = $_POST['category'];
        $idArticle = $_POST['id'];
        $idUser = $_SESSION['user']['id'];
        
        if(strlen($article) < ARTICLE_MAX && strlen($titre) < TITRE_MAX)
        {
            editArticle($titre, $article, $idCategory, $idUser, $idArticle);
            header('Location: listArticle.php');
        }
        else
        {
            $error = "Limite de caractères atteints (Article: ".ARTICLE_MAX." Titre: ".TITRE_MAX.")";
        }
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
