<?php
/*********************************
Home page fetches a list of the newest memes
and displays up to 12 of them
$_SESSION variable determines whether to sort the
list based on age of meme or most liked.
http://themeforest.net/item/division-fullscreen-portfolio-photography-theme/full_screen_preview/5030589?ref=cirvitis&ref=cirvitis&clickthrough_id=303531163&redirect_back=true
*********************************/


session_start();
include( "/includes/db.inc.php");

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Home - Meme Generator</title>
	<?php
	include_once( "includes/scripts.inc.php");
	?>

</head>

<body>
	<div class="wrapper mainPage" >
		<header class="masthead">

			<?php
			if(isset($_POST['switchtype']))
{
	$_SESSION['sorter']=$_POST['switchtype'];
	echo "<script>alert(".$_SESSION['sorter'].")</script>";

	
}
if(	isset($_SESSION['sorter']))
	{
		$sorttype=$_SESSION['sorter'];
		echo'<input id="sortCollector" type="hidden" value="'.$sorttype.'">';
	}
	else
	{
		$sorttype='time';
		echo'<input id="sortCollector" type="hidden" value="'.$sorttype.'">';
	}





			include_once("includes/masthead.inc.php");
			?>


		</header>
		
		<nav class="nav" role="navigation">
			<?php
			include_once("includes/nav.inc.php");
			?>	
		</nav>
		
		<section class="main imagesIn menuActive" >

			<h2 id="mainHead"><span>Latest Generated Memes</span>
		<span>Top Trending Memes</span>
				
			</h2>
				<div id="switchContainer"><a class="switch" data-sort="time">Latest</a><a class="switch" data-sort="trend">Trending</a></div>
			
			<ul id="indexMemes" class="memes">
			<?php

       ?> 
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_123">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_125">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_127">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_129">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_131">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_133">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_135">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_137">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_138">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
				<li>
					<img src="images-memes/missing.png" alt="meme image" />
					<span class="icon like" id="meme_139">Like</span><span class="likes">0</span>
					<time datetime="2013-11-11">11 Nov, 2013</time>
				</li>
			</ul>
			
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