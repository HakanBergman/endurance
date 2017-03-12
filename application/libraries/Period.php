<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Period {

    static $start_week = 17;
    
    static function from_date($date = null) {
        throw new Exception('Deprecated');
        if($date === null) { $date = time(); }
        
        $year = date('Y', $date);
        $week = date('W', $date);
        
        if($week < self::$start_week) {
            
            $year -= 1;
            
        } else {
            
            $week -= self::$start_week;
            $period = floor($week / 4);
            
            $week -= $period * 4;
            
        }
        
        return (object) array(
            'period' => $period,
            'week' => $week,
            'year' => $year
        );
    }
    
    static function to_date($year, $period, $week, $day = 0) {
        
        if($year === null) {
            $year = (int) date('Y');
            if(((int) date('W')) < self::$start_week) {
                $year -= 1;
            }
        }
        
        if($week < 0 || $week > 3) {
            throw new Exception("Week needs to be between 0 and 3");
        }
        
        if($period < 0 || $period > 12) {
            //throw new Exception("Period needs to be between 0 and 12");
        }
        
        return date('m/d/Y', (
            strtotime(sprintf("%uW%02u%u", $year, self::$start_week, 1)) +
            ($period * 4 + $week) * (86400 * 7) + (12 * 3600) + ($day * 86400)
        ));
    }
    
    static function to_week($year, $period, $week) {

        return (((self::$start_week + ($period * 4) + $week - 1) % max(date('W', mktime(0,0,0,12,25,$year)), date('W', mktime(0,0,0,12,31,$year)))) + 1);
    }
}


/* End of file Smartytpl.php */
/* Location: ./application/libraries/Smartytpl.php */