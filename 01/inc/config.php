<?php

	ini_set("display_errors",1);
	error_reporting(E_ALL);

	include ('connect.php');
	include ('functions.php');

	require_once 'src/Fenom.php';

	// Подключаем класс для работы с excel
	require_once('src/PHPExcel.php');
	// Подключаем класс для вывода данных в формате excel
	require_once('src/PHPExcel/Writer/Excel5.php');
	
	//include('PEAR.php'); 
	include('Mail.php'); 
	include('Mail/mime.php'); 
