<?php if(!defined('KIRBY')) exit ?>

title: Page
pages: article
  template:
    - article
    - about
files: false
fields:
  title:
    label: Title
    type:  text
  text:
    label: Text
    type:  textarea