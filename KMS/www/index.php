<?php
    // is config
    $kms_path = 'kms.bafflingbug.cn';
    $help_url = 'https://blog.bafflingbug.cn/post/169.html';
?>
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
                    // is code
                    $cache_cf = str_replace("\\", "/", dirname(__FILE__)) . '/cache.php';
                    include_once($cache_cf);
                    $c = new cache();
                    $status = $c->get('kms_status');
                    if (!isset($status) || !isset($status['online']) || !isset($status['check_time'])) {
                        $fromroot = true;
                        $do_cf = str_replace("\\", "/", dirname(__FILE__)) . '/do.php';
                        include_once($do_cf);
                    }
                    if($status['online']){
                        echo "<span class=\"green\">正常</span>\n";
                    } else {
                        echo "<span class=\"red\">离线</span>\n";
                    }
                ?>
            </div>
            <div class="description-sm">上次检查时间: 
                <?php
                    echo $status['check_time']."\n";
                ?>
            </div>
            <div class="description-sm">服务器地址:
                <?php
                    echo $kms_path."\n";
                ?>
            </div>
            <?php
                if(isset($help_url) && $help_url != null && $help_url != '') {
                  echo "<div class=\"links\">\n                <a class=\"link\" href=\"" . $help_url . "\">使用帮助</a>\n            </div>\n";
                }
            ?>
        </div>
    </div>
    <script src="static/js/bg.min.js"></script>
    </body>
</html>
