<?php

echo page('articles')->children()->visible()->limit(10)->feed(array(
  'title'       => $page->title(),
  'text' => $page->text(),
));

?>