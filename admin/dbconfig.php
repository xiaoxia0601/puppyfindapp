<?php

	session_start();

	$DB_HOST = 'mysql.hostinger.com.hk';
	$DB_USER = 'u398984053_rliu';
	$DB_PASS = '123456';
	$DB_NAME = 'u398984053_rliu';

	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	include_once 'model.user.php';
	$user = new USER($DB_con);

?>