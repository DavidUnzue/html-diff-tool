# Deprecation notice
This project will not be further maintained. Furthermore, due to some incorrect results of comparing markdownified HTML with wdiff, its not recommended to use HtmlDiff anymore.
For the purpose of generating a Diff of HTML Snippets I recommend using [@mkalkbrenner's fork of php-htmldiff](https://github.com/mkalkbrenner/php-htmldiff).

**I'm keeping the repository here as a reference for future coding projects**

---

# HtmlDiff
HtmlDiff is a PHP Class for showing the differences between two pieces of HTML. HtmlDiff converts each piece of HTML code into Markdown, creates a diff-file of the two Markdown files, and transforms it back to a single HTML output. As a result, you get a styled html diff, showing the differences between the original files in a visual way.

# Why convert to Markdown?
The idea behind HtmlDiff was that Markdown syntax is easier to diff then HTML, because Markdown is just plain text and much simpler. Thus, although HtmlDiff has the ability to process extra markdown, it is not supposed to be used with complex HTML.

# Requirements/Dependecies
* https://github.com/Elephant418/Markdownify
* https://github.com/netj/markdown-diff
* https://michelf.ca/projects/php-markdown/classic/
* Wdiff: http://www.gnu.org/software/wdiff/

# Installation
HtmlDiff uses Composer (http://getcomposer.org/) to manage dependencies. To get started, install composer, then run the command: "composer install". It will download the required libraries automatically under a "vendor" directory.

Additionally, HtmlDiff uses two Scripts (markdown-format-wdiff and markdown-git-changes) which are already included within the "src/" directory, so don't remove them.

You also need to have wdiff (http://www.gnu.org/software/wdiff/) installed. This can be achieved throw homebrew by running following command in your command line: ```brew install wdiff```


# Methods
Method name      | Parameters | What it does
---------------- | ---------- | ------------
**diff** | oldHtml, newHtml, *extra* | This is the main method. Makes a diff of two pieces of HTML by running all other methods at once.
htmlToMarkdown | inputHtml, *extra*  | Takes a piece of HTML and returns the corresponding transformed Markdown as a string.
createFile     | filePath, fileContent | Creates a file with the desired name/path and writes the given content into it.
diffMarkdown  | oldFilePath, newFilePath, diffFilePath | Takes two Markdown files and creates a diff-file of them (should be markdown) with the given name/path.
markdownToHtml | inputMarkdown, *extra* | Takes a piece of Markdown and returns the corresponding transformed HTML as a string.
\* _extra_ is an optional parameter for parsing using the extra markdown syntax [as defined by @michelf](https://michelf.ca/projects/php-markdown/extra/). If it is set to true, the extra syntax is used, otherwise is it not.

# How to use it
1. First of all, you have to include the PHP class and its dependencies per autoload file from vendor directory: `require 'vendor/autoload.php';`
2. Create an object of the class to work with, like this: `$htmlDiff = new HtmlDiff\HtmlDiff;`
3. Now, if you want to compare two different pieces of HTML, pass each of them as a parameter to the *diff()* method. Be sure to place the old one first and the new one in the second position: `$htmlDiff->diff($old_html, $new_html);`
4. If you want to use extra markdown ([see here](https://michelf.ca/projects/php-markdown/extra/)), then you have to add a third parameter set to true, like this: `$htmlDiff->diff($old_html, $new_html, true);`
5. As a result you get a new styled HTML code showing the differences of the original files in a visual way.
