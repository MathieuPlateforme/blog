<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "addCategory";
$category = "";
$error = "";

if(isLogged() == "navAdmin")
{
    if(array_key_exists('nom', $_POST))
    {
        $name = $_POST['nom'];
        if (strlen($name) < CATEGORY_MAX)
        {
            addCategory($name);
            header('Location: listCategory.php');
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
