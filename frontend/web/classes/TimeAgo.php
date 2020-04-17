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


	private function numericFormatter($num, $arrayTime){
		if($num>100) $num = substr((string) $num , -2, 2);
		$mod = 0;
		$arrMod = [2,3,4];
		if (($num === 1)||($num % 10 === 1) ) $mod = 1;
		foreach($arrMod as $item){
			if (($num === $item)||($num % 10 === $item) ) $mod = 2;
		}
		if ((($num - ($num % 10))/10) === 1) $mod = 0;
		return $arrayTime[$mod];
	}

	private function getMinute(){
		$arr = [' минут', ' минута', ' минуты'];
		$date = floor($this->time / 60) % 60;
		return $date . $this->numericFormatter($date, $arr);
	}

	private function getHour(){
		$arr = [' часов ', ' час ', ' часа '];
		$date = floor($this->time / 3600) % 24;
		$dateDay = floor($this->time / 3600/24);
		if ($date > 0 || $dateDay > 0 ) return $date . $this->numericFormatter($date, $arr);
		return '';
	}

	private function getDays(){
		$arr = [' дней ', ' день ', ' дня '];
		$date = floor($this->time / 3600 / 24) % 30;
		$dateMonth = floor($this->time / 3600 / 24 / 30);
		if ($date > 0 || $dateMonth > 0) return $date . $this->numericFormatter($date, $arr);
		return '';
	}

	private function getMonth(){
		$arr = [' месяцев ', ' месяц ', ' месяца '];
		$date = floor($this->time / 3600 / 24 / 30) % 12 ;
		$dateYear  =  floor($this->time / 3600/24/365) ;
		if ($date > 0 || $dateYear >0) return $date . $this->numericFormatter($date, $arr);
		return '';
	}

	private function getYear(){
		$arr = [' лет ', ' год ', ' года '];
		$date = floor($this->time / 3600/24/365) % 365;
		if ($date > 0 ) return $date . $this->numericFormatter($date, $arr);
		return '';
	}

	public function getDate(){
		return $this->getYear().
			$this->getMonth().
			$this->getDays().
			$this->getHour().
			$this->getMinute().' назад';
	}
}