<?php
include("config/config.php");

function isLogged()
{
    return "headerdefault";
}

function dbConnections()
{
    $dbh = new PDO("mysql:host=localhost;dbname=blog", USERNAME, PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function checkAccount($username, $email, $password, $passwordConfirm)
{
    $error = [];

    if ($password != $passwordConfirm)
    {
        $error['1'] = "Erreur: Mot de passe non identique";
    }
    if (strlen($username) > USERNAME_MAX || strlen($email) > MAX_CHAR || strlen($password) > MAX_CHAR)
    {
        $error['2'] = "Erreur: Limite de caractères dépassés";
    }
    if (strlen($username) < USERNAME_MIN)
    {
        $error['3'] = "Erreur: Veuillez entrez un nom d'utilisateur plus long";
    }
    if (strlen($password) < PASSWORD_MIN)
    {
        $error['4'] = "Erreur: Veuillez entrez un mot de passe de 8 caractères minimum";
    }
    if (ctype_alpha($username) == FALSE)
    {
        $error['5'] = "Erreur: Veuillez utiliser des caractères normaux";
    }

    return $error;
}
