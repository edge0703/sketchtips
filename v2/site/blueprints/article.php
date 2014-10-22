<?php if(!defined('KIRBY')) exit ?>

title: Article
pages: false
files:
  sortable: true
fields:
  title:
    label: Title
    type:  text
    required: true
  shortcut:
    label: Shortcut
    type:  text
  menubar:
    label: Menubar command
    type:  text  
  text:
    label: Text
    type:  textarea
    required: true
  tags:
    label: Tags
    type:  tags