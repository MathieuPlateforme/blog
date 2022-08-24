<?php
include("config/config.php");

$dbh = dbConnections();

function isLogged()
{
    if (!isset($_SESSION['user']))
    {
        return $data['nav'] = 'navDefault';
    }
    if (isset($_SESSION['user']) && $_SESSION['user']['rank'] == 1)
    {
        return $data['nav'] = 'navUser';
    }
    if (isset($_SESSION['user']) && $_SESSION['user']['rank'] == 2)
    {
        return $data['nav'] = 'navAdmin';
    }
}

function checkAccount($username, $email, $password, $passwordConfirm)
{
    $error = [];
    $checkDuplicate = checkDuplicateAccount($username, $email);

    if ($password != $passwordConfirm)
    {
        $error['1'] = "Erreur: Mot de passe non identique.";
    }
    if (strlen($username) > USERNAME_MAX || strlen($email) > MAX_CHAR || strlen($password) > MAX_CHAR)
    {
        $error['2'] = "Erreur: Limite de caractères dépassés.";
    }
    if (strlen($username) < USERNAME_MIN)
    {
        $error['3'] = "Erreur: Veuillez entrez un nom d'utilisateur plus long.";
    }
    if (strlen($password) < PASSWORD_MIN)
    {
        $error['4'] = "Erreur: Veuillez entrez un mot de passe de 8 caractères minimum.";
    }
    if (ctype_alpha($username) == FALSE)
    {
        $error['5'] = "Erreur: Veuillez utiliser des caractères normaux.";
    }
    if ($checkDuplicate != false)
    {
        if ($username == $checkDuplicate['username'] || $email == $checkDuplicate['email'])
    {
        $error['6'] = "Erreur: Nom d'utilisateur ou e-mail déjà existants.";
    }
    }
    if ($username == "" || $email == "" || $password == "")
    {
        $error['7'] = "Erreur: Une erreur est survenu, veuillez re-essayer.";
    }

    return $error;
}

function checkLogin($username, $password)
{
    $error = [];
    if (str_contains($username, '\'') || str_contains($username, '\"') || str_contains($password, '\'') || str_contains($password, '\"'))
    {
        $error['1'] = "Petit cachottier";
    }
    if ($password == "")
    {
        $error['2'] = "Veuillez entrer un mot de passe";
    }
    return $error;
}
function newDate()
{
    $date = new DateTime("now", new DateTimeZone("Europe/Paris"));
    return $date->format('Y-m-d H:i:s');
}

function listContent($table, $ammount)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM $table
                            ORDER BY id DESC limit $ammount");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function getContent($table, $id)
{
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM $table
                            WHERE id = :id");
    $stmt->bindValue("id", $id);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function deleteContent($table, $id)
{
    global $dbh;
    $stmt = $dbh->prepare("DELETE FROM $table
                            WHERE id = :a");
    $stmt->bindValue("a", $id);
    $stmt->execute();
    
}
function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function unsetError($error)
{
    if (array_key_exists("error", $error))
    {
        unset($_SESSION['error']);
    }
}
