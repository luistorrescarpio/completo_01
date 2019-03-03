<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vista Previa de Interfaces</title>
</head>
<body>
	<?php 
	$dirname = "images/";
	$images = glob($dirname."*.png");
	echo "<center>";
	$c = 0;
	foreach($images as $imgRoute) {
		$c++;
		$fileName = basename($imgRoute); 

		echo "<div>{$c}) {$fileName}</div>";
	    echo '<img src="'.$dirname.$fileName.'" style="box-shadow:3px 3px 10px #999;max-width: 400px;"/><br/><br/>';
	}
	echo "</center>";

	?>
</body>
</html>