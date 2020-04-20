<?php


namespace frontend\web\classes;


class TimeAgo
{
	public $date;
	public $time;

	public function __construct($date){
		$this->date = $date;
		$this->time = time() - strtotime($this->date);
	}

	private function getMinute():string
	{
		$date = floor($this->time / 60) % 60;
		$dateHour = floor($this->time / 3600) % 24;
		if($dateHour>0){
			return '';
		}
		return $date .' '. (new NumericFormatter($date, 'minutes'))->getWord();
	}

	private function getHour():string
	{
		$date = floor($this->time / 3600) % 24;
		$dateDay = floor($this->time / 3600/24);
		if ($dateDay > 0 ) {
			return '';
		}
		return $date .' '. (new NumericFormatter($date, 'hours'))->getWord();
	}

	private function getDays():string
	{
		$date = floor($this->time / 3600 / 24) % 30;
		$dateMonth = floor($this->time / 3600 / 24 / 30);
		if ($dateMonth > 0) {
			return '';
		}
		return $date .' '. (new NumericFormatter($date, 'days'))->getWord();
	}

	private function getMonth():string
	{
		$date = floor($this->time / 3600 / 24 / 30) % 12 ;
		$dateYear  =  floor($this->time / 3600/24/365) ;
		if ($dateYear >0) {
			return '';
		}
		return $date .' '. (new NumericFormatter($date, 'months'))->getWord();
	}

	private function getYear():string
	{
		$date = floor($this->time / 3600/24/365) % 365;
		if ($date > 0 ) {
			return $date .' '. (new NumericFormatter($date, 'years'))->getWord();
		}
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