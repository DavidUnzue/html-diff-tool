<?php
// If form was sent, process input
if (isset($_POST["submit"])) {
	try {
    	shell_exec('wdiff old.md new.md | ./src/markdown-format-wdiff >changes.md');
	} catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	$output = file_get_contents('changes.md');

	$message = 'Markdown file "changes.md" created';
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>2- Diff Markdown</title>
<link type="text/css" rel="stylesheet" href="src/main.css">
</head>
<body>
	<form method="post">
		<input type="submit" name="submit" value="Run diff">
	</form>
	<br /><br />
	<h2>Output</h2>
	<pre><?php echo isset($output) ? $output : ''; ?></pre>
	<br />
	<?php echo isset($message) ? '<div class="success">'.$message.'</div>' : ''; ?>
	<br />
	<p>Next step > <a href="3-markdown-to-html.php">Markdown to HTML</a></p>
</body>
</html>