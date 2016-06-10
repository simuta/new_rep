<?php
include_once ('inc/config.php');

//запрашиваем данные из базы и приводим их в удобный вид
	$query = "SELECT `tblinvoices`.`date`, CONCAT_WS(' ', `tblclients`.`firstname`, `tblclients`.`lastname`) AS client_fio, `tblinvoiceitems`.`description`, `tblinvoiceitems`.`amount` 
	FROM `tblinvoices`  INNER JOIN `tblinvoiceitems` ON `tblinvoices`.`id`=`tblinvoiceitems`.`invoiceid`
						INNER JOIN `tblclients` ON `tblinvoices`.`userid`=`tblclients`.`id`  
	WHERE `tblinvoices`.`date` > DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)";

	$result = $pdo->query($query);
	foreach ($result as $key => $val){
		$array_output [$key] = $val;
	}
	
	$header = array("date"	 		=> array("title" =>"Дата", "column" 	=> "A"),
					"client_fio" 	=> array("title" =>"Клиент", "column" 	=> "B"),
					"description" 	=> array("title" =>"Продукт", "column" 	=> "C"),
					"amount" 		=> array("title" =>"Сумма", "column" 	=> "D"));	
	
//формируем и отправляем письмо	
	\Fenom::registerAutoload();
	$fenom = Fenom::factory(__DIR__.'/template', __DIR__.'/cache', Fenom::DISABLE_CACHE ); 

	$to = "simuta@i.ua";
	$patch_file = 'C:/WebServers/home/localhost/www/tasks/0_1_2/xls/';
	$name_file = 'the report from '.date("m.d.y H-i").'.xls';
	$text = $name_file; 
	$crlf = "\r\n"; 
	$hdrs = array('From' => '<service@whsc.com>', 'Subject' => $name_file); 
	$mime = new Mail_mime($crlf); 
	$mime->setTXTBody($text); 
		
	
	if(!empty($array_output)){
		//формируем файл для exel с данными 
		create_file($patch_file, $name_file, $array_output, $header);
		$message = $fenom->fetch("index.tpl", array('title' => 'Отчет', 'array_output' => $array_output, 'header' => $header));
		$file = $patch_file.$name_file;
		$mime->addAttachment($file);
	} 
		else {
			$message = 'В БД нет данных за прошедший месяц!';
		}	
		
	$mime->setHTMLBody($message); 
	 

	$body = $mime->get(array( 'head_charset'  => 'utf-8',
							  'text_charset'  => 'utf-8',
                              'html_charset'  => 'utf-8' )); 
	$hdrs = $mime->headers($hdrs); 

	$mail =& Mail::factory('mail'); 
	
	if ($mail->send($to, $hdrs, $body))	{
		$MailMessage = 'Письмо отправлено!';
	}
		else {
			$MailMessage = 'Произошла ошибка! Письмо не отправлено!';
		}

	$fenom->display("view.tpl", array('MailMessage' => $MailMessage));
?>