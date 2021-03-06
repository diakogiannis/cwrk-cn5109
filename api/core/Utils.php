<?php
namespace com\diakogiannis\phpresteasy\api\core;
use com\diakogiannis\phpresteasy\api\core as CORE;
use PhpParser\Node\Expr\Array_;

/**
 * @package com.diakogiannis.phpresteasy.api.core
 * @author Alexius Diakogiannis [alexius.diakogiannis@gmail.com]
 * Date: 02/12/18
 * Time: 22:55
 *
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Created by PhpStorm.
 */

require_once __DIR__.'/../../Constants.php';
require_once (ROOT_PATH.'/api/core/Database.php');

/**
 *
 * Create a Mysql connection
 * Class Utils
 */
class Utils
{

    public function checkIfWithinHours($reservationTime){
        $database = new CORE\Database();
        $timetable = $database->findAll("SELECT HOUR((select config_values from config where config_key = 'starttime')) - HOUR('".$reservationTime."') as tstart, HOUR((select config_values from config where config_key = 'endtime')) - HOUR('".$reservationTime."') as tend");

        if($timetable[0]['tstart'] <= 0 && $timetable[0]['tend'] >= 0) {
            return true;
        }else{
            return false;
        }


    }

    public function checkWithinHolidays($reservationDate){
        $database = new CORE\Database();

       $holidays = $database->findAll("select h_start, h_finish from holidays limit 0,1") ;

       $isNotOk = false;

       foreach ($holidays as $holiday){

          $duration = $this->calculateHolidayDuration($holiday['h_start'],$holiday['h_finish']);
            if(!($this->calculateHolidayDuration($holiday['h_start'],$reservationDate)<0||$this->calculateHolidayDuration($holiday['h_start'],$reservationDate)>$duration)){
                $isNotOk = true;
            }

       }

       return  $isNotOk;

    }



    private function calculateHolidayDuration($hstart, $hend){

        $date_hstart= date("Y-m-d", strtotime($hstart));
        $date_hend= date("Y-m-d", strtotime($hend));

        // calculate the difference
        $difference = strtotime($date_hend) -strtotime($date_hstart);
        return $difference / 60;
    }



}