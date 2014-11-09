<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
  <meta name="description" content="<?php echo $site->description()->html() ?>"/>
  <meta name="author" content="Christian Krammer"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <link rel="alternate" type="application/rss+xml" href="<?=$site->url."/"?>feed" title="Blog Feed" />
  <?php echo css('assets/css/style.css') ?>
  <?php echo js('assets/js/modernizr.custom.00233.js') ?>
  <script type="text/javascript">if ('querySelector' in document && 'localStorage' in window && 'addEventListener' in window ) {document.write('<style type="text/css">body{opacity:0}</style>');}</script>
</head>

<body>

<header class="main-header" role="banner">
  <div class="main-header-in">
    <div class="main-header-title"><a href="/"><b>sketch</b>tips</a></div>
    <p class="main-header-tagline">Clever tips, thoughts and insights for your favorite design app.</p>

    <nav class="main-header-nav" role="navigation">
      <ul>
        <li class="main-header-nav-item main-header-nav-item-twitter"><a href="https://twitter.com/SketchTips" data-tooltip="Follow @SketchTips"><span>Twitter</span></a></li>
        <li class="main-header-nav-item main-header-nav-item-find"><a href="#overlay-search"><span>Search tips</span></a></li>
        <li class="main-header-nav-item main-header-nav-item-rss"><a href="<?=$site->url."/"?>feed"><span>RSS feed</span></a></li>
        <li class="main-header-nav-item main-header-nav-item-contact"><a href="<?=$site->url."/"?>newsletter"><span>Subscribe to newsletter</span></a></li>
      </ul>
    </nav>
  </div>
</header>