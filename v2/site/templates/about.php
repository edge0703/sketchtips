<?php snippet('header') ?>

	<main class="main-main" role="main">
		<?php snippet('search') ?>

		<div class="main-main-in">
	
		<?php foreach(page('about')->children()->visible() as $project): ?>
		<article class="tip tip-author">
			<header class="tip-header">
				<?php
				if ($project->title() == "Alex Wu") { 
					$avatar = "avatar_aw";
				} else if ($project->title() == "Christian Krammer") {
					$avatar = "avatar_ck";
				} else if ($project->title() == "Justin White") {
					$avatar = "avatar_jw";
				}
				$author_array = explode(" ", strtolower($project->title())); // Generate shortcut for about page
				$author_glue = $author_array[0]."-".$author_array[1];
				?>
				<h1 class="tip-title" id="<?php echo $author_glue?>"><?php echo $project->title() ?></h1>
				<div class="tip-header-in">
					<div class="tip-header-image"><img src="<?php echo url('assets/images/'.$avatar.'.png')?>" alt="Photo of <?php echo $project->author() ?>"></div>
				</div>
			</header>
			<div class="tip-text">
				<p> <?php echo $project->text()->kirbytext() ?> <?php if($project->title() == "Christian Krammer") { ?><span class="tip-more"><a href="mailto:<?php echo $project->email() ?>" class="tip-more-in arrow arrow-right">Contact me</a></span><?php } ?></p>
			</div>
			
			<div class="tip-separator"><span>oOo</span></div>
		</article>
		
		<?php endforeach ?>

		</div>

	</main>

<?php snippet('footer') ?>