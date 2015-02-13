<?php
require 'vendor/autoload.php';

// If form was sent, process input
if (isset($_POST["submit"])) {
	try {
		$htmlDiff = new HtmlDiff\HtmlDiff;
    	$html_output = $htmlDiff->markdownToHtml(file_get_contents('changes.md'));
	} catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>3- Markdown to HTML</title>
<link type="text/css" rel="stylesheet" href="src/main.css">
</head>
<body>
	<form method="post">
		<input type="submit" name="submit" value="Get HTML">
	</form>
	<br /><br />
	<h2>Output</h2>
	<?php echo isset($html_output) ? $html_output : ''; ?>
</body>
</html>