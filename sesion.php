<?php
session_start();
// echo($_SESSION['auth']);
if(isset($_SESSION['auth']))
echo($_SESSION['auth']);
$authAdmin=false;
if(isset($_SESSION['auth']))
if($_SESSION['auth']=='admin')
$authAdmin=true;
