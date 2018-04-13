<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 13.04.2018
 * Time: 10:27
 */
<?
//Приведение даты к читаемому виду
function date_format_rus($date){
    $month_array = array (
        1 => 'Января',
        2 => 'Февраля',
        3 => 'Марта',
        4 => 'Апреля',
        5 => 'Мая',
        6 => 'Июня',
        7 => 'Июля',
        8 => 'Августа',
        9 => 'Сентября',
        10 => 'Октября',
        11 => 'Ноября',
        12 => 'Декабря'
    );

    $time = time();
    $tm = date('H:i', $date);
    $d = date('d', $date);
    $m = date('m', $date);
    $y = date('Y', $date);

    if($time - $date < 60){
        $text =  "Только что";
    }elseif($time - $date > 60 && $time - $date < 3600 ){
        $minute = round(($time - $date)/60);
        if($minute < 55){
            if($minute % 10 == 1 && $minute != 11 ){
                $text =  "$minute минуту назад";
            }elseif($minute % 10 > 1  && $minute% 10 < 5  ){
                $text =  "$minute минуты назад";
            }else{
                $text =  "$minute минут назад";
            }
        }
    }elseif($time - $date > 3600){
        $last = round(($time - $date)/3600);
        if( ($last < 13) && ($d.$m.$y == date('dmY',$time))){
            if($last % 10 == 1 && $last != 11 ){
                $text =  "$last час назад";
            }elseif($last % 10 > 1  && $last% 10 < 5  ){
                $text =  "$last часа назад";
            }else{
                $text =  "$last часов назад";
            }
        }elseif($d.$m.$y == date('dmY',$time)){
            $text =  "Сегодня в $tm";
        }elseif($d.$m.$y == date('dmY', strtotime('-1 day'))){
            $text =  "Вчера в $tm";
        }else{
            $text =  $d.' '.$month_array[(int)($m)].' '.$y;
        }
    }else{
        $text =  $d.' '.$month_array[(int)($m)].' '.$y;
    }

    return $text;
}


?>