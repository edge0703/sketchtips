<?php snippet('header') ?>

	<main class="main-main" role="main">
		<?php snippet('search') ?>

		<div class="main-main-in">
		
		<?php
		$empty = 0;
		$query = isset($_GET['q']) ? $_GET['q'] : null;
		if ($query) {
			$results = $site->search($query)->visible()->flip()->filterBy('template', 'article');;

			if (strlen($query) > 3) { // If search word has more than 3 characters
			    if ($results != "") { // If search retriefed results
			    	$count = 0; // Count search results
			    	foreach ($results as $project) {
			        	$count ++;
			        } // Count end
			?>
			<div class="message"><?=$count?> article<?php if ($count > 1) { ?>s<?php } ?> matched your search term "<?=$query?>".</div>
			<?    	
			        foreach ($results as $project) { // Loop through results
			?>
			<article class="tip">
				<header class="tip-header">
					<?php
					if ($project->author() == "Alex Wu") { 
						$avatar = "avatar_aw";
					} else if ($project->author() == "Christian Krammer") {
						$avatar = "avatar_ck";
					} else if ($project->author() == "Justin White") {
						$avatar = "avatar_jw";
					} else {
						$avatar = "";
					}
					if ($avatar != "") {
						$author_array = explode(" ", strtolower($project->author())); // Generate shortcut for about page
						$author_glue = $author_array[0]."-".$author_array[1];
					} else {
						$author_glue = "";
					}
					?>
					<h1 class="tip-title"><a href="<?php echo $project->url() ?>"><?php echo $project->title()->html() ?></a></h1>
					<div class="tip-header-in">
						<div class="tip-header-image"><img src="<?php echo url('assets/images/'.$avatar.'.png')?>" alt="Photo of <?php echo $project->author() ?>"></div>
						<p class="tip-header-meta">by <a href="<?=$site->url."/"?>about#<?php echo $author_glue ?>"><?php echo $project->author() ?></a> <span>on <time datetime="<?php echo $project->date('Y/m/d') ?>"><?php echo $project->date('F j') ?></time></span></p>
					</div>
				</header>
				<div class="tip-text">
					<p> <?php echo excerpt($project->text(), 350) ?> <span class="tip-more"><a href="<?php echo $project->url() ?>" class="tip-more-in arrow arrow-right">read more</a></span></p>
				</div>
				
				<div class="tip-separator"><span>oOo</span></div>
			</article>
			<?        	
			        }
			    } else { // If search retriefed no results
			    	$empty = 1;
			    }
			} else { // If search word has less than 3 characters
				$empty = 2;
			}
		} else { // If 
			$empty = 1;
		}

		if ($empty == 1) {
		?>
		<div class="message message-error">No tips matched your search term. Please try again.</div>
		<?php snippet('articles') ?>
		<?
		} else if ($empty == 2) {
		?>
		<div class="message message-error">Please enter more than 3 characters for an efficient search.</div>
		<?php snippet('articles') ?>
		<?	
		}

		?>
	</main>

<?php snippet('footer') ?>