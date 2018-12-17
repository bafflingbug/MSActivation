<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Key Management Service Statue</title>
    <link rel="shortcut icon" href="static/ico/favicon.ico" type="image/x-icon">
    <link href="static/css/kms.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="flex-center position-ref full-height">
    <div id="background" class="background"></div>
    <div class="content">
        <div class="description">KMS服务器</div>
        <div class="description-sm">运行状态： 
            <?php
                $cache_cf = str_replace("\\", "/", dirname(__FILE__)) . '/cache.php';
                include_once($cache_cf);
                $c = new cache();
                $online_s = $c->get('kms_status');
                if (!isset($online_s)) {
                    $fromroot = true;
                    $do_cf = str_replace("\\", "/", dirname(__FILE__)) . '/do.php';
                    include_once($do_cf);
                } else {
                    $time_s = $c->get('kms_time');
                }
                if(stripos($online_s,"online")!==false){
                    echo "<span class=\"green\">正常</span>";
                } else {
                    echo "<span class=\"red\">离线</span>";
                }
            ?>
        </div>
        <div class="description-sm">上次检查时间: 
            <?php
                echo $time_s;
            ?>
        </div>
        <div class="description-sm">服务器地址： kms.bafflingbug.cn</div>
        <div class="links">
            <a class="link" href="https://blog.bafflingbug.cn/post/169.html">使用帮助</a>
        </div>
    </div>
</div>
<script src="static/js/bg.min.js"></script>
</body>
</html>
