<?php


namespace frontend\web\classes;


class TimeAgo
{
	public $date;
	public $time;

	public function __construct($date)
	{
		$this->date = $date;
		$this->time = time() - strtotime($this->date);
	}

	private function getMinute():int
	{
		$date = floor($this->time / 60) % 60;
		return $date;
	}

	private function getHour():int
	{
		$date = floor($this->time / 3600) % 24;
		return $date;
	}

	private function getDays():int
	{
		$date = floor($this->time / 3600 / 24) % 30;
		return $date;
	}

	private function getMonth():int
	{
		$date = floor($this->time / 3600 / 24 / 30) % 12 ;
		return $date;
	}

	private function getYear():int
	{
		$date = floor($this->time / 3600/24/365) ;
		return $date;
	}

	public function getDate():string
	{
		if ($this->getYear() > 0){
			return $this->getYear() .' '. (new NumericFormatter($this->getYear(), 'years'))->getWord().' назад';
		}
		if ($this->getMonth() > 0){
			return $this->getMonth().' '. (new NumericFormatter($this->getMonth(), 'months'))->getWord().' назад';
		}
		if ($this->getDays() > 0){
			return $this->getDays().' '. (new NumericFormatter($this->getDays(), 'days'))->getWord().' назад';
		}
		if ($this->getHour() > 0){
			return $this->getHour().' '. (new NumericFormatter($this->getHour(), 'hours'))->getWord().' назад';
		}
		return	$this->getMinute().' '. (new NumericFormatter($this->getMinute(), 'minutes'))->getWord().' назад';
	}
}