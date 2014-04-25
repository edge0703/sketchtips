<?php 
// lokal
mysql_connect("localhost","root","") or die ("Keine Verbindung moeglich" . mysql_error());
mysql_select_db("sketchtips") or die ("Die Datenbank existiert nicht." . mysql_error());

// Server
// mysql_connect("mysqlsvr26.world4you.com","css3filescom","d*7s7kq") or die ("Keine Verbindung moeglich" . mysql_error());
// mysql_select_db("css3filescomdb2") or die ("Die Datenbank existiert nicht." . mysql_error());

mysql_query("SET NAMES 'utf8'");
?>