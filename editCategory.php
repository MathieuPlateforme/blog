<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "editCategory";
$error = "";

if(isLogged() == "navAdmin" && array_key_exists('id', $_POST))
{
    $id = $_POST['id'];
    $category = getContent('categories', $id);

    if (array_key_exists('nom', $_POST))
    {
        $name = $_POST['nom'];
        $id = $_POST['id'];
        
        if (strlen($name) < CATEGORY_MAX)
        { 
            editCategory($name, $id);
            header ('Location: listCategory.php');
        }
        else
        {
            $error = "Limite de caractères atteintes (".CATEGORY_MAX.")";
        }
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
