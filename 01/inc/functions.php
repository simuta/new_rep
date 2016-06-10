<?php
function create_file($patch_file, $name_file, $array_output, $header)
	{
		// Создаем объект класса PHPExcel
		$xls = new PHPExcel();
		// Устанавливаем индекс активного листа
		$xls->setActiveSheetIndex(0);
		// Получаем активный лист
		$sheet = $xls->getActiveSheet();
		// Подписываем лист
		$sheet->setTitle('the report from '.date("m.d.y"));
		
		
		$style_borders = array ('style' =>PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => '808080'));
		
		$str_num = 1;	
		foreach($array_output as $key => $val){
			foreach($header as $k => $v){
				if ($str_num !=1) {
					//вставляем значения в ячейки
					$sheet->setCellValue($v ['column'].$str_num, $val[$k]);
				}
					else{
						// Вставляем текст заголовока таблицы по ячейкам 
						$sheet->setCellValue($v ['column'].$str_num, $v ['title']);
						
						$sheet->getColumnDimension($v ['column'])->setAutoSize(true);
						$sheet->getStyle($v ['column'].$str_num)->getFont()->setBold(true);
						$sheet->getStyle($v ['column'].$str_num)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$sheet->getStyle($v ['column'].$str_num)->getFill()->getStartColor()->setRGB('EEEEEE');
					}				
				$sheet->getStyle($v ['column'].$str_num)->getBorders()->getBottom()->applyFromArray($style_borders);
				$sheet->getStyle($v ['column'].$str_num)->getBorders()->getLeft()->applyFromArray($style_borders);
				$sheet->getStyle($v ['column'].$str_num)->getBorders()->getTop()->applyFromArray($style_borders);
				$sheet->getStyle($v ['column'].$str_num)->getBorders()->getRight()->applyFromArray($style_borders);
				$sheet->getStyle($v ['column'].$str_num)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			$str_num++;
		}
		

		// записывем файл
		 $objWriter = new PHPExcel_Writer_Excel5($xls);
		 $objWriter->save($patch_file.$name_file);
	}
?>