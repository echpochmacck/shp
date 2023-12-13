<?php
session_start();
// echo($_SESSION['auth']);
if(isset($_SESSION['auth']))
echo($_SESSION['auth']);