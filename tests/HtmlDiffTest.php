<?php

// Include depedencies from composer
require 'vendor/autoload.php';

use HtmlDiff\HtmlDiff;

class HtmlDiffTest extends PHPUnit_Framework_TestCase {

	public function setUp()
	{
		$this->htmlDiff = new HtmlDiff;
	}

	public function testItShouldConvertAnEmptyString()
	{
		$this->assertEquals('', $this->htmlDiff->htmlToMarkdown(''));
	}

	public function testItShouldConvertValidHtml()
	{
		$inputHtml = '<strong>Text</strong>';
		$this->assertEquals('**Text**', $this->htmlDiff->htmlToMarkdown($inputHtml));
	}

}