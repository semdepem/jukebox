<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['user']))
{
    header('Location: login.php'); 
}
?>