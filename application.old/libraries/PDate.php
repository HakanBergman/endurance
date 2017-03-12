<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDate {
    
    static $start_week = 17;
    protected static $now = null;
    
    protected $_year, $_period, $_week, $_day, $_segment;
    
    protected static function getNow() {
        if(self::$now === null) {
            return new self();
        } else {
            return self::$now;
        }
    }
    
    function __construct($params = null) {
        
        if( ! is_object($params) && empty($params)) { $params == NULL; }  
        $date = $params['date'];
        $now = ($date === null);
        $to_be_set = array();
        
        
        
        if($date === null) { $date = time(); }
        
        if(is_array($date)) {
            $to_be_set = $date;
            $date = time();
        } elseif(is_string($date)) {
            $date = strtotime($date);
        }
        
        $year = (int) date('o', $date);
        $week = (int) date('W', $date);
        
        if($week < self::$start_week) {
            $year -= 1;
            $week += (int) max(date('W', mktime(0,0,0,12,25,$year)), date('W', mktime(0,0,0,12,31,$year)));
        }
        
        $week -= self::$start_week;
        $period = (int) floor($week / 4);
        $week -= $period * 4;
        
        $this->_year = $year;
        $this->_period = $period;
        $this->_week = $week;
        $this->_day = date('N', $date) - 1;
        $this->_segment = 0;
        
        foreach($to_be_set as $name => $value) {
            $this->__set($name, $value);
        }
        
        if($now) {
            self::$now = clone $this;
        }
        
    }
    
    function __get($name) {
        return $this->{"_" . $name};
    }
    
    function __set($name, $value) {
        $this->add($name, ((int) $value) - $this->$name);
    }
    
    function __call($name, $arguments) {
        $n = clone $this;
        $n->__set($name, $arguments[0]);
        return $n;
    }
    
    function add($name, $value) {
        if($value == 0) { return ; }
        switch($name) {
            case "year":
                $this->_year += $value;
                break;
            case "period":
                $this->add("year", ceil(($this->_period + $value - 12) / 13));
                $this->_period = ($this->_period + $value + 13) % 13;
                break;
            case "week":
                $this->add("period", ceil(($this->_week + $value - 3) / 4));
                $this->_week = ($this->_week + $value + 4) % 4;
                break;
            case "day":
                $this->add("week", ceil(($this->_day + $value - 6) / 7));
                $this->_day = ($this->_day + $value + 7) % 7;
                break;
            case "segment":
                $this->add("day", ceil(($this->_segment + $value - 3) / 4));
                $this->_segment = ($this->_segment + $value + 4) % 4;
                break;
        }
    }
    
    function isNow() {
        $now = self::getNow();
        return (
            $this->_year === $now->_year &&
            $this->_period === $now->_period &&
            $this->_week === $now->_week &&
            $this->_day === $now->_day &&
            $this->_segment === $now->_segment
        );
    }
    
    function time() {
        $start = strtotime(sprintf("%u-W%02u-%u", $this->year, self::$start_week, 1));
        return ($start + ((($this->period * 4 + $this->week) * 7 + $this->day + 0.5) * 86400));
    }
    
    function gregorian($format) {
        $start = strtotime(sprintf("%u-W%02u-%u", $this->year, self::$start_week, 1));
        return date($format, $start + ((($this->period * 4 + $this->week) * 7 + $this->day) * 86400));      
    }
    
    function hyGregorian($format) {
        $start = strtotime(sprintf("%u-W%02u-%u", $this->year, self::$start_week, 1));
        $datestr = date('Y-m-d', $start + ((($this->period * 4 + $this->week) * 7 + $this->day) * 86400));
        $newtime = strtotime($datestr ." + 1 days");
        return date($format,$newtime);
    }
    
    function newGregorian($format = "W") {
        $startweek = self::$start_week;
        $lastweek = $this->getIsoWeeksInYear($this->year);

        $sum = (self::$start_week + ($this->period * 4) + $this->week);
        if($sum > $lastweek) {
            return ($sum - $lastweek);
        } else {
            return $sum;
        }
    }
    
    function getIsoWeeksInYear($year) {
        $date = new DateTime;
        $date->setISODate($year, 53);
        return ($date->format("W") === "53" ? 53 : 52);
    }
    
    function gregorianWeek($week = null) {
        return (((self::$start_week + ($this->period * 4) + ($week===null?$this->week:$week) - 1) % max(date('W', mktime(0,0,0,12,25,$this->year)), date('W', mktime(0,0,0,12,31,$this->year)))) + 1);
    }
    
    function oneYearAgo() {
        $this->_year--;
        return $this;
    }
    
}
