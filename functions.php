<?php include "DB.php"; ?>


<?php
function fetch_user_last_activity($user_id, $con)
{
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
$res=  mysqli_query($con, $query);
$out= mysqli_fetch_array($res);
$count= mysqli_num_rows($res);
if($count==0){return "2020-05-10 00:44:08";/*dummy value*/}
  return $out['last_activity'];
 
 }
 
 function fetch_user_chat_history($from_user_id, $to_user_id, $con)
{$query = 'SELECT * FROM chat_message WHERE (from_user_id = '.$from_user_id.' AND to_user_id = '.$to_user_id.') OR (from_user_id = '.$to_user_id.' AND to_user_id = '.$from_user_id.') ORDER BY timestamp ASC';
$res=  mysqli_query($con, $query);
$count= mysqli_num_rows($res);$i=0;$output='<ul>';

while($i!=$count){$out= mysqli_fetch_array($res);

if($out["from_user_id"] == $from_user_id){
   $output .='<li class="sent"><p>'.$out['chat_message'].'</p></li>';}
  else{$output .='<li class="replies"><p>'.$out['chat_message'].'</p></li>';
  }
$i++;
 }
$output .='</ul>';
$query = "
 UPDATE chat_message 
 SET status = '0' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
mysqli_query($con, $query);

 return $output;
}
function count_unseen_message($from_user_id, $to_user_id, $con)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
$res=  mysqli_query($con, $query);

$count = mysqli_num_rows($res);
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}



function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function email_exist($email)
{
	global $connection;
	$query = "SELECT user_email FROM regestration WHERE user_email='$email' ";
	$result = mysqli_query($connection,$query);
	confirmQuery($result);
	
	if(mysqli_num_rows($result) > 0){
		return true;
	}
	else {
		return false;
	}
}




function escape($string) {

global $connection;

return mysqli_real_escape_string($connection, trim($string));


}




function confirmQuery($result) {
    
    global $connection;

    if(!$result ) {
          
          die("QUERY FAILED ." . mysqli_error($connection));
   
          
      }
}

function check_profile($db_id = ''){
	
	global $connection;
	
	$query_check = "SELECT * FROM profilee, phonetb WHERE profilee.profile_id = {$db_id} AND phonetb.profile_id = {$db_id} ";
	$result_check = mysqli_query($connection, $query_check);

		$row = mysqli_fetch_array($result_check);
		
			$expertise = $row['expertise'];
			$phone_number = $row['phone_number'];
		
		if($expertise && $phone_number)
		{
			header("Location: user_dasboard.php");
		}	
		else{
			header("Location: create.php");
		}
	
}

function check_client_profile($db_id = ''){
	
	global $connection;
	
	$query_check = "SELECT * FROM client_profile WHERE client_profile.client_id = {$db_id} ";
	$result_check = mysqli_query($connection, $query_check);

		$row = mysqli_fetch_array($result_check);
		
			$client_mobile = $row['client_mobile'];
			$client_company = $row['client_company'];
			$company_address = $row['company_address'];
		
		if($client_mobile && $client_company && $company_address)
		{
			header("Location: client-dashboard.php");
		}	
		else{
			header("Location: client_profile/client_profile.php");
		}
	
}















