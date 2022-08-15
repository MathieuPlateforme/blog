<?php
include("functions.php");
$view = "createAccount";

dbConnections();

var_dump($_POST);

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
            echo "Succès!!";
        }
        else
        {
            foreach ($error as $i)
            {
                echo $i;
            }
        }


        echo "check";
    }
    else
    {
        echo "non";
    }
}
catch(Exception $e)
{
    echo "Erreur fatale: ".$e->getMessage();
}

include("tpl/".isLogged().".phtml");