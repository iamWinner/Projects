<?php
/***
Accept an mime id and fetch the ip address from the user
$_POST['memeid'] will be in the data received

Check in the likes table to see if there is a match for
the pair (image id and ip address).
If there is no match then increment the likes count for the image
in the mtm4057_meme_memes table.

Return a JSON data object that looks like this:

Successful
{"code":0, "msg":"Like recorded", "meme_id":23, "likes":10}

Failures
{"code":100, "msg":"IP address already used to like this Meme.", "meme_id":23}
{"code":200, "msg":"Meme does not exist", "meme_id":23}
{"code":300, "msg":"Unable to record the Like", "meme_id":23}

Notice that all errors have a NON-zero value for code.
**/
include( "../includes/db.inc.php");
if(isset($_POST['memeid']) && !empty($_POST['memeid']) )
{

//https://www.virendrachandak.com/techtalk/getting-real-client-ip-address-in-php-2/
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

$ip	=get_client_ip_env();

$existCheck = $link->prepare('SELECT * from mtm4057_meme_likes 
					  WHERE meme_id=:mi AND ip_address=:ia');
$existCheck->execute(array(

				'mi'=> $_POST['memeid'], 
	        	'ia'=> $ip
	));


$count = $existCheck->rowCount();
if($count==0)
{
	$strSQL = "INSERT INTO mtm4057_meme_likes( meme_id ,  ip_address )
	              VALUES( :mi, :ia)";
	        $rs = $link->prepare($strSQL);

	        $rs->execute( array(

	        	'mi'=>$_POST['memeid'], 
	        	'ia'=>$ip

	        	) );


	        if($rs)
	        {
	        	$newCountQry = $link->prepare('SELECT * from mtm4057_meme_likes 
					  WHERE meme_id=:mi');
				$newCountQry->execute(array(

				'mi'=> $_POST['memeid']
	        
	));
				$newcount = $newCountQry->rowCount();

				$msgArray = array(
					"code" => 0,"msg" => "Like recorded","meme_id" => $_POST['memeid'] , "likes"=>$newcount
				);

				$updateLikes = $link->prepare('UPDATE mtm4057_meme_memes SET likes = :li
					  WHERE meme_id=:mi');

				$updateLikes->execute(array(
				'li'=> $newcount,
					
				'mi'=> $_POST['memeid']
	        ));
	

				echo json_encode($msgArray);  
	        }

	    
}

else{
		$msgArray = array(
					"code" => 100,"msg" => "IP address already used to like this Meme.","meme_id" => $_POST['memeid']
				);
	
	echo json_encode($msgArray);
}



session_start();



//check in the likes table to see if there is a match for BOTH the ip address and meme_id
//if not, insert the ip address and meme_id
//Next get the count of rows that match the meme_id
//then output the proper JSON string, formatted like above.
}
?>