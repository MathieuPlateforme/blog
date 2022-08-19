<?php
session_start();
include("lib/db.php");
include("lib/functions.php");

$view = "index";

include("tpl/layout.phtml");