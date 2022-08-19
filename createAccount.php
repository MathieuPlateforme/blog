<?php
session_start();
include("config/config.php");
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");

$view = "createAccount";
$username = "";
$email = "";

try
{
    if (array_key_exists('password', $_POST))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        $error = checkAccount($username, $email, $password, $passwordConfirm);

        if ($error == [])
        {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            addUser($username, $email, $passwordHash, USER);
            header('Location: login.php');
        }
        else
        {
            foreach ($error as $i)
            {
                echo $i;
            }
        }
    }
}
catch(Exception $e)
{
    echo "Erreur fatale: ".$e->getMessage();
}

include("tpl/layout.phtml");