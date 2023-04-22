<!DOCTYPE html>
<html>
<head>
	<title>Remote Keyboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <button type="button" class="big-button" id="reset">Restart</button>
 
	<div id="keyboard">
		<?php
		for ($i = 1; $i <= 10; $i++) {
			echo '<div class="key" id="key' . $i . '" data-id="' . $i . '"></div>';
		}
		?>
	</div>
	<div id="controls">
		<button id="acquire-control" >Take Control</button>
	</div>
    <input type="hidden" value="<?= (@$_GET['user'])?$_GET['user']:1?>" id="user">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>

</body>
</html>
