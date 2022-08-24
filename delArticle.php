<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

if(isLogged() == "navAdmin" && array_key_exists('id', $_POST))
{
   $id = $_POST['id'];
   deleteContent('articles', $id);
   header("Location: listArticle.php");
   include("tpl/layout.phtml");
}
else
{
   header("Location: index.php");
}