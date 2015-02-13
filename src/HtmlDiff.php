<?php
#
# HtmlDiff  -  A visual diff tool for HTML
#
namespace HtmlDiff;

class HtmlDiff {

	private $root = ''; // Root directory of class file

	public function __construct()
	{
		$this->root = dirname(__FILE__);
	}

	public function htmlToMarkdown($inputHtml)
	{
		$converter = new \Markdownify\Converter;
	
		// Convert html to markdown
		$outputMarkdown = $converter->parseString($inputHtml);

		return $outputMarkdown;
	}

	public function createFile($filePath, $fileContent)
	{	
		try {

			if ( !($handle = fopen($filePath, "w")) ) {
				 throw new Exception("Unable to open file!");
			}

		} catch (Exception $e) {
 
		    echo "Message: " . $e->getMessage() . "<br />";
		    echo "File: " . $e->getFile() . "<br />";
		    echo "Line: " . $e->getLine();

		}

		fwrite($handle, $fileContent);
		fclose($handle);

	}

	public function diffMarkdown($oldFilePath, $newFilePath, $diffFilePath)
	{
		try {
    		shell_exec('wdiff ' . $oldFilePath . ' ' . $newFilePath . ' | ' . $this->root . '/markdown-format-wdiff >' . $diffFilePath);
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function markdownToHtml($inputMarkdown)
	{
		$converter = new \Michelf\Markdown;

		// Convert markdown to html
		$outputHtml = $converter->transform($inputMarkdown);

		return $outputHtml;
	}

	// main method
	public function diff($oldHtml, $newHtml)
	{	
		// transforms html input into markdown files
		$inputOld = $this->htmlToMarkdown($oldHtml);
		$this->createFile("old.md", $inputOld);
		$inputNew = $this->htmlToMarkdown($newHtml);
		$this->createFile("new.md", $inputNew);

		// diffs markdown files to new file
		$this->diffMarkdown('old.md', 'new.md', 'changes.md');

		// transforms diff markdown back to html
		$htmlOutput = $this->markdownToHtml(file_get_contents('changes.md'));

		return $htmlOutput;
	}
}
