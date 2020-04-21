<?php


namespace frontend\web\classes;




class NumericFormatter
{
	const WORDS_MINUTES = ['минут', 'минута', 'минуты'];
	const WORDS_HOURS = ['часов ', 'час', 'часа'];
	const WORDS_DAYS = ['дней ', ' день ', 'дня'];
	const WORDS_WEEK = ['неделю', 'недель', 'недели' ];
	const WORDS_MONTHS = ['месяцев', 'месяц', 'месяца'];
	const WORDS_YEARS = ['лет', 'год', 'года'];
	public $num;
	private $indicator;

	public function __construct($num, $indicator){
		$this->num = $num;
		$this->indicator = $indicator;
	}

	public function getWord():string
	{
		if($this->num > 100) {
			$this->num = substr((string) $this->num , -2, 2);
		}
		switch ($this->indicator) {
			case 'hours':
				return self::WORDS_HOURS[$this->getMod()];
			case 'days':
				return self::WORDS_DAYS[$this->getMod()];
			case 'week':
				return self::WORDS_WEEK[$this->getMod()];
			case 'months':
				return self::WORDS_MONTHS[$this->getMod()];
			case 'years':
				return self::WORDS_YEARS[$this->getMod()];
		}
		return self::WORDS_MINUTES[$this->getMod()];
	}

	private function getMod():int
	{
		if ((($this->num - ($this->num % 10))/10) === 1) {
			return 0;
		}
		if (($this->num === 1)||($this->num % 10 === 1) ){
			return 1;
		}
		$arrMod = [2, 3, 4];
		foreach($arrMod as $item){
			if (($this->num === $item)||($this->num % 10 === $item) ) {
				return 2;
			}
		}
		return 0;
	}
}