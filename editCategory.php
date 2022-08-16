<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "editCategory";
$nav = isLogged();

if(isLogged() == "navAdmin")
{
    if (array_key_exists('id', $_POST))
    {
        $id = $_POST['id'];
        $category = getContent('categories', $id);
    }
    if (array_key_exists('nom', $_POST))
    {
        $name = $_POST['nom'];
        $id = $_POST['id'];

        editCategory($name, $id);
        header ('Location: listCategory.php');
    }

    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
