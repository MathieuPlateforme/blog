<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "listArticle";

if(isLogged() == "navAdmin")
{
    $data = listContent('articles', 100);
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}

