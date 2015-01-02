<?php

class PredictWeekPeriod
{
    public function predict(WeekPeriodInterface $p3, WeekPeriodInterface $p2, WeekPeriodInterface $p1)
    {
        $results = new \SplFixedArray(7);
    
        for ($i = 1; $i < 8; ++$i) {
            $results[$i - 1] = $this->evolution($p3->getDay($i), $p2->getDay($i), $p1->getDay($i));
        }

        return new ValueWeekPeriod($results[0], $results[1], $results[2], $results[3], $results[4], $results[5], $results[6]);
    }

    private function evolution($i3, $i2, $i1)
    {
        // down
        if ($i3 > $i2 && $i2 > $i1) {
            $f_temp = ($i2 * 2) - $i3 - $i1;

            // accelerate
            if ($f_temp > 0) {
                if ($i1 === 0) {
                    return 0;
                }

                return (pow($i1, 2) / $i2) * (1 - (1 - 1 / ($i2 / $i3)) / 2);
            }
            // decelerate
            elseif ($f_temp < 0) {
                if ($i1 === 0) {
                    return 0;
                }
      
                return $i1 * (($i1 / $i2) / ($i2 / $i3));
            }
            else {
                return ($i1 * 2) - $i2;
            }
        }
        // up
        elseif ($i3 < $i2 && $i2 < $i1) {
            $f_temp = ($i2 * 2) - $i3 - $i1;
    
            // accelerate
            if ($f_temp > 0) {
                if ($i3 === 0) {
                    $f_temp = 1;
                } else {
                    $f_temp = $i2 / $i3;
                }
      
                return $i1 * (2 - ($i1/$i2) / $f_temp);
            }
            // decelerate
            elseif ($f_temp < 0) {
                if ($i3 === 0) {
                    $f_temp = 1;
                } else {
                    $f_temp = $i2 / $i3;
                }
      
                return $i1 * ($i1/$i2) * (1 + (1 - 1 / $f_temp) / 2);
            }
            else {
                return ($i1 * 2) - $i2;
            }
        }
        else {
            return ($i3 + $i2 + $i1) / 3;
        }
    }
}
