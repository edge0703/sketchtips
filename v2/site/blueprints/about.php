<?php if(!defined('KIRBY')) exit ?>

title: About
pages: true
files:
  sortable: true
fields:
  title:
    label: Name
    type:  text
    required: true
  text:
    label: Text
    type:  textarea
    required: true
  website:
    label: Website
    type:  text
    required: true