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
		?>
		<h1 class="tip-title"><a href="<?php echo $project->url() ?>"><?php echo $project->title()->html() ?></a></h1>
		<div class="tip-header-in">
			<div class="tip-header-image"><img src="<?php echo url('assets/images/'.$avatar.'.png')?>" alt="Photo of <?php echo $project->author() ?>"></div>
			<p class="tip-header-meta">by <a href="#"><?php echo $project->author() ?></a> <span>on <time datetime="<?php echo $project->date('Y/m/d') ?>"><?php echo $project->date('F j') ?></time></span></p>
		</div>
	</header>
	<div class="tip-text">
		<p> <?php echo excerpt($project->text(), 350) ?> <span class="tip-more"><a href="<?php echo $project->url() ?>" class="tip-more-in arrow arrow-right">read more</a></span></p>
	</div>
	
	<div class="tip-separator"><span>oOo</span></div>
</article>