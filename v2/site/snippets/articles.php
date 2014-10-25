<h2>Latest projects</h2>

<?php foreach(page('articles')->children()->visible()->limit(10) as $project): ?>
<article class="tip">
	<header class="tip-header">
		<?php
		if ($page->author() == "Alex Wu") { 
			$avatar = "avatar_aw";
		} else if ($page->author() == "Christian Krammer") {
			$avatar = "avatar_ck";
		} else if ($page->author() == "Justin White") {
			$avatar = "avatar_jw";
		}
		?>
		<h1 class="tip-title"><?php echo $page->title()->html() ?></h1>
		<div class="tip-header-in">
			<div class="tip-header-image"><img src="<?php echo url('assets/images/'.$avatar.'.png')?>" alt="Photo of <?php echo $page->author() ?>"></div>
			<p class="tip-header-meta">by <a href="#"><?php echo $page->author() ?></a> <span>on <time datetime="<?php echo $page->date('Y/m/d') ?>"><?php echo $page->date('F j') ?></time></span></p>
		</div>
	</header>
	<h1 class="tip-title"><a href="<?php echo $project->url() ?>"><?php echo html($project->title()) ?></a></h1>
	<div class="tip-text">
		<?php echo excerpt($project->text(), 80) ?> <a href="<?php echo $project->url() ?>">read&nbsp;more&nbsp;→</a>
	</div>
	<div class="tip-separator"><span>oOo</span></div>
</article>
<?php endforeach ?>