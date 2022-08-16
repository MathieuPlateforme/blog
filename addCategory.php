<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "addCategory";
$nav = isLogged();
$category = "";

if(isLogged() == "navAdmin")
{
    if(array_key_exists('nom', $_POST))
    {
        $name = $_POST['nom'];
        addCategory($name);
        header('Location: listCategory.php');
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
