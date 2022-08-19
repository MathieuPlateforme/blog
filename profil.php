<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");
include("models/articles.php");

$view = "profil";
$error = "";

if(isLogged() == "navAdmin" || isLogged() == "navUser")
{
    $id = $_SESSION['user']['id'];
    $user = getContent('utilisateurs', $id);
    if (array_key_exists('username', $_POST))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $checkDuplicate = checkDuplicateAccount($username, $email);
        var_dump($_POST);
        if ($checkDuplicate != false)
        {
            if ($user['username'] == $username || $user['email'] == $email)
            {
                echo "tout va bien";
            }
            else
            {
                $error = "Nom d'utilisateur ou e-mail déjà utiliser";
            }
        }
        else
        {
            echo "Pas de duplication";
        }
        
        if (strlen($password) > 0)
        {
            if (strlen($password) > 7 && $password == $passwordConfirm)
            {
                echo "bordel atomique";
            }
            else
            {
                $error = "Votre mot de passe n'est pas identique ou est en dessous de 8 caractères";
            }
        }
       
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}