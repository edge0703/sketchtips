<?php
include("inc/dbconnect.php");

if ($_POST['event'] == "email") { // Process form
	$receiver = "ck@css3files.com";
	$type = $_POST['contacttype'];
	if ($type == "message") $type = "message"; // Check which radio-buttin was selected
	else $type = "tip";
	$subject = "New $type from sketch-tips";
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
	$mailheader = "From: $name<$email>";
	mail($receiver, $subject, $msg, $mailheader) or die("Fehler");
	echo "Thanks for getting in contact. I will come back to you as soon as possible.";
}

if ($_POST['event'] == "loadmore") { // If loadmore-link was clicked
	$start = $_POST['start'];  // From which tip to start (that is, how many were already shown)
	$count = $_POST['count']; // How many tips to load
	$ergebnis = mysql_query("SELECT * FROM articles ORDER BY date DESC LIMIT $start, $count");
	$anzahl = mysql_num_rows($ergebnis);
	while ($row = mysql_fetch_object($ergebnis)) {
		$date = $row->date;
		$title = $row->title;
		$text = $row->text;
		$timestamp = strtotime($row->date);
		$date = strftime("%B <span class=\"tip-date-day\">%d</span>", $timestamp);
		$datetime = strftime("%Y-%m-%d", $timestamp);
		$faded = true;
		$v2 = $row->v2;
		$v3 = $row->v3;
		$announcement = $row->announcement;
		include("inc/article.php");
	}
}

if ($_POST['event'] == "tipscount") { // Get total number of tips
	$ergebnis = mysql_query("SELECT * FROM articles");
	$anzahl = mysql_num_rows($ergebnis);
	echo $anzahl;
}

if ($_POST['event'] == "searchcount") { // Get number of tips with given search term
	$term = $_POST['searchterm'];
	$ergebnis = mysql_query("SELECT * FROM articles WHERE text LIKE '%$term%' || title LIKE '%$term%'");
	$anzahl = mysql_num_rows($ergebnis);
	echo $anzahl;
}

if ($_POST['event'] == "search") { // Get tips with given search term
	$term = $_POST['searchterm'];
	$ergebnis = mysql_query("SELECT * FROM articles WHERE text LIKE '%$term%' || title LIKE '%$term%' ORDER BY date DESC LIMIT 10");

	while ($row = mysql_fetch_object($ergebnis)) {
		$date = $row->date;
		$title = $row->title;
		$title = str_ireplace($term, '<mark>'.$term.'</mark>', $title); // Highlight words
		$text = $row->text;
	    $text = str_ireplace($term, '<mark>'.$term.'</mark>', $text); // Highlight words
		$timestamp = strtotime($row->date);
		$date = strftime("%B <span class=\"tip-date-day\">%d</span>", $timestamp);
		$datetime = strftime("%Y-%m-%d", $timestamp);
		$faded = true;
		$v2 = $row->v2;
		$v3 = $row->v3;
		$announcement = $row->announcement;
		include("inc/article.php");
	}
}
?>