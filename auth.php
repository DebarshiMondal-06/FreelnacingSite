<?php
session_start();

if(!isset($_SESSION['auth']))
{
	header("Location: index.php");
}

?>