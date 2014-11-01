<?php snippet('header') ?>

	<main class="main-main" role="main">
		<?php snippet('search') ?>
		
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
				$author_array = explode(" ", strtolower($page->author()));
				$author_glue = $author_array[0]."-".$author_array[1];
				?>
				<h1 class="tip-title"><?php echo $page->title()->html() ?></h1>
				<div class="tip-header-in">
					<div class="tip-header-image"><img src="<?php echo url('assets/images/'.$avatar.'.png')?>" alt="Photo of <?php echo $page->author() ?>"></div>
					<p class="tip-header-meta">by <a href="<?=$site->url."/"?>about#<?php echo $author_glue ?>"><?php echo $page->author() ?></a> <span>on <time datetime="<?php echo $page->date('Y/m/d') ?>"><?php echo $page->date('F j') ?></time></span></p>
				</div>
			</header>
			<div class="tip-text">
				<?php if(!$page->shortcut()->empty()): ?><p class="tip-text-shortcut"><em>Shortcut:</em> <?php echo $page->shortcut() ?></p><?php endif ?>
				<?php if(!$page->menubar()->empty()): ?><p class="tip-text-menu"><strong><?php echo $page->menubar() ?></strong></p><?php endif ?>
				<?php echo $page->text()->kirbytext() ?>
			</div>
  			<div class="tip-separator"><span>oOo</span></div>
		</article>

		<nav class="article-nav">
			<?php if($prev = $page->prevVisible()): ?>
			  	<div class="article-nav-in article-nav-prev">
			  		<a class="article-nav-link article-nav-link-prev arrow arrow-left" href="<?php echo $prev->url() ?>">Next <span>article</span></a>
			  		<div class="article-nav-title"><div class="article-nav-title-in"><?php echo $prev->title() ?></div></div>
			  	</div>
			<?php endif ?>
			
			<?php if($next = $page->nextVisible()): ?>
				<div class="article-nav-in article-nav-next">
					<a class="article-nav-link article-nav-link-next arrow arrow-right" href="<?php echo $next->url() ?>">Previous <span>article</span></a>
					<div class="article-nav-title"><div class="article-nav-title-in"><?php echo $next->title() ?></div></div>
				</div>
			<?php endif ?>
		</nav>
		</div>
	</main>

<?php snippet('footer') ?>