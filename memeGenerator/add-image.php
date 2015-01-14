<?php
/*********************************
Add Image page allows the user to
add a new image to the database
Do all the image processing at the top

After the user saves a new image
then the page should display a link
to the create-meme.php page

New image_id is to be sent through
$_GET or $_SESSION
*********************************/
include( "includes/db.inc.php");

include_once "process/resize.php";




if(isset($_POST['btnUpload'])){
	if(isset($_POST['title']) && !empty($_POST['title']))
	{
		$imageTitle=$_POST['title'];
	}
	else
	{
		$imageTitle='Meme Image';
	}
	$maxImgSize=10240000;
  //user is attempting to give us a file
  if( $_FILES['imgUpload']['error']==0 && $_FILES['imgUpload']['size'] > 0){
    switch( $_FILES['imgUpload']['type'] ){
      case 'image/jpg':
      case 'image/jpeg':
      case 'image/pjpeg':
        $imgExt = ".jpg";
        $fileExt="jpg";
        break;
      case 'image/gif':
        $imgExt = '.gif';
        $fileExt="gif";
        break;
      case 'image/png':
        $imgExt = '.png';
        $fileExt="png";
        break;
      default:
        $imgExt = 'EpicFail';
    }
    if($imgExt != 'EpicFail'){
    	if($_FILES['imgUpload']['size'] < $maxImgSize){
    		
    		$extFreeFilename=md5($_FILES['imgUpload']['name']) . "_" . time();
	 	 $customName = md5($_FILES['imgUpload']['name']) . "_" . time() . $imgExt;

	      $dir = "images-memes/";
	      $fileUploaded=$dir.$customName;
	      //now move the file from the temp folder to its new location
	      $ret = move_uploaded_file($_FILES['imgUpload']['tmp_name'] , $fileUploaded);
	      if($ret){
	        //$infoMsg = "I have saved the file " . $_FILES['imgUpload']['name'] . " as " . $dir . $safename . "!";

	        $size = getimagesize($fileUploaded);
    		$minWidth = 400;
   		    $minHeight = 400;

   		    $target_file = $fileUploaded;
			$resized_file = $dir."resized_".md5($_FILES['imgUpload']['name']) . "_" . time().".jpg";
			$wmax = 400;
			$hmax = 400;


			
   		   
    if ($size[0] >= $minWidth && $size[1] >= $minHeight )
    {
        ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

        $mime = $_FILES['imgUpload']['type'];
	        $friendlyName = str_replace(" ", "-", trim($_POST["title"]));
	        $filesize = $_FILES['imgUpload']['size']; //or filesize($dir . $ob_filename) 
	        $strSQL = "INSERT INTO mtm4057_meme_images(file_name, mime_type, file_size , image_title )
	              VALUES( :cn, :mt, :fs , :it)";
	        $rs = $link->prepare($strSQL);

	        $rs->execute( array(

	        	'cn'=>$extFreeFilename,
	        	'mt'=> $mime, 
	        	'fs'=>$filesize,
	        	'it'=>$imageTitle

	        	) );

	         $lastid=$link->lastInsertId(' mtm4057_meme_images');

	        if($rs){
	          $feedback = 'Image information has been saved in the database.';
	          $newuploadedfile= '<img src="'.$dir.'resized_'.$extFreeFilename.'.jpg">';
	         
	         // $newuploadedfile= 'resized_.';
	          //
	          //the write to the database worked.
	        }else{
	          //the db failed so we should delete the image
	          $feedback = 'Nothing saved due to database failure';
	          unlink($fileUploaded);        //php command for deleting a file (comes from unix command)
	        }
   		 }else  {
    
  
    	unlink($fileUploaded);
    	$feedback = 'Need  file size dimensions greater than 500px.';
    }

	        
	      }else{
	        $feedback = "You must have done something wrong cuz it wasn't me!";
	      }
     }else{
     	$feedback = 'Hey! control your file size';
     }
    
    }else{
      $feedback = 'Hey! That is NOT an image';
    }
  }else{
    //there WAS an error
    switch($_FILES['imgUpload']['error']){
      case 1:
      case 2:
        $feedback = 'The file was too large. Not saved.';
        break;
      case 3:
        $feedback = 'The file was only partially uploaded. Network problem occurred.';
        break;
      case 4:
        $feedback = 'No file uploaded.';
        break;
      case 6:
        $feedback = 'The temp folder was missing or unavailable on the server';
        break;
      case 7:
        $feedback = 'Unable to write the file to disk.';
        break;
      case 8:
        $feedback = 'Virus potentially detected or invalid file extension.';
        break;
      default:
        $feedback = 'The uploaded file was empty.';
        //errorcode was zero but so was the filesize
    }
  }
}
session_start();


?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Upload - Meme Generator</title>
	<?php
	include_once( "includes/scripts.inc.php");
	?>
</head>

<body>
	<div class="wrapper uploadPage">
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
		The width and height of Image must be atleast 400px respectively.<br>
		If Width and Height are not Equal, image might get distorted.<br>
		</div>
		<div id="uploadImageContainer">
			<h2 >Upload a New Image to Start a Meme</h2>
			

			
			<form name="addImage" action="add-image.php" method="post" enctype="multipart/form-data">
				<div class="formbox">
					<label for="title">Meme Title</label>
					<input type="text" name="title" id="title" value="" placeholder="title" />
				</div>
				<div class="formbox">
					<label for="img">Image</label>
					<input type="file" name="imgUpload" id="imgUpload" />
				</div>
				<div class="formbox buttons">
					<input type="submit" name="btnUpload" id="btnUpload" value="Upload" />
				</div>
			</form>
			<?php
			//display feedback about the image being uploaded successfully here
			//if the image was uploaded successfully then display a link to the add-text page too.
			if(isset($feedback))
			{
				echo '<div id="feedback">'.$feedback.'</div>';
				
				
			}

			if(isset($newuploadedfile))
			{
				
				echo '<div id="newuploadedfile"><h3>Upload Image Sample</h3>'.$newuploadedfile.'<a href="add-text.php?i='.$lastid.'">Create a Meme</a></div>';
				
				
			}

			?>
			</div>
		</section>
		
		<footer class="footer">
			<?php
			include_once("includes/footer.inc.php");
			?>
		</footer>
	</div>
	<script  type="text/javascript" src="js/custom.js"></script>
</body>
</html>