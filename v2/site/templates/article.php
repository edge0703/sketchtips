<?php snippet('header') ?>

	<main class="main-main" role="main">
		<div class="main-main-in">
		<article class="tip tip-in">
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
			<div class="tip-text">
				<?php if(!$page->shortcut()->empty()): ?><p class="tip-text-shortcut"><em>Shortcut:</em> <?php echo $page->shortcut() ?></p><?php endif ?>
				<?php if(!$page->menubar()->empty()): ?><p class="tip-text-menu"><strong><?php echo $page->menubar() ?></strong></p><?php endif ?>
				<?php echo $page->text()->kirbytext() ?>
			</div>
  			<div class="tip-separator"><span>oOo</span></div>
		</article>
		</div>
	</main>

<?php snippet('footer') ?>