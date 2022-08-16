<?php
session_start();
include("lib/db.php");
include("lib/functions.php");
include("models/user.php");

$view = "login";
$nav = isLogged();
$username = "";

try
{
    if (array_key_exists('password', $_POST))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $error = checkLogin($username, $password);
        if ($error == [])
        {
            $credentials = userLogin($username);
            if ($credentials == false)
            {
               $error['1'] = 'Identifiants incorrect';
               echo $error['1'];
            }
            else
            {
                if (password_verify($password, $credentials['password']) == true)
                {
                    $_SESSION['user'] = ['id'=>$credentials['id'], 'username'=>$credentials['username'], 'email'=>$credentials['email'], 'rank'=>$credentials['id_droits']];
                    header("Location: index.php");
                }
                else
                {
                    $error['1'] = 'Identifiants incorrect';
                    echo $error['1'];
                }
            }

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