<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

if(isLogged() == "navAdmin")
{
    if (array_key_exists('id', $_POST))
    {
        $id = $_POST['id'];
        if (getArticleByCategory($id) == false)
        {
            deleteContent('categories', $id);
        }
        else
        {
            $error = "Catégorie utiliser dans un article, veuillez changer la catégorie de l'article";
        } 
        header("Location: listCategory.php");
    }
    else
    {
        header("Location: index.php");
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}