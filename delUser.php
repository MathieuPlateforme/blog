<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

if(isLogged() == "navUser" || isLogged() == "navAdmin" && array_key_exists('id', $_POST))
{
    $idSession = $_SESSION['user']['id'];
    $id = $_POST['id'];
    if ($idSession == $id)
    {
        deleteContent('utilisateurs', $id);
        // header("Location: logout.php");
    }
    else
    {
       // header("Location: index.php");
    }
    include("tpl/layout.phtml");
}
else
{
    var_dump($_POST);
   // header("Location: index.php");
}