<?php
/*
 * default Auditflow Helper
 * Author: Griffith Tchenpan
 */

/**
 * default model load function
 * @param <string> $modelname model name
 * @param <string> $dsn optional
 * @return mname
 */

function mload($modelname, $dsn = null)
{
    $CI =& get_instance();
    $CI->load->model("$modelname", "mname");
    if (empty($dsn))
        return new $CI->mname();
    else 
        return new $CI->mname($dsn);
}


// print_r()
function pr($obj, $returnvalue = false, $fontsize = "10")
{
    if (ENVIRONMENT == "development"){
        $return = "<div id='debug_pr' style='clear:both; margin: 0px 15%; font-size: ".$fontsize."px;'> <pre style='margin-top: 100px;'>";
        $return .= print_r($obj, true);
        $return .= "</pre></div>";
        if ($returnvalue){
            return $return;
        } else {
            echo $return;
        }
    }
}

//print_r() and log_message()
function prlog($obj, $referer = true)
{
    $return = print_r($obj, true);
    $pre = '';
    if ($referer){
        $trace = debug_backtrace();
        foreach($trace as $f=>$t){
            if ($t['function'] == "prlog")
            $pre .= "line:".$t["line"]." ".$t["file"];
        }
        $pre .= "\n";
    }
    log_message("error",$pre."\t\t\t\t".$return);
}

//helper function to trace origine of the called function
function traceme()
{
    $pre = "TRACE DEBUG START\n";
    $trace = debug_backtrace();
    foreach($trace as $f=>$t){
        if ($t['function'] == "traceme") continue;
        if ($t['function'] == "call_user_func_array") continue;
        $file = isset($t['file'])? $t['file'] : '';
        if ($file == $_SERVER['SCRIPT_FILENAME']) continue;
        $line = isset($t['line'])? $t['line'] : '';
        $line = str_pad("ln:".$line, 12);
        $function = isset($t['function'])? $t['function'] : '';
        $function = str_pad($function, 32);
        $pre .= $line.$function." >> ".$file."\n";
    }
    log_message("error",$pre." -- TRACE DEBUG END -- ");
}

function dateago($datetime){
    $timediff = time() - $datetime;
    $val = date("Y",time()) == date("Y",$datetime)?  date("F d",$datetime) :  date("F d, Y",$datetime);
    switch($timediff){
        case $timediff < 60:
            $val = "few seconds ago";
            break;
        case $timediff < 120:
            $val = "2 mins ago";
            break;
        case $timediff < 600:
            $val = "10 mins ago";
            break;
        case $timediff < 900:
            $val = "15 mins ago";
            break;
        case $timediff < 1200:
            $val = "20 mins ago";
            break;
        case $timediff < 1800:
            $val = "30 mins ago";
            break;
        case $timediff < 3600:
            $val = "1 hour ago";
            break;
        case $timediff < 7200:
            $val = "2 hours ago";
            break;
        case $timediff < 10800:
            $val = "3 hours ago";
            break;
        case floor($timediff/86400) == 0:
            $val = "today";
            break;
        case $timediff < 432000: // < 5days
            $val = floor((time() - $datetime)/86400);
            $val = $val > 1 ? $val." days ago" : "1 day ago";
            break;
    }
    return $val;

}

function _date($format, $unixdate, $defaultstring = "0")
{
    if (empty($unixdate)) return $defaultstring;
    return date($format, $unixdate);
}

//http://php.net/manual/en/function.filesize.php
function format_bytes($size, $round = 0) {
    $units = array(' B', ' KB', ' MB', ' GB', ' TB');
    for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
    return round($size, $round).$units[$i];
}

?>

