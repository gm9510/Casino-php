<?php

namespace App\Util;

class Roulette{

    public function random_color(): string{
        // Assuming that random_init() provides a uniform distribution
        $num = random_int(1,100);
        
        if($num < 50) return 'r';
        
        else if($num <= 98) return 'b';

        else return 'g';
        
    }

}
