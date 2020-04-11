<?php
function debug($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre><hr>';
}

function getTimeLastVisit($data){
	$array = explode(' ', $data);
	$arr1 = explode(':', $array[1]);
	$arr2 = explode('-', $array[0]);
	$time = time() - mktime($arr1[0], $arr1[2], $arr1[3], $arr2[1], $arr2[2], $arr2[0]);
	$str1 = "Был на сайте ";
	$str2 = " минут";
	$str3 = " назад";

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
						return $str1.$manth.' месяцев '.$d.' дней '.$h.' часов '.$m.$str2.$str3;
					}
				} else {
					return $str1.$d.' дней '.$h.' часов '.$m.$str2.$str3;
				}
			} else {
				return $str1.$h.' часов '.$m.$str2.$str3;
			}
		} else {
			return $str1.$m.$str2.$str3;
		}

	} else {
		$m = 0;
		return $str1.$m.$str2.$str3;
	}
	return $str1.$y.' лет '.$manth.' месяцев '.$d.' дней '.$h.' часов '.$m.$str2.$str3;
}