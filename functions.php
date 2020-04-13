<?php
function debug($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre><hr>';
}

function getValidDate($date, $modifier){
	$mod = 0;
	if (($date === 1)||($date % 10 === 1) ) $mod = 1;
	if (($date === 2)||($date % 10 === 2) ) $mod = 2;
	if (($date === 3)||($date % 10 === 3) ) $mod = 2;
	if (($date === 4)||($date % 10 === 4) ) $mod = 2;
	if (($date === 11)||($date === 12)||($date === 13)||($date === 14)) $mod = 0;
	if($modifier === 'min' AND $mod === 0) 	return "$date минут";
	if($modifier === 'min' AND $mod === 1) 	return "$date минуту";
	if($modifier === 'min' AND $mod === 2) 	return "$date минуты";
	if($modifier === 'h' AND $mod === 0) 	return "$date часов";
	if($modifier === 'h' AND $mod === 1) 	return "$date час";
	if($modifier === 'h' AND $mod === 2) 	return "$date часа";
	if($modifier === 'd' AND $mod === 0) 	return "$date дней";
	if($modifier === 'd' AND $mod === 1) 	return "$date день";
	if($modifier === 'd' AND $mod === 2) 	return "$date дня";
	if($modifier === 'm' AND $mod === 0) 	return "$date месяцев";
	if($modifier === 'm' AND $mod === 1) 	return "$date месяц";
	if($modifier === 'm' AND $mod === 2) 	return "$date месяца";
	if($modifier === 'y' AND $mod === 0) 	return "$date лет";
	if($modifier === 'y' AND $mod === 1) 	return "$date год";
	if($modifier === 'y' AND $mod === 2) 	return "$date года";
}

function getTimeLastVisit($data){
	$time = time() - strtotime($data);
	$str1 = "Был на сайте ";
	$str = " назад";

	if($time > 30){
		$m = round($time / 60);
		if($m>60){
			$h = round($m / 60);
			$m = $m % 60;
			if($h>24){
				$d = round($h / 24);
				$h = $h % 24;
				if($d>30){
					$manth = round($d / 30);
					$d = $d % 30;
					if($manth>12){
						$y = round($manth / 30);
						$manth = $manth % 12;
					} else {
						return getValidDate($manth, 'm').getValidDate($d, 'd').getValidDate($h, 'h').getValidDate($m, 'min').$str;
					}
				} else {
					return $d.getValidDate($d, 'd').getValidDate($h, 'h').getValidDate($m, 'min').$str;
				}
			} else {
				return getValidDate($h, 'h').getValidDate($m, 'min').$str;
			}
		} else {
			return getValidDate($m, 'min').$str;
		}

	} else {
		$m = 0;
		return getValidDate($m, 'min').$str;
	}
	return getValidDate($y, 'y').getValidDate($manth, 'm').getValidDate($d, 'd').getValidDate($h, 'h').getValidDate($m, 'min').$str;
}