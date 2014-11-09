		<?php 
		$articles = page('articles')->children()->visible()->paginate(10);
		$subpages   = $page->children()->paginate(10);
		$pagination = $subpages->pagination();
		?>

		<?php foreach($articles as $project): ?>	
		<article class="tip">
			<header class="tip-header">
				<?php
				if ($project->author() == "Alex Wu") { 
					$avatar = "avatar_aw";
				} else if ($project->author() == "Christian Krammer") {
					$avatar = "avatar_ck";
				} else if ($project->author() == "Justin White") {
					$avatar = "avatar_jw";
				}

				$author_array = explode(" ", strtolower($project->author())); // Generate shortcut for about page
				$author_glue = $author_array[0]."-".$author_array[1];
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
		
		<?php endforeach ?>

		<?php if($articles->pagination()->hasPages()): ?>
		<nav class="page-nav">
			<?php if($articles->pagination()->hasPrevPage()): ?>
			<a class="page-nav-link page-nav-prev" href="<?php echo $articles->pagination()->prevPageURL() ?>">newer<span> articles</span></a>
			<?php endif ?>

			<?php if($articles->pagination()->hasNextPage()): ?>
			<a class="page-nav-link page-nav-next" href="<?php echo $articles->pagination()->nextPageURL() ?>">older<span> articles</span></a>
			<?php endif ?>
		</nav>
		<?php endif ?>