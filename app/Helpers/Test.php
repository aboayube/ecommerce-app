<?php

namespace App\Helpers;

class Test
{

    public $sumtion = 0;
    public $sum_in = 0;

    public  function getRatings($ratting)
    {
        //  $ratting = [1,2,3,4,5,6,7,8,9,10];
        for ($i = 0; $i < count($ratting); $i++) {

            $this->sum_in += (int)$ratting[$i]; //25


            $this->sumtion += ($i + 1) * $ratting[$i]; //84
        }
        if ($this->sum_in == 0) {
            $this->sum_in = 1;
        }
        $ratting = $this->sumtion / $this->sum_in;
        return $ratting;
    }
}
