<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "listCategory";

if(isLogged() == "navAdmin")
{
    $data = listContent('categories', 100);
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}
