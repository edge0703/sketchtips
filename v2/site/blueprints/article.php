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
  date:
    label: Date
    type:  date
    required: true  
    format: YYYY/MM/DD
    default: 2014/12/31
  shortcut:
    label: Shortcut
    type:  text
    placeholder: Don't forget the &lt;kbd&gt; tags
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
  author:
    label: Author
    type:  text
    required: true