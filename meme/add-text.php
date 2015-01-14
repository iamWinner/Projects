<?php
/*********************************
Add text page takes the image_id 
from the $_GET or $_SESSION array

Then fetch the info from the database
based on the image id.

let the users enter text and then 
save that text associated with the image.
When the page reloads after saving the text
it should display a sample of the image
with the text added to the top and bottom.

Make sure you scale the text to cover a reasonable 
amount of space at the top and bottom.
Set a font-size appropriate for the 
amount of text and the size of the image.
*********************************/


	$image_id=$_GET["i"];

include( "includes/db.inc.php");

session_start();
if(isset($_POST['btnSubmitMeme']))
{
	$upperText=$_POST['top-text'];
	$bottomText=$_POST['bottom-text'];
	$imageId=$_POST['imageID'];
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

	$strSQL = "INSERT INTO mtm4057_meme_memes( image_id,  top_text, bottom_text , ip_address )
	              VALUES( :iid, :tt, :bt , :ia)";
	        $rs = $link->prepare($strSQL);

	        $rs->execute( array(

	        	'iid'=> $imageId, 
	        	'tt'=> $upperText, 
	        	'bt'=>$bottomText,
	        	'ia'=>$ip

	        	) );

	 header('location: index.php');

}


?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Create A Meme - Meme Generator</title>
	<?php
	include_once( "includes/scripts.inc.php");
	?>
</head>

<body>

	<div class=" imagesPage wrapper">
		<header class="masthead">
			<?php
			include_once("includes/masthead.inc.php");
			?>
		</header>
		
		<nav class="nav" role="navigation">
			<?php
			include_once("includes/nav.inc.php");
			?>	
		</nav>
		
		<section class="main menuActive">
		
		<div id="ins">
		No more than 11 letters allowed  in top Text section.<br>
		No more than 11 letters allowed  in bottom Text section.<br>
	

		</div>
			<h2>Add Your Text to the Meme Image</h2>
			<?php
			//if the form is uploaded and the image text is saved then
			//display the image with the text here just to show that it worked.
			
			?>
			<form id="addTextForm" name="memeForm" action="add-text.php?i=<?php echo $image_id  ?>" method="post">
			<input type="hidden" name="imageID" value="<?php echo $image_id ?>">
				<div class="formbox">
					<label for="top-text">Top Text</label>
					<input maxlength="11" type="text" name="top-text" id="top-text" placeholder="top text" />
				</div>

				<div class="formbox" id="formImgContainer">
				<div id="topTextShow"><span></span></div>
				<?php
			 $query= $link->query('SELECT * FROM mtm4057_meme_images WHERE image_id='.$image_id);

    if($query)
    {


     $row =$query->fetch(PDO::FETCH_ASSOC);
      echo'<img src="images-memes/resized_'.$row["file_name"].'.jpg">';
        
}
       ?> 
       <div id="bottomTextShow"><span></span></div>
       </div>
				
				<div class="formbox">
					<label for="bottom-text">Bottom Text</label>
					<input maxlength="11" type="text" name="bottom-text" id="bottom-text" placeholder="bottom text" />
				</div>
				<div class="formbox buttons">
					<input type="submit" name="btnSubmitMeme" id="btnSubmitMeme" value="Create Meme" />
				</div>
			</form>
			
		</section>
		
		<footer class="footer">
			<?php
			include_once("includes/footer.inc.php");
			?>
		</footer>
	</div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script  type="text/javascript" src="js/custom.js"></script>
</html>