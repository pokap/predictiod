<?php

interface WeekPeriodInterface extends Iterator
{
    public function getDay1();
    public function getDay2();
    public function getDay3();
    public function getDay4();
    public function getDay5();
    public function getDay6();
    public function getDay7();
}
