<?php
			$query= $link->query('SELECT mtm4057_meme_memes.meme_id , mtm4057_meme_memes.created , mtm4057_meme_memes.top_text , mtm4057_meme_memes.bottom_text , mtm4057_meme_images.file_name , mtm4057_meme_images.image_id 
		FROM mtm4057_meme_memes 

		JOIN mtm4057_meme_images
		ON mtm4057_meme_memes.image_id=mtm4057_meme_images.image_id  

		
		ORDER BY mtm4057_meme_memes.created DESC'

		);


    if($query)
    {

//loop through assoc array
      while($row =$query->fetch(PDO::FETCH_ASSOC)) {

//put the values of each $row array in $data_array
//this is to echo out proper json
//if this is not done and just $row is echoed out the it will be like {} , which is syntax error for json

     $getLikeCount=$link->query('SELECT *  from mtm4057_meme_likes where meme_id = '.$row["meme_id"].'');


      echo'<li>
		<div class="memeImage"><div class="memeTopText">'.$row["top_text"].'</div><img src="images-memes/resized_'.$row["file_name"].'.jpg"><div class="memeBottomText">'.$row["bottom_text"].'</div></div><span class="icon like" id="'.$row["meme_id"].'">Like</span><span class="likes">'.$getLikeCount->rowCount().'</span>
			<time datetime="'.$row["created"].'">'.$row["created"].'</time>
				</li>
      ';
    }
}
       ?> 