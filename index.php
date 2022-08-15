<?php
session_start();
var_dump($_SESSION);
include("lib/db.php");
include("lib/functions.php");

$view = "index";

include("tpl/".isLogged().".phtml");

