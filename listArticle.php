<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "listArticle";
$nav = isLogged();

if(isLogged() == "navAdmin")
{
    $data['article'] = listContent('articles', 5);
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}

