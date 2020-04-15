<?php


namespace frontend\web\classes;


class TimeAgo
{
	public $date;
	public $time;
	public static function app($date){
		return new self($date);
	}

	private function __construct($date){
		$this->date = $date;
		$this->time = time() - strtotime($this->date);
	}

	private function getMinute(){
		$date = floor($this->time / 60) % 60;
		$mod = 0;
		if (($date === 1)||($date % 10 === 1) ) $mod = 1;
		if (($date === 2)||($date % 10 === 2) || ($date === 3)||($date % 10 === 3) || ($date === 4) || ($date % 10 === 4)) $mod = 2;
		if (($date === 11)||($date === 12)||($date === 13)||($date === 14)) $mod = 0;
		if($mod === 0) return "$date минут";
		if($mod === 2) return "$date минуты";
		return "$date минуту";
	}

	private function getHour(){
		$date = floor($this->time / 3600) % 60;
		if ($date > 0){
			$mod = 0;
			if (($date === 1)||($date % 10 === 1) ) $mod = 1;
			if (($date === 2)||($date % 10 === 2) || ($date === 3)||($date % 10 === 3) || ($date === 4) || ($date % 10 === 4)) $mod = 2;
			if (($date === 11)||($date === 12)||($date === 13)||($date === 14)) $mod = 0;
			if($mod === 0) return "$date часов ";
			if($mod === 2) return "$date часа ";
			return "$date час ";
		}
		return '';
	}
	private function getDays(){
		$date = floor($this->time / 3600/24) % 24;
		if ($date > 0){
			$mod = 0;
			if (($date === 1)||($date % 10 === 1) ) $mod = 1;
			if (($date === 2)||($date % 10 === 2) || ($date === 3)||($date % 10 === 3) || ($date === 4) || ($date % 10 === 4)) $mod = 2;
			if (($date === 11)||($date === 12)||($date === 13)||($date === 14)) $mod = 0;
			if($mod === 0) return "$date дней ";
			if($mod === 2) return "$date дня ";
			return "$date день ";
		}
		return '';
	}
	private function getMonth(){
		$date = floor($this->time / 3600/24/30) % 30;
		if ($date > 0){
			$mod = 0;
			if (($date === 1)||($date % 10 === 1) ) $mod = 1;
			if (($date === 2)||($date % 10 === 2) || ($date === 3)||($date % 10 === 3) || ($date === 4) || ($date % 10 === 4)) $mod = 2;
			if (($date === 11)||($date === 12)||($date === 13)||($date === 14)) $mod = 0;
			if($mod === 0) return "$date месяцев ";
			if($mod === 2) return "$date месяца ";
			return "$date месяц ";
		}
		return '';
	}

	private function getYear(){
		$date = floor($this->time / 3600/24/365) % 365;
		if ($date > 0){
			$mod = 0;
			if (($date === 1)||($date % 10 === 1) ) $mod = 1;
			if (($date === 2)||($date % 10 === 2) || ($date === 3)||($date % 10 === 3) || ($date === 4) || ($date % 10 === 4)) $mod = 2;
			if (($date === 11)||($date === 12)||($date === 13)||($date === 14)) $mod = 0;
			if($mod === 0) return "$date лет ";
			if($mod === 2) return "$date года ";
			return "$date год ";
		}
		return '';
	}

	public function getDate(){
		return $this->getYear().
			$this->getMonth().
			$this->getDays().
			$this->getHour().$this->getMinute().' назад';
	}
}