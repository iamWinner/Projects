<?php

include( "../includes/db.inc.php");


$limit=$_POST['limit'];

if($_POST['sorttype']=='time' && $limit=='12')
{

	$query= $link->query('SELECT mtm4057_meme_memes.meme_id , mtm4057_meme_memes.likes , mtm4057_meme_memes.created , mtm4057_meme_memes.top_text , mtm4057_meme_memes.bottom_text , mtm4057_meme_images.file_name , mtm4057_meme_images.image_id 
		FROM mtm4057_meme_memes 

		JOIN mtm4057_meme_images
		ON mtm4057_meme_memes.image_id=mtm4057_meme_images.image_id  

		
		ORDER BY mtm4057_meme_memes.created DESC LIMIT 0 , 12'

		);
}
else if($_POST['sorttype']=='time' && $limit=='infinite' )
{


	$query= $link->query('SELECT mtm4057_meme_memes.meme_id , mtm4057_meme_memes.likes , mtm4057_meme_memes.created , mtm4057_meme_memes.top_text , mtm4057_meme_memes.bottom_text , mtm4057_meme_images.file_name , mtm4057_meme_images.image_id 
		FROM mtm4057_meme_memes 

		JOIN mtm4057_meme_images
		ON mtm4057_meme_memes.image_id=mtm4057_meme_images.image_id  

		
		ORDER BY mtm4057_meme_memes.created DESC '

		);

}
else if ($_POST['sorttype']=='trend' && $limit=='12')
{

	$query= $link->query('SELECT mtm4057_meme_memes.meme_id , mtm4057_meme_memes.likes , mtm4057_meme_memes.created , mtm4057_meme_memes.top_text , mtm4057_meme_memes.bottom_text , mtm4057_meme_images.file_name , mtm4057_meme_images.image_id 
		FROM mtm4057_meme_memes 

		JOIN mtm4057_meme_images
		ON mtm4057_meme_memes.image_id=mtm4057_meme_images.image_id  

		
		ORDER BY mtm4057_meme_memes.likes DESC LIMIT 0 ,12'

		);
}
else if($_POST['sorttype']=='trend' && $limit=='infinite' )
{

	$query= $link->query('SELECT mtm4057_meme_memes.meme_id , mtm4057_meme_memes.likes , mtm4057_meme_memes.created , mtm4057_meme_memes.top_text , mtm4057_meme_memes.bottom_text , mtm4057_meme_images.file_name , mtm4057_meme_images.image_id 
		FROM mtm4057_meme_memes 

		JOIN mtm4057_meme_images
		ON mtm4057_meme_memes.image_id=mtm4057_meme_images.image_id  

		
		ORDER BY mtm4057_meme_memes.likes DESC '

		);
}


			


    if($query)
    {

//loop through assoc array
      while($row =$query->fetch(PDO::FETCH_ASSOC)) {

//put the values of each $row array in $data_array
//this is to echo out proper json
//if this is not done and just $row is echoed out the it will be like {} , which is syntax error for json

    


      echo'<li>
		<div class="memeImage"><a href="add-text.php?i='.$row["image_id"].'" class="memeLink"><span class="centerText">Create Your Own Meme</span></a><div class="memeTopText">'.$row["top_text"].'</div><img src="images-memes/resized_'.$row["file_name"].'.jpg"><div class="memeBottomText">'.$row["bottom_text"].'</div></div><span class="icon like" id="'.$row["meme_id"].'">Like</span><span class="likes">'.$row["likes"].'</span>
			<time datetime="'.$row["created"].'">'.$row["created"].'</time>
				</li>
      ';
    }
}
       ?> 