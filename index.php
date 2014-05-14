<?php
	define("ABSPATH", dirname(__FILE__));
	define("ABSURL", "http://" . $_SERVER['SERVER_NAME'] . "/ccard/2010/");
	$version = "1.0";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Christmas 2010 &mdash; v<?php echo $version; ?></title>
		<link rel="stylesheet" type="text/css" href="_styles/styles.css" />
		<script type="text/javascript">
		
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-96981-7']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
	</head>
	<body>
		<div id="header">
			<h1><a href="/ccard/2010/">MilesRauschFamily.com</a></h1>
		</div>
		
		<div id="main">
			<?php
			switch($_GET['p']) {
				case 'game':
					include_once('_content/game.php');
					break;
				
				case 'about':
					include_once('_content/about.php');
					break;
				
				case 'intro':
				default:
					include_once('_content/intro.php');
					break;
			}
			?>
		</div>
		
		<script language="javascript" type="text/javascript" src="_scripts/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="_scripts/jquery-ui.min.js"></script>
		<script language="javascript" type="text/javascript" src="_scripts/scripts.js"></script>
	</body>
</html>
