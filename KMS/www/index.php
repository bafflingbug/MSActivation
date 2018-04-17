<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,mimimum-scale=1.0">
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
                $basedir = dirname(__FILE__);
                $state_f = $basedir."/state";
                $file = fopen($state_f, "r") or die("not find file:state");
                $state = fgets($file);
                if(stripos($state,"online")!==false){
                    echo "<span class=\"green\">正常</span>";
                } else {
                    echo "<span class=\"red\">离线</span>";
                }
            ?>
        </div>
        <div class="description-sm">上次检查时间: 
            <?php
                $state = fgets($file);
                echo $state;
                fclose($file);
            ?>
        </div>
        <div class="description-sm">服务器地址： 替换这些文字</div>
        <div class="links">
            <a class="link" href="替换这些文字"></i>使用帮助</a>
        </div>
    </div>
</div>
<script src="static/js/bg.min.js"></script>
</body>
</html>
