<?php

// Include depedencies from composer
require 'vendor/autoload.php';

use HtmlDiff\HtmlDiff;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamDirectory;

class HtmlDiffTest extends PHPUnit_Framework_TestCase {

	// on test start
	public function setUp()
	{
		// create instance of htmlDiff
		$this->htmlDiff = new HtmlDiff;

		// delete markdown files if they exist in order to get true results of tests
		foreach (['old.md', 'new.md', 'changes.md'] as $file) {
			if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file) === true) {
            	unlink(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file);
        	}
		}
	}

	// on test end
	protected function tearDown()
    {	
    	// delete markdown files if they exist in order to get true results of tests
    	foreach (['old.md', 'new.md', 'changes.md'] as $file) {
			if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file) === true) {
            	unlink(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file);
        	}
		}
    }

	public function testItShouldConvertEmptyHtmlToMarkdown()
	{
		$this->assertEquals('', $this->htmlDiff->htmlToMarkdown(''));
	}

	public function testItShouldConvertValidHtmlToMarkdown()
	{
		$inputHtml = '<strong>Text</strong>';
		$outputMarkdown = '**Text**';
		$this->assertEquals($outputMarkdown, $this->htmlDiff->htmlToMarkdown($inputHtml));
	}

	public function testItShouldCreateAMarkdownFile()
	{	
		vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('root'));

        $fileName = 'markdown.md';
		$filePath = vfsStream::url('root' . DIRECTORY_SEPARATOR . $fileName);
		$fileContent = '**Text**';

		$this->htmlDiff->createFile($filePath, $fileContent);

		$this->assertTrue(file_exists($filePath));
		$this->assertEquals($fileContent, file_get_contents($filePath));
		$this->assertTrue(is_writable($filePath));

	}

	public function testItShouldCreateADiffFile()
	{

        $oldFilePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'old.md';
        $oldFileContent = 'Old Text';
        $this->htmlDiff->createFile($oldFilePath, $oldFileContent);

        $newFilePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'new.md';
        $newFileContent = 'New Text';
        $this->htmlDiff->createFile($newFilePath, $newFileContent);

		$diffFilePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'changes.md';
		$diffFileContent = '<del class="del">Old</del><ins class="ins">New</ins> Text';
		$diffFileContent .= "\n\n";
		$diffFileContent .= '<style>';
		$diffFileContent .= "\n";
		$diffFileContent .= '    .del,.ins{ display: inline-block; margin-left: 0.5ex; }';
		$diffFileContent .= "\n";
		$diffFileContent .= '    .del     { background-color: #fcc; }';
		$diffFileContent .= "\n";
		$diffFileContent .= '         .ins{ background-color: #cfc; }';
		$diffFileContent .= "\n";
		$diffFileContent .= '</style>';
		$diffFileContent .= "\n\n";

		$this->htmlDiff->diffMarkdown($oldFilePath, $newFilePath, $diffFilePath);
		$this->assertTrue(file_exists($diffFilePath));
		$this->assertEquals($diffFileContent, file_get_contents($diffFilePath));
		$this->assertTrue(is_writable($diffFilePath));

	}

	public function testItShouldConvertMarkdownToHtml()
	{
		$inputMarkdown = '# Text';
		$outputHtml = '<h1>Text</h1>';
		$outputHtml .= "\n";
		$this->assertEquals($outputHtml, $this->htmlDiff->markdownToHtml($inputMarkdown));
	}

	public function testItShouldRunTheCompleteWorkflow()
	{
		$oldHtml = '<h1>Old text</h1>';
		$newHtml = '<h1>New text</h1>';

		$outputHtml = '<h1><del class="del">Old</del> <ins class="ins">New</ins> text</h1>';
		$outputHtml .= "\n\n";
		$outputHtml .= '<style>';
		$outputHtml .= "\n";
		$outputHtml .= '    .del,.ins{ display: inline-block; margin-left: 0.5ex; }';
		$outputHtml .= "\n";
		$outputHtml .= '    .del     { background-color: #fcc; }';
		$outputHtml .= "\n";
		$outputHtml .= '         .ins{ background-color: #cfc; }';
		$outputHtml .= "\n";
		$outputHtml .= '</style>';
		$outputHtml .= "\n";

		$this->assertEquals($outputHtml, $this->htmlDiff->diff($oldHtml, $newHtml));
	}

}