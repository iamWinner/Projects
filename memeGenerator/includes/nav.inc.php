<?php


if(	isset($_SESSION['sorter']))
	{
		$sorttype=$_SESSION['sorter'];
	}
	else
	{
		$sorttype='time';
	}



?>
<a id="closeNav">X</a>


		<img src="img/logo.svg">
<ul class="mainnav">

				<li><a href="index.php">Meme Home</a></li>
				<li><a href="list-images.php">Create A Meme</a></li>
				<li><a href="add-image.php">Upload An Image</a></li>
			</ul>
			<a id="viewMore">View All</a>