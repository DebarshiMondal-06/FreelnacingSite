<?php

include('DB.php');
include('functions.php');
session_start();
$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";
$res=  mysqli_query($connection, $query);
