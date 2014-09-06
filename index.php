<?php include("inc/head.php"); ?>

<body>

<?php include("inc/header.php"); ?>

<main class="main-main" role="main">
	<div class="overlay overlay-search noFocus" id="overlay-search" role="dialog" aria-label="overlay-search-label">
		<div class="overlay-inner">
			<h2 class="overlay-title" id="overlay-search-label">Search for tips</h2>
			<form method="post" role="search" id="js-overlay-search-form">
				<div class="form-row form-row-zero"><label for="js-searchinput">Search term</label><input type="search" class="overlay-search-input" id="js-searchinput" name="searchterm" placeholder="Search tips" aria-describedby="js-searchcount" autocapitalize="off"> <button class="button-search"><span>Go</span></button></div>
			</form>
			<!-- Hide link is inserted via JS -->
		</div>
	</div>

	<div class="main-main-in">
		<?php
			if (isset($_GET['tip'])) $tipnumber = $_GET['tip']; // If GET-Parameter "tip" is set (that is, if tip-detail is requested)
			if (isset($_GET['count'])) $start = $_GET['count']; // If GET-Parameter "count" is set (that is, if loadmore-link has been clicked)
			else $start = 5; // Else get 5 tips from DB by default
			$countTips = 5; // How many tips to load additionally when clinking on "Load more"
			$startNext = $start + $countTips; // Get 5 more tips
			$ergebnisAll = mysql_query("SELECT * FROM articles"); // Get total amount of tips in DB
			$anzahlAll = mysql_num_rows($ergebnisAll); // Number of total tips
			$anzahlSearch = 0;
			$termLen = 0;
			$termMinLen = 2;
			$faded = false;
			$msgsent = 0;

			if (isset($_POST['searchterm'])) { // If search term is set
				$term = $_POST['searchterm'];
				$termLen = strlen($term);
				$ergebnis = mysql_query("SELECT * FROM articles WHERE text LIKE '%$term%' || title LIKE '%$term%' ORDER BY date DESC LIMIT 10"); // Search tips with provided term
				$anzahlSearch = mysql_num_rows($ergebnis);

				if ($anzahlSearch > 0 && $termLen > $termMinLen) {
					if ($anzahlSearch == 1) $tipsWord = "tip";
					else $tipsWord = "tips";
					if ($anzahlSearch > 10) $anzahlSearch = 10;
					echo "<div class=\"message\">Showing $anzahlSearch $tipsWord with your search term &ldquo;$term&rdquo;.</div>";
				} elseif ($termLen < ($termMinLen+1)) { // Only perform search if lenth of search string is longer than 3 characters
					echo "<div class=\"message message-error\">Please enter at least three characters for an efficient search.</div>";
					$anzahlSearch = 0;
				} else {
					echo "<div class=\"message message-error\">No tips matched your search term. Please try again.</div>";
				}
			}

			if ($anzahlSearch < 1 && !isset($tipnumber)) $ergebnis = mysql_query("SELECT * FROM articles ORDER BY date DESC LIMIT $start"); // Only get all tips if no search term is present (or seach term not found) and no tip-detail is requested
			if (isset($tipnumber)) $ergebnis = mysql_query("SELECT * FROM articles WHERE id = $tipnumber"); // If tip was directly called (tip-detailpage)
			if(mysql_num_rows($ergebnis)==0) { // If nothing was found in DB
				echo "<div class=\"message message-error\">This tip can not be found. Please <a href=\"/\">return to the home page</a> and try again.</div>";
			} else {
				while ($row = mysql_fetch_object($ergebnis)) { // Get fields from DB
					$date = $row->date;
					$title = $row->title;
					$text = $row->text;
					if ($termLen > $termMinLen) {
						$text = str_ireplace($term, '<b>'.$term.'</b>', $text); // Highlight words
						$title = str_ireplace($term, '<mark>'.$term.'</mark>', $title);
					}
					$timestamp = strtotime($row->date);
					$date = strftime("%B <span class=\"tip-date-day\">%d</span>", $timestamp);
					$v2 = $row->v2;
					$v3 = $row->v3;
					$announcement = $row->announcement;
					$datetime = strftime("%Y-%m-%d", $timestamp);
					$author = $row->author;
					include("inc/article.php");
				}
				$startNext_post = $startNext - $countTips; // Calculate how many tips will be displayed when "Load more" link is clicked
				if(($startNext_post <= $anzahlAll) && $anzahlSearch < 1 && !isset($tipnumber)) { // Only show more-link if there are tips left to display
				?>
				<a href="?count=<?php echo $startNext; ?>" class="loadmore" id="js-loadmore">Load more tips <i>o</i></a>
				<?php } ?><!-- if tip-detail is called, also load comments -->
			<?php } ?>
	</div>
</main>

<?php include("inc/footer.php"); ?>
	
<?php include("inc/foot.php"); ?>