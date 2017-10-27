<?php
date_default_timezone_set("Asia/Shanghai");

$basedir = dirname(__FILE__);
$vlmcs_f = dirname($basedir)."/vlmcs-x64-glibc";
$state_f = $basedir."/state";

$vlmcs_p = popen($vlmcs_f,"r") or die("not find file:vlmcs-x64-glibc");
$state_w = fopen($state_f, "w") or die("not find file:state");
$return = fgets($vlmcs_p);
if(stripos($return,"successful")!==false){
    fwrite($state_w,"online ".date("Y年m月d日 H:i"));
} else {
    fwrite($state_w,date("Y年m月d日 H:i"));
}
fclose($state_w);
pclose($vlmcs_p);
?>