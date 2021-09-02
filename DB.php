<?php
//global $connection;
$connection = mysqli_connect('localhost','root','','new');
if(!$connection)
{
	die("Connection Failed!".mysqli_error($connection));
}
date_default_timezone_set('Asia/Kolkata');


