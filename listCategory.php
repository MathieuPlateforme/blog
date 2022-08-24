<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "listCategory";
$error = "";

if(isLogged() == "navAdmin")
{
    if (array_key_exists('error', $_SESSION))
    {
        $error = $_SESSION['error'];
    }
    $data = listContent('categories', 100);
    unsetError($_SESSION);
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
