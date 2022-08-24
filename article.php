<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "article";
$comments = [];

if(array_key_exists('id', $_GET))
{
    $id = $_GET['id'];
    $data = getContent('articles', $id);
    $idCategory = $data['id_categorie'];
    $idUtilisateur = $data['id_utilisateur'];
}
else
{
    $data = listContent('articles', 5);
}

include("tpl/layout.phtml");