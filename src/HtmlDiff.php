<?php
#
# HtmlDiff  -  A visual diff tool for HTML
#
namespace HtmlDiff;

// Include depedencies from composer
require 'vendor/autoload.php';


class HtmlDiff {

	public function htmlToMarkdown($inputHtml)
	{
		$converter = new \Markdownify\Converter;
	
		// Convert html to markdown
		$outputMd = $converter->parseString($inputHtml);

		return $outputMd;
	}

}