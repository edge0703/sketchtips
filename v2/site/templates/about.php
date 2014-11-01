<?php snippet('header') ?>

	<main class="main-main" role="main">
		<?php snippet('search') ?>

		<div class="main-main-in">
	
		<?php foreach(page('about')->children()->visible() as $project): ?>
		<article class="tip tip-author">
			<header class="tip-header">
				<?php
				if ($project->name() == "Alex Wu") { 
					$avatar = "avatar_aw";
				} else if ($project->name() == "Christian Krammer") {
					$avatar = "avatar_ck";
				} else if ($project->name() == "Justin White") {
					$avatar = "avatar_jw";
				}
				?>
				<h1 class="tip-title" id="<?php echo $project->title() ?>"><?php echo $project->name() ?></h1>
				<div class="tip-header-in">
					<div class="tip-header-image"><img src="<?php echo url('assets/images/'.$avatar.'.png')?>" alt="Photo of <?php echo $project->author() ?>"></div>
				</div>
			</header>
			<div class="tip-text">
				<p> <?php echo excerpt($project->text(), 350) ?> <span class="tip-more"><a href="<?php echo $project->website() ?>" class="tip-more-in arrow arrow-right">Visit my website</a></span></p>
			</div>
			
			<div class="tip-separator"><span>oOo</span></div>
		</article>
		
		<?php endforeach ?>

		</div>

	</main>

<?php snippet('footer') ?>