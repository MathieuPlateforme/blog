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
        $passwordHash = $user['password'];
        $checkDuplicate = checkDuplicateAccount($username, $email);
        var_dump($_POST);
        var_dump($checkDuplicate);
        if ($checkDuplicate != false)
        {
            if ($user['username'] == $checkDuplicate['username'])
            {
                if (strlen($password) > 0)
                {
                    if (strlen($password) > 7 && $password == $passwordConfirm)
                    {
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        updateProfile($username, $email, $passwordHash, $id);
                    }
                    else
                    {
                        $error = "Votre mot de passe n'est pas identique ou est en dessous de 8 caractères";
                    }
                }
                else
                {
                    updateProfile($username, $email, $passwordHash, $id);
                }
            }
            else
            {
                $error = "Nom d'utilisateur ou e-mail déjà existant";
            }
        }
        else
        {
            if (strlen($password) > 0)
            {
                if (strlen($password) > 7 && $password == $passwordConfirm)
                {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    updateProfile($username, $email, $passwordHash, $id);
                }
                else
                {
                    $error = "Votre mot de passe n'est pas identique ou est en dessous de 8 caractères";
                }
            }
            else
            {
                updateProfile($username, $email, $passwordHash, $id);
            }
        }
    }
    include("tpl/layout.phtml");
}
else
{
    header("Location: index.php");
}