<?php
	//Här kommer koden...

	function deleteSession() {

		session_unset();

		if( ini_get("session.use_cookies") ) {

			$sessionCookieData = session_get_cookie_params();

			$path = $sessionCookieData["path"];
			$domain = $sessionCookieData["domain"];
			$secure = $sessionCookieData["secure"];
			$httponly = $sessionCookieData["httponly"];

			$name = session_name();

			setcookie($name, "", time() - 3600, $path, $domain, $secure, $httponly);

		}

		session_destroy();

	}

	session_start();
	session_regenerate_id( true );

	$css = "body { color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); }";
	$disabled = true;

	if( isset( $_POST["btnSend"])) {

		$fgColor = $_POST["foregroundcolor"];
		$bgColor = $_POST["backgroundcolor"];

		$_SESSION["fgColor"] = $fgColor;
		$_SESSION["bgColor"] = $bgColor;

		$css = "body{ color: $fgColor; background-color: $bgColor }";

		$disabled = false;

	}

	if( isset($_POST["btnReset"])){
		deleteSession();
	}

	if(!isset($_POST["btnSend"]) && !isset($_POST["btnReset"]) && isset($_SESSION["bgColor"]) && isset($_SESSION["fgColor"])) {
		
		$fgColor = $_SESSION["fgColor"];
		$bgColor = $_SESSION["bgColor"];

		$css = "body{ color: $fgColor; background-color: $bgColor }";

		$disabled = false;
	}

	if(!isset($_POST["btnSend"]) && 
		!isset($_POST["btnReset"]) && 
		!isset($_SESSION["bgColor"]) && 
		!isset($_SESSION["fgColor"])) {
			deleteSession();
	}

?>
<!doctype html>
<html lang="en" >
	<head>
		<meta charset="utf-8" />
		<title>Ett exempel med sessioner</title>
		<style>
			<?php
				//Här en utskrift av CSS-text!
				echo( $css );
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
				<input type="submit" name="btnReset" value="Reset" <?php if( $disabled ) { echo("disabled"); } ?> />
			
			</form>
		
			<?php
			
				echo( "<pre>" );
				print_r( $_POST );
				print_r( $_SESSION );
				echo( "</pre>" );
				
			?>
			
		</div>
	</body>
</html>