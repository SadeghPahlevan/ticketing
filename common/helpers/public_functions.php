<?php 

namespace common\helpers;
use hoomanMirghasemi\jdf\Jdf;
use Yii;


class public_functions
{


    // convert jalali date to gregorian and insert it to db
    // $date is jalali input date   type = String
    // $time is houre of date  type = String
    public static function date_to_db($date , $time = '00:00:00') {
                    list($y, $m, $d) = explode('/', $date);
                    return  Jdf::jalali_to_gregorian(intval($y),  intval($m),  intval($d),'-')." ".$time;
    }

    // get gregorian date from db and convert in to jalali date
    // $date is gregorian date from db type = String
    // $display is character between of number for displaying type = String
    // $time if true, output is date + houre if false, output is just date type = Bolean
   public static function date_to_view($date , $display = '-' , $time = false) {
            if($date == '0000-00-00 00:00:00' || $date == '0000-00-00'){
                return '';
            }else{
                list($date_time , $houre) = explode(' ', $date);
                list($y , $m , $d) = explode('-', $date_time);
                if($time)
                    return  Jdf::gregorian_to_jalali($y , $m , $d ,$display)." ".$houre;
                return  Jdf::gregorian_to_jalali($y , $m , $d ,$display);
            }

    }


    // get time ago
    public static function time_ago($date) {
        if (empty($date)) {
            return "ناریخ خالی است";
        }
        $periods = array("ثانیه", "دقیقه", "ساعت", "روز", "هفته", "ماه", "سال", "دهه");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        $now = time();
        $unix_date = strtotime($date);
        // check validity of date
        if (empty($unix_date)) {
            return "تاریخ اشتباه است";
        }
        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "قبل";
        } else {
            $difference = $unix_date - $now;
            $tense = "قبل";
        }
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $periods[$j].= "";
        }
        return "$difference $periods[$j] {$tense}";
    }

    // set theme
    public static  function set_theme($theme)
    {
        $options = ['name'=>'theme','value'=>$theme];
        $cookie = new \yii\web\Cookie($options);
        Yii::$app->response->cookies->add($cookie);
    }

    //get time stamp
    public static function get_timestamp($str) {

    list($date, $time) = explode(' ', $str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);

    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

    return $timestamp;
   }



                  

}
?>
