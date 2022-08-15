<?php
include("config/config.php");

function isLogged()
{
    return "headerdefault";
}

function dbConnections()
{
    try
    {
        $dbh = new PDO("mysql:host=localhost;dbname=blog", USERNAME, PASSWORD);
        return $dbh;
    }
    catch(PDOException $e)
    {
        echo "Erreur BDD: ".$e->getMessage();
    }
}

function checkAccount($username, $email, $password, $passwordConfirm)
{
    $error = [];

    if ($password != $passwordConfirm)
    {
        $error['1'] = "Erreur: Mot de passe non identique";
    }
    if (strlen($username) > 45 || strlen($email) > 255 || strlen($password) > 255)
    {
        $error['2'] = "Erreur: Limite de caractères dépassés";
    }
    if (strlen($password) < 7)
    {
        $error['3'] = "Erreur: Veuillez entrez un mot de passe de 8 caractères minimum";
    }
    if (ctype_alpha($username) == FALSE)
    {
        $error['4'] = "Erreur: Veuillez utiliser des caractères normaux";
    }

    return $error;
}
