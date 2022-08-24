<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "addArticle";
$article = "";
$titre = "";
$error = "";

if(isLogged() == "navAdmin")
{
    $categories = listContent('categories', 100);
    var_dump($categories);
    if(array_key_exists(0 , $categories))
    {
        if(array_key_exists('article', $_POST))
        {
            $article = $_POST['article'];
            $titre = $_POST['titre'];
            $idCategory = $_POST['category'];
            $idUser = $_SESSION['user']['id'];

            if(strlen($article) < ARTICLE_MAX && strlen($titre) < TITRE_MAX)
            {
                addArticle($article, $titre, $idUser, $idCategory);
                header('Location: listArticle.php');
            }
            else
            {
                $error = "Limite de caractères atteints (Article: ".ARTICLE_MAX." Titre: ".TITRE_MAX.")";
            }
        }
    }
    else
    {
        $error = "Aucune catégorie n'est disponbile, veuillez en ajouter une.";
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
