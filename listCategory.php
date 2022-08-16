<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "listCategory";
$nav = isLogged();

if(isLogged() == "navAdmin")
{
    $data['categories'] = listContent('categories', 5);
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
