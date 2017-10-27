<?php
define("isShell",!isset($_SERVER["HTTP_USER_AGENT"]));
$basedir = dirname(__FILE__);
$pw_f = $basedir."/pw";
$nohttp_f = $basedir."/http.lock";
$needpw = false;
$http = true;
if(file_exists($pw_f)){
    $needpw = true;
    $pw_r = fopen($pw_f,"r");
    define("PW",fgets($pw_r));
    fclose($pw_r);
} elseif(file_exists($nohttp_f)) {
    $http = false;
}
if(isShell || $http && ($needpw === false || md5(md5($_REQUEST["pw"])) === PW)){

    date_default_timezone_set("Asia/Shanghai");  
    $vlmcs_f = dirname($basedir)."/vlmcs-x64-glibc";
    $state_f = $basedir."/state";
    $state = false;

    $vlmcs_p = popen($vlmcs_f,"r") or die("not find file:vlmcs-x64-glibc");
    $state_w = fopen($state_f, "w") or die("not find file:state");
    $return = fgets($vlmcs_p);

    echo HTMLecho(" ----- Waiting for server data ----- ");
    echo nextline();
    echo nextline();

    if(stripos($return,"successful")!==false){
        fwrite($state_w,"online\n".date("Y/m/d H:i")."\n");
        echo HTMLecho("Server Status:Server online");
        $state = true;
    } else {
        fwrite($state_w,"offline\n".date("Y/m/d H:i")."\n");
        echo HTMLecho("Server Status:Server offline");
        $state = false;
    }

    echo nextline();
    echo nextline();

    if($state){
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

    fclose($state_w);
    pclose($vlmcs_p);
} elseif(!$http) {
    echo HTMLecho("Do not allow current access");
} else {
    echo HTMLecho("Please enter the correct password");
}
function nextline(){
    if(!isShell){
        return "<br>\n";
    } 
}

function HTMLecho($text,$label="span"){
    if(isShell){
        return $text."\n";
    } else {
        return "<$label>$text</$label>\n";
    }
}
?>