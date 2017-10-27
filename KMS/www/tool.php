<?php
define("isShell",!isset($_SERVER["HTTP_USER_AGENT"]));
$basedir = dirname(__FILE__);
$pw_f = $basedir."/pw";
$nohttp_f = $basedir."/http.lock";
if(isShell){
    $param_arr = getopt("p::u::b::",array("pw::","nopw::","ban::"));
    if(array_key_exists("p",$param_arr) || array_key_exists("pw",$param_arr)){
        $pw_w = fopen($pw_f,"w");
        if(array_key_exists("p",$param_arr)){
            if($param_arr["p"] != ""){
                fwrite($pw_w,md5(md5($param_arr["p"])));
            } else {
                fwrite($pw_w,"d9b1d7db4cd6e70935368a1efb10e377");
            }
        } else {
            if($param_arr["pw"] != ""){
                fwrite($pw_w,md5(md5($param_arr["pw"])));
            } else {
                fwrite($pw_w,"d9b1d7db4cd6e70935368a1efb10e377");
            }
        }
        fclose($pw_w);
        if(file_exists($nohttp_f)){
            unlink($nohttp_f);
        }
        echo "设置web访问为需要密码模式\n";
    }
    if(array_key_exists("u",$param_arr) || array_key_exists("nopw",$param_arr)){
        if(file_exists($pw_f)){
            unlink($pw_f);
        }
        if(file_exists($nohttp_f)){
            unlink($nohttp_f);
        }
        echo "设置web访问为无密码模式\n";
    }
    if(array_key_exists("b",$param_arr)|| array_key_exists("ban",$param_arr)){
        $nohttp_w = fopen($nohttp_f,"w");
        fclose($nohttp_w);
        if(file_exists($pw_f)){
            unlink($pw_f);
        }
        echo "仅允许Shell访问\n";
    }
}
?>