<?php
// is config
$pw = '';
$needpw = false;
$http = true;
$expire = 600;

// is code
define("isShell",!isset($_SERVER["HTTP_USER_AGENT"]));
define("fromroot", isset($fromroot));
$basedir = dirname(__FILE__);
$cache_cf = str_replace("\\", "/", dirname(__FILE__)) . '/cache.php';
include_once($cache_cf);
if (!isset($c)) {
    $c = new cache();
}
$status = array('online' => false, 'check_time' => null);
if(fromroot || isShell || $http && ($needpw === false || md5(md5($_REQUEST["pw"])) === $pw)){

    date_default_timezone_set("Asia/Shanghai");  
    $vlmcs_f = dirname($basedir)."/vlmcs-x64-glibc kms.bafflingbug.cn";

    $vlmcs_p = popen($vlmcs_f,"r") or die("not find file:vlmcs-x64-glibc");
    $return = fgets($vlmcs_p);
    $status['check_time'] = date("Y/m/d H:i");

    echo HTMLecho(" ----- Waiting for server data ----- ");
    echo nextline();
    echo nextline();

    if(stripos($return,"successful")!==false){
        $status['online'] = true;
        echo HTMLecho("Server Status:Server online");
    } else {
        $status['online'] = false;
        echo HTMLecho("Server Status:Server offline");
    }

    $c->set('kms_status', $status, $expire);

    echo nextline();
    echo nextline();

    if(isset($status['online']) && status['online']){
        echo HTMLecho("Server return :");
        echo nextline();
        $return = fgets($vlmcs_p);
        while($return!==false){
            $return = str_replace("\n","",$return);
            echo HTMLecho($return,"code");
            echo nextline();
            $return = fgets($vlmcs_p);
        }
        echo nextline();
    }

    echo HTMLecho(" ----- Server Status Updated ----- ");

    pclose($vlmcs_p);
} elseif(!$http) {
    echo HTMLecho("Do not allow current access");
} else {
    echo HTMLecho("Please enter the correct password");
}
function nextline(){
    if(!isShell && !fromroot){
        return "<br>\n";
    } 
}

function HTMLecho($text,$label="span"){
    if (fromroot) {
        return;
    }else if(isShell){
        return $text."\n";
    } else {
        return "<$label>$text</$label>\n";
    }
}
