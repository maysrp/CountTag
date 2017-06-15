<?php
	include_once 'class/medoo.php';
	include_once 'class/tag.php';
	$tag=new tag();
	$name=isset($_GET['name'])?trim($_GET['name']):"";
	if($name){
		$tag->add_one($name);
	}
	$tag->all();