<?php 

function validate_extension($ext) {
    if ($ext == 'docx' || $ext == 'doc' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'pdf' || $ext == 'txt') {
    	$return = 'true';
    }
    else {
    	$return = 'false';
    }

    return $return;
}

function human_date($date) {
    $explode = explode('-',$date);
    return $explode[2].' '.month($explode[1]).' '.$explode[0];
}

function month($get_month) {
    if (strlen($get_month) == 1) {
        $month = '0'.(string)$get_month;
    }
    else {
        $month = $get_month;
    }
    
    $array = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];
    return $array[$month];
}