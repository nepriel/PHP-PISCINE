#!/usr/bin/php
<?PHP

function first($match)
{
	return ('title="'.strtoupper($match[1]).'"');
}

function third($match)
{
	return (strtoupper($match[0]));
}

function second($match)
{
	return (preg_replace_callback('/>.*</siU', third, $match[0]));
}

if ($argc == 1)
	return ;
$content = file_get_contents($argv[1]);
$content = preg_replace_callback('/title="(.*?)"/', first, $content);
$content = preg_replace_callback('/<a [^>]+.*<\/a>/siU', second, $content);
print $content;
?>
