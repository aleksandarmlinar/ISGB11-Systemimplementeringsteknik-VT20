<!doctype html>
<html lang="en" >
	<head>
		<meta charset="utf-8" />
		<title>Ett exempel med kakor</title>
		<style>
			<?php
				//Här kommer koden...
			?>
		</style>
	</head>
	<body>
		<div>
		
			<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
			
				<select name="backgroundcolor">
					<option value="rgb(255, 0, 0)" selected="selected">Red</option>
					<option value="rgb(0, 255, 0)">Green</option>
					<option value="rgb(0, 0, 255)">Blue</option>
				</select>
			
				<select name="foregroundcolor">
					<option value="rgb(255, 0, 0)">Red</option>
					<option value="rgb(0, 255, 0)">Green</option>
					<option value="rgb(0, 0, 255)" selected="selected">Blue</option>
				</select>
			
				<input type="submit" name="btnSend" value="Send" />
				<input type="submit" name="btnReset" value="Reset" />
			
			</form>
		
			<?php
			
				echo( "<pre>" );
				print_r( $_POST );
				print_r( $_COOKIE );
				echo( "</pre>" );
				
			?>
			
		</div>
	</body>
</html>