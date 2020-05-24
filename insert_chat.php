<?php
include('DB.php');
include('functions.php');
session_start();
$query = '
INSERT INTO chat_message 
(to_user_id, from_user_id, chat_message, status) 
VALUES ('.$_POST['to_user_id'].', '.$_SESSION['user_id'].', "'.$_POST['chat_message'].'", 1)
';
$res=  mysqli_query($connection, $query);

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connection);


?>
