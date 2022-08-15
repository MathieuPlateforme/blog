<?php
session_start();
include("lib/db.php");
include("lib/functions.php");

$view = "index";
$nav = isLogged();

include("tpl/layout.phtml");