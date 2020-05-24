<?php
include('DB.php');
include('functions.php');
session_start();


if($_SESSION['userrole']=="Freelancer"){
$query='select * from users_applied_jobs where user_profile_id='.$_SESSION['user_id'].' and hire_status="Hired"';
$res=  mysqli_query($connection, $query);
$count= mysqli_num_rows($res);
 $client_token=''; //retriving all the client token where user profile id = current session[id]
        $i=0;

        while($i!=$count){$out= mysqli_fetch_array($res)or die(mysqli_errno($connection));
        
        if($i!=$count-1){
        $client_token .= '"'.$out['client_token'].'",';}
        else{$client_token .= '"'.$out['client_token'].'"';}
        $i++;
        }
      //  echo $client_token;
$query='select * from client_job_posting where c_token in('.$client_token.')';
$res=  mysqli_query($connection, $query);
$client_id=''; //retriving all client id where client token are tokens stored in $client_token variable
        $i=0;

        while($i!=$count){$out= mysqli_fetch_array($res)or die(mysqli_errno($connection));
        
        if($i!=$count-1){
        $client_id .= '"'.$out['client_id'].'",';}
        else{$client_id .= '"'.$out['client_id'].'"';}
        $i++;
        }
        
        

$query='select * from regestration where user_id in('.$client_id.')'; //will only display details of client for which user is selected
$res=  mysqli_query($connection, $query);

        $count= mysqli_num_rows($res);
  
        $i=0;
        $output='';
        while($i!=$count){$out= mysqli_fetch_array($res)or die(mysqli_errno($connection));
         $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($out['user_id'], $connection);
  if($user_last_activity > $current_timestamp)
 {
  $status = '<p class="name text-success">Online</p>';
 }
 else
 {
  $status = '<p class="name text-danger">Offline</p>';
 }
 echo ' 				<li class="contact ">
					<div class="wrap">
						<img src="http://emilcarlsson.se/assets/louislitt.png" alt="" /><!-- frelancer display picture-->
						<div class="meta">
							<p class="name ">'.$out['firstname'].' '.count_unseen_message($out['user_id'],$_SESSION['user_id'],$connection).'</p><!-- frelancer Name-->'.$status.'
                                                            
							<p class="preview"><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$out['user_id'].'" data-tousername="'.$out['firstname'].'">Start Chat</button></p><!-- frelancer Last message-->
						</div>
					</div>
				</li>
        ';
        $i++;}
}
else{
$query='select * from client_job_posting where client_id='.$_SESSION['user_id'].'';
$res=  mysqli_query($connection, $query);
$count= mysqli_num_rows($res);
 $client_token=''; 
        $i=0;

        while($i!=$count){$out= mysqli_fetch_array($res)or die(mysqli_errno($connection));
        
        if($i!=$count-1){
        $client_token .= '"'.$out['c_token'].'",';}
        else{$client_token .= '"'.$out['c_token'].'"';}
        $i++;
        }
//       echo $client_token;
$query='select * from users_applied_jobs where client_token in('.$client_token.')';
$res=  mysqli_query($connection, $query);
$user_id=''; 
        $i=0;

        while($i!=$count){$out= mysqli_fetch_array($res)or die(mysqli_errno($connection));
        
        if($i!=$count-1){
        $user_id .= '"'.$out['user_profile_id'].'",';}
        else{$user_id .= '"'.$out['user_profile_id'].'"';}
        $i++;
        }
        
        

$query='select * from regestration where user_id in('.$user_id.')'; 
$res=  mysqli_query($connection, $query);

        $count= mysqli_num_rows($res);
  
        $i=0;
        $output='';
        while($i!=$count){$out= mysqli_fetch_array($res)or die(mysqli_errno($connection));
         $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($out['user_id'], $connection);
  if($user_last_activity > $current_timestamp)
 {
  $status = '<p class="name text-success">Online</p>';
 }
 else
 {
  $status = '<p class="name text-danger">Offline</p>';
 }
 echo ' 				<li class="contact ">
					<div class="wrap">
						<img src="http://emilcarlsson.se/assets/louislitt.png" alt="" /><!-- frelancer display picture-->
						<div class="meta">
							<p class="name ">'.$out['firstname'].' '.count_unseen_message($out['user_id'],$_SESSION['user_id'],$connection).'</p><!-- frelancer Name-->'.$status.'
                                                            
							<p class="preview"><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$out['user_id'].'" data-tousername="'.$out['firstname'].'">Start Chat</button></p><!-- frelancer Last message-->
						</div>
					</div>
				</li>
        ';
        $i++;}
}
        

        
        