<?php
session_start();
include("lib/db.php");
include("lib/functions.php");

$view = "login";

try
{
    if (array_key_exists('password', $_POST))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $error = checkLogin($username, $password);
        
        if ($error == [])
        {
            echo "nickel";
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

include("tpl/".isLogged().".phtml");