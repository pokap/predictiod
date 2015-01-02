<?php

class ValueWeekPeriod implements WeekPeriodInterface
{
    private $day1;
    private $day2;
    private $day3;
    private $day4;
    private $day5;
    private $day6;
    private $day7;
    private $day;

    public function __construct($day1, $day2, $day3, $day4, $day5, $day6, $day7)
    {
        $this->day1 = $day1;
        $this->day2 = $day2;
        $this->day3 = $day3;
        $this->day4 = $day4;
        $this->day5 = $day5;
        $this->day6 = $day6;
        $this->day7 = $day7;
    }

    public function getDay1()
    {
        return $this->day1;
    }

    public function getDay2()
    {
        return $this->day2;
    }

    public function getDay3()
    {
        return $this->day3;
    }

    public function getDay4()
    {
        return $this->day4;
    }

    public function getDay5()
    {
        return $this->day5;
    }

    public function getDay6()
    {
        return $this->day6;
    }

    public function getDay7()
    {
        return $this->day7;
    }

    public function rewind()
    {
        $this->day = 1;
    }

    public function getDay($day)
    {
        switch ($day) {
            case 1: return $this->day1;
            case 2: return $this->day2;
            case 3: return $this->day3;
            case 4: return $this->day4;
            case 5: return $this->day5;
            case 6: return $this->day6;
            case 7: return $this->day7;
        }

        return false;
    }
  
    public function current()
    {
        return $this->getDay($this->day);
    }

    public function key() 
    {
        return $this->day;
    }
  
    public function next() 
    {
        ++$this->day;

        return $this->current();
    }
  
    public function valid()
    {
        return $this->day < 8 && $this->day > 0;
    }
}
