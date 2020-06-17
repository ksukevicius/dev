<?php
require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	include 'includes/menu.php';
	?>
	

	
	<div class="container my-3 px-0">
		
		<div class="jumbotron mt-3">
			<h2>Image Processing and Generation</h2>
		</div>		
		
		<div>There I want to practice with image libraries</div>
		<hr>
		<pre> var_dump(gd_info());</pre>
		<hr>
		
		<?php
			var_dump(gd_info());
		?>
		<hr>
		
		<div>First thing I had to do is to enable gd2 extension in php.ini file</div>
		<hr>
		<img src="img/enable_gd.png" alt="enable gd image">
	
		<hr>
		The main source of information I use is there: <a href="https://www.php.net/manual/en/book.image.php">Image Processing and GD</a>
		<hr>
		
		<div> The second function I want to text is <pre>getimagesize($filename);</pre> </div>
		<hr>
		<?php
			$filename = "img/enable_gd.png";
			var_dump(getimagesize($filename));
		?>
		<hr>
		<div>The main purpose I've tried to investigate (google about) images is that I need to write function to resize image before uploading to server</div>
		<div> There I found quite simple and clear function to do that. Let's investigate the code and see how it works. </div>
		<hr>
		<div>
<pre>
function resize_image($file, $w, $h, $crop=FALSE) {
	list($width, $height) = getimagesize($file);
	$r = $width / $height;
	if ($crop) {
		if ($width > $height) {
			$width = ceil($width-($width*abs($r-$w/$h)));
		} else {
			$height = ceil($height-($height*abs($r-$w/$h)));
		}
		$newwidth = $w;
		$newheight = $h;
	} else {
		if ($w/$h > $r) {
			$newwidth = $h*$r;
			$newheight = $h;
		} else {
			$newheight = $w/$r;
			$newwidth = $w;
		}
	}
	$src = imagecreatefromjpeg($file);
	$dst = imagecreatetruecolor($newwidth, $newheight);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	return $dst;
}
</pre>
		</div>
		<hr>
		
		<div>
		First had to google what does this part <b>list($width, $height) = getimagesize($file);</b> do. And looks like it just assigns <b> $width, $height </b> variables thats returned by  
		<b> getimagesize($file); </b> function.
		</div>
		<hr>
		<div>
			In my case it's <br>
			<img src="img/sample1.jpg" alt="sample code image">
		</div>
		<hr>
		<div>
			<?php
				$filename = "img/enable_gd.png";
				list($width, $height) = getimagesize($filename);
				echo "Image width: " . $width ."<br>";
				echo "Image height: " . $height ."<br>";
			?>
		</div>
		<hr>
		<div>
		Let's say I want the image to be 200 by 150. 
		Will try to execute the function and see the result.
		So let's add the following to execute:
		<pre>
			$file = "img/enable_gd.png";
			$w = 200;
			$h = 150;
			resize_image($file, $w, $h, $crop=FALSE)
		</pre>
		I found the function there <a href="https://stackoverflow.com/questions/14649645/resize-image-in-php"> StackOverflow </a>
		</div>
		<?php
			$file = "img/sample1.jpg";
			$w = 200;
			$h = 150;
			$img = resize_image($file, $w, $h, $crop=FALSE);		
		?>
		
		<div class="row">
			<div class="col-sm-4">
				<img src="img/resized_info.jpg" alt="resized info image">
			</div>
			<div class="col-sm-8">
				As you see got something working, but need to do some modifications, like to generate new name for resized image, set proper location to save it etc.<br>
				There was an error before because I've tried to resize png file and the original function supperts only jpeg.
				<img src="img/error1.jpg" width="700"  alt="resized info image">
				Ok this kind of works, but need some improvements.
			</div>
		</div>
		
		<div>
			But I found this: imagescale — Scale an image using the given new width and height
			Let's check it out.
		</div>

		<?php
			$image_name =  'img/DSC_0029.JPG';
			$image = imagecreatefromjpeg($image_name); // For JPEG
			$imgResized = imagescale($image , 1920, -1); // width=500 and height = 400
			imagejpeg($imgResized, "ScaledImage.jpg");
		?>
		
		<div> Ok, I've continue working on my "image upload/resize etc" project and today I got the error while trying to test imagescale function </div>
		
		<div> PHP Fatal error:  Allowed memory size of 134217728 bytes exhausted (tried to allocate 20480 bytes) in C:\inetpub\wwwroot\dev2\image_new.php on line 70 </div>
		<div> </div>
		
		
	</div>
	
	
</body>
</html>