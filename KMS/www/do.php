<?php
$isShell = !isset($_SERVER["HTTP_USER_AGENT"]);
if($isShell || md5(md5($_REQUEST["password"])) === "66fca27cc754048b3adcd471669188f7"){
    date_default_timezone_set("Asia/Shanghai");

    $basedir = dirname(__FILE__);
    $vlmcs_f = dirname($basedir)."/vlmcs-x64-glibc";
    $state_f = $basedir."/state";

    $vlmcs_p = popen($vlmcs_f,"r") or die("not find file:vlmcs-x64-glibc");
    $state_w = fopen($state_f, "w") or die("not find file:state");
    $return = fgets($vlmcs_p);
    if(stripos($return,"successful")!==false){
        fwrite($state_w,"online ".date("Y年m月d日 H:i"));
        echo "server online\n";
    } else {
        fwrite($state_w,date("Y年m月d日 H:i"));
        echo "server offline\n";
    }
    if(!$isShell){
        echo "<hr />";
    }
    echo " ----- Server Status Updated ----- \n";
    fclose($state_w);
    pclose($vlmcs_p);
}
?>