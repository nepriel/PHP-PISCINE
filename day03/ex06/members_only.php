<?PHP
if ($_SERVER['PHP_AUTH_USER'] === "Zaz" && $_SERVER['PHP_AUTH_PW'] === "jaimelespetitsponeys")
{
	echo "<html><body>\n";
	echo "Bonjour Zaz<br />\n";
	$image = '../img/42.png';
	$imageData = base64_encode(file_get_contents($image));
	$src = 'data: '.mime_content_type($image).';base64,'.$imageData;
	echo '<img src="', $src, '"';
	echo "</body></html>\n";
}
else 
{
	header('HTTP/1.0 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="Access to the site", charset="UTF-8"');
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>";
}
?>
