<?php 
function datesToDays($array,$days) {
    
    $nR='<span style="color:red">No Record</span>';
    $returnMe = array();
    $day = date('D');
    
    for ($i=$days; $i>=0; $i--){
        $returnMe[date('D',strtotime($day.' - '.$i.' days'))] = $nR;
    }

    foreach ($array as $date => $value){
        $today = date("Y-m-d");
        $time = strtotime($today.' - '.$days.' days');
        if (strtotime($date) >= $time) {
            $returnMe[date('D', strtotime($date))] = $value.'&#8451;';
        }
    }
        return $returnMe;    
}
