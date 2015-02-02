<?php
require 'vendor/autoload.php';

// If form was sent, process input
if (isset($_POST["submit"]) && isset($_POST["input_old_html"]) && isset($_POST["input_new_html"])) {
	$converter = new Markdownify\Converter;
	
	// Convert old html to markdown file
	$input_old = $converter->parseString($_POST['input_old_html']);
	$file_old = fopen("old.md", "w") or die("Unable to open file!");
	fwrite($file_old, $input_old);

	// Convert new html to markdown file
	$input_new = $converter->parseString($_POST['input_new_html']);
	$new_file = fopen("new.md", "w") or die("Unable to open file!");
	fwrite($new_file, $input_new);
	
	$message = 'Markdown files "old.md" and "new.md" created';
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>1-HTML to Markdown</title>
<link type="text/css" rel="stylesheet" href="src/main.css">
</head>
<body>
	<form method="post">
		<h2>Old HTML Input</h2>
		<textarea name="input_old_html" cols="140" rows="20">
			<h4>A Example for markdown-diff</h4>

			<ul>
			<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veinam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
			<li><em>Lorem ipsun dolar sit amet, consectetur asipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerciration ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit amin di est laborum.</em></li>
			<li><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temopr incidident ut labore et dolroe magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute ilure dolor in reprehenderit in voluptate velit esse dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad nimin veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluputate velit esse cillum dolore eu nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
			</ul>
		</textarea>
		<br />
		<h2>New HTML Input</h2>
		<textarea name="input_new_html" cols="140" rows="20">
			<h4>An Example for Markdown-Diff</h4>

			<ul>
			<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
			<li><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></li>
			<li><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</strong></li>
			<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
			</ul>
		</textarea>
		<br /><br />
		<input type="submit" name="submit">
	</form>
	<br /><br />
	<?php echo isset($message) ? '<div class="success">'.$message.'</div>' : ''; ?>
	<br />
	<p>Next step > <a href="2-diff-markdown.php">Diff obtained Markdown</a></p>
</body>
</html>