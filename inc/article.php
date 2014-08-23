<article class="tip<?php if($announcement == true) { ?> tip-announcement<?php } ?><?php if($faded == true) { ?> js-faded<?php } ?>">
	<!-- <header class="tip_header">
		<?php if($announcement == true) { ?><div class="tip-date tip-date-announcement"><span class="tip-date-announcement-in">!</span></div><?php } else { ?><time class="tip-date" datetime="<?php echo $datetime; ?>">Tip of<br> <?php echo $date; ?></time><?php } ?>
			<?php if(!$announcement == true) { ?><div class="tip_version">
				<?php if($v2 == true) { ?><span class="tip_version_in tip_version_sketch2" tabindex="0"><img src="img/icon_sketch2.png" alt="This tip applies to Sketch 2"/> <span class="tip_version_text">This tip applies to Sketch 2</span></span><?php } ?>
				<?php if($v3 == true) { ?><span class="tip_version_in tip_version_sketch3" tabindex="0"><img src="img/icon_sketch3.png" alt="This tip applies to Sketch 3"/> <span class="tip_version_text">This tip applies to Sketch 3</span></span><?php } ?>
			</div><?php } ?>
	</header> -->
	<h1 class="tip-title"><a href="?tip=<?php echo $row->id; ?>"><?php echo $title; ?></a></h1>
	<div class="tip-text">
		<?php echo $text; ?>
	</div>

	<div class="tip-separator"><span>oOo</span></div>
</article>