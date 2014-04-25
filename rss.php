<?php include("inc/functions.php"); ?>

<?php
	$datum = strftime("%a, %d %b %G %H:%M:%S +0100");
	$datei = "feed.rss";
	$handler = fopen($datei, 'w') or die("can't open file");
	$inhalt = '
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">
<channel>
<title>sketchtips.info</title>
<link>http://www.sketchtips.info</link>
<description>Clever tips for your favourite design app.</description>
<lastBuildDate>' . $datum . '</lastBuildDate>
<language>en-US</language>
';
	$ergebnis = mysql_query("SELECT * FROM articles ORDER BY date DESC");

	while ($row = mysql_fetch_object($ergebnis)) { // Get fields from DB
		$timestamp = strtotime($row->date);
		$date2 = strftime("%a, %d %b %G %H:%M:%S +0100", $timestamp);
		$v2 = $row->v2;
		$v3 = $row->v3;
		$bs = "";
		$version = "";
		if ($v2 == true && $v3 == true) $bs = ", ";
		if ($v2 == true) $v2 = "Sketch 2";
		else $v2 = "";
		if ($v3 == true) $v3 = "Sketch 3";
		else $v3 = "";
		if ($v2 == true || $v3 == true) $version = "<p>This tip applies to: $v2$bs$v3.</p>";
		$inhalt .= '

<item>
<title>'. $row->title .'</title>
<link>http://www.sketchtips.info/?tip='. $row->id .'</link>
<pubDate>'. $date2 .'</pubDate>
<dc:creator>Christian Krammer</dc:creator>
<description>
<![CDATA[
'. $row->text . $version . '
]]>
</description>
</item>

';
	}

	echo "Datei geschrieben";

	$inhalt .= '
</channel>
</rss>
';
	fwrite($handler, $inhalt);
	fclose($handler);
?>