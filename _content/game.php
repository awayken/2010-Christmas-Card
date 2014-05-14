<?php
## Game Methods
	function loop_outfit($outfit) {
		$dir = "_images/" . $outfit;
		$path = opendir(constant("ABSPATH") . "/" . $dir);
		
		while (($file = readdir($path)) !== false) {
			if ($file{0} == '.') {
				continue;
			} else {
				echo '<li><img src="' . $dir . '/' . $file . '" /></li>' . "\n";
			}
		}
	}

	## If we're saving an outfit...
	if (isset($_POST['game-submit']) && $_POST['game-submit'] == "save" && isset($_POST['game-submit-email']) && strlen($_POST['game-submit-email'])) {
		$const_ABSURL = constant("ABSURL");
		$to = $_POST['game-submit-email'];
		$subject = "Happy Holidays 2010 from the Miles Rausch Family!";
		$message = "";
		
		$headers  = "From: The Miles Rausch Family <info@milesrauschfamily.com>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		
		if (isset($_POST['game-shirt']) && strlen($_POST['game-shirt'])) {
			$shirt_url = $_POST['game-shirt'];
		} else {
			$shirt_url = "_images/shirt.png";
		}
		$shirt_url = $const_ABSURL . str_replace('_images/', '_images/email/', $shirt_url);
		
		if (isset($_POST['game-pants']) && strlen($_POST['game-pants'])) {
			$pants_url = $_POST['game-pants'];
		} else {
			$pants_url = "_images/pants.png";
		}
		$pants_url = $const_ABSURL . $pants_url;
		
		if (isset($_POST['game-feet']) && strlen($_POST['game-feet'])) {
			$feet_url = $_POST['game-feet'];
		} else {
			$feet_url = "_images/feet.png";
		}
		$feet_url = $const_ABSURL . $feet_url;
		
		$message .= <<<EOD
<html>
	<head>
		<title>$subject</title>
	</head>
	<body style="text-align: center;">
		<table style="width: 800px; margin: 0 auto; text-align: center;">
			<tr>
				<td colspan="3">
					<img src="${const_ABSURL}_images/email/h1.png" width="796" height="76" />
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<p>It's been <a href="$const_ABSURL">an incredible 2010</a>, and we're looking forward to 2011. With your help, Ian is finally dressed and ready to go!</p>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: middle; text-align: right;">
					<img src="${const_ABSURL}_images/email/miles-paper-doll.png" alt="Miles Rausch" width="216" height="500" />
				</td>
				<td style="vertical-align: middle; width: 220px;">
					<img src="$shirt_url" width="216" height="222" alt="Ian's shirt." />
					<img src="$pants_url" width="216" height="69" alt="Ian's pants." />
					<img src="$feet_url" width="216" height="41" alt="Ian's feet." />
				</td>
				<td style="vertical-align: middle; text-align: left;">
				<img src="${const_ABSURL}_images/email/holli-paper-doll.png" alt="Holli Rausch" width="216" height="500" />
				</td>
			</tr>
		</table>
	</body>
</html>
EOD;
		
		$status = mail($to, $subject, $message, $headers);
		
		if ($status) {
?>
<div id="game-success">
	<h3>Your Holiday eCard Is On Its Way!</h3>
	
	<p>Thanks to your help, Ian is finally dressed and ready to go. A delightful illustration of Ian wearing your outfit is buzzing through the Internet tubes straight to your e-mail. (If you don't see it right away, check your junk mail or spam folder.)</p>
	
	<p>It's been an incredible 2010! Take some time to read about our year (and outfits) on <a href="?p=about">our About page</a>, and thanks for playing!</p>
</div>
<?php
		} else {
?>
<div id="game-failure">
	<h3>Oh Noes!</h3>
	
	<p>Something went wrong when we tried to e-mail this delightful illustration of Ian wearing your outfit. It's almost certainly a problem on our end, and we're really, really sorry.</p>
	
	<p>If you feel up to it, you can <a href="?p=game">try again</a>. If you just need a moment to yourself, take some time to read about our year (and outfits) on <a href="?p=about">our About page</a>, and thanks for playing!</p>
</div>
<?php
		}
	} else {
	?>
<div id="game">
	<h2>Dress Ian</h2>
	
	<form name="game-form" action="?p=game&amp;s=email" method="post">
		<div class="instructions">
			<strong>Instructions:</strong> To dress Ian, click and drag an article of clothing from the drawer on the right and drop it onto Ian on the left. When you have an outfit you like, just fill in your e-mail address, click send, and prepare to be eCarded. Happy Holidays!
		</div>
		
		<div class="dragdrop">&larr; Drag and drop &larr;</div>
		
		<div class="finished">&darr; Finished? Send your card! &darr;</div>
	
		<div class="drawer">
			<h3>Outfits</h3>
			
			<h4>Shirts</h4>
			<ul id="game-shirts">
				<?php loop_outfit("shirt"); ?>
			</ul>
			
			<h4>Pants</h4>
			<ul id="game-pants">
				<?php loop_outfit("pants"); ?>
			</ul>
			
			<h4>Shoes</h4>
			<ul id="game-feet">
				<?php loop_outfit("feet"); ?>
			</ul>
		</div>
	
		<div id="ian">
			<div id="ian-head"><img src="_images/head.png" width="216" height="107" alt="Ian's head." title="Look at that smile!" /></div>
			<div id="ian-shirts">
				<img src="_images/shirt.png" width="216" height="141" alt="Ian's upper torso." title="Choose a shirt from the drawer on the side." />
				<input type="hidden" name="game-shirt" id="game-ian-shirt" value="" />
			</div>
			<div id="ian-pants">
				<img src="_images/pants.png" width="216" height="69" alt="Ian's lower torso." title="Choose pants from the drawer on the side." />
				<input type="hidden" name="game-pants" id="game-ian-pants" value="" />
			</div>
			<div id="ian-feet">
				<img src="_images/feet.png" width="216" height="41" alt="Ian's feet." title="Choose shoes from the drawer on the side." />
				<input type="hidden" name="game-feet" id="game-ian-feet" value="" />
			</div>
			
			<a id="game-submit-clear" href="?p=game"><img src="_images/clear.png" alt="clear" width="85" height="26" /></a>
		</div>
		
		<div class="controls">
			<fieldset>
				<label for="game-submit-email">Your e-mail address:</label>
				<input type="text" name="game-submit-email" id="game-submit-email" value="" />
				<button name="game-submit" id="game-submit-ok" value="save"><img src="_images/send.png" alt="send" width="140" height="42" /></button>
			</fieldset>
		</div>
		
	</form>
</div>
<?php
}