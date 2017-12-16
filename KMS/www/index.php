<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,mimimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Key Management Service Statue</title>
    <link rel="shortcut icon" href="static/ico/favicon.ico" type="image/x-icon">
    <style type="text/css">
        body {
            font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
            margin: 0;
            padding: 0;
        }

        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            right: 0px;
            top: 0px;
            bottom: 0px;
        }

        .full-height {
            background-color: #ffffff;
            background-size: cover;
            color: #52606d;
            font-family: 'Raleway';
            font-weight: 100;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            z-index: 100;
            margin-bottom: 15vh;
        }

        .title {
            font-size: 84px;
        }

        .description {
            margin-top: 30px;
            margin-bottom: 50px;
            font-size: 24px;
            font-weight: bold;
        }

        .description-sm {
            margin-top: -20px;
            margin-bottom: 50px;
            font-size: 18px;
            font-weight: normal;
        }

        .links {
            margin-bottom: 50px;
        }

        .link {
            color: #9caebf;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links > a:hover {
            color: #52697f;
        }

        .m-b-md {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .avatar {
            width: 120px !important;
        }
    </style>
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
                    echo "正常";
                } else {
                    echo "离线";
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
        <div class="description-sm">服务器地址：替换这些文字</div>
        <div class="links">
            <a class="link" href="替换这些文字"></i>使用帮助</a>
        </div>
    </div>
</div>
<script src="static/js/particles.js"></script>
<script>
    particlesJS("background", {
        "particles": {
            "number": {
                "value": 15, "density": {
                    "enable": true, "value_area": 800
                }
            }, "color": {
                "value": "#52697f"
            }, "shape": {
                "type": "circle", "stroke": {
                    "width": 0, "color": "#000000"
                }, "polygon": {
                    "nb_sides": 5
                }, "image": {
                    "src": "img/github.svg", "width": 100, "height": 100
                }
            }, "opacity": {
                "value": 0.1, "random": false, "anim": {
                    "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false
                }
            }, "size": {
                "value": 20, "random": true, "anim": {
                    "enable": false, "speed": 20, "size_min": 0.1, "sync": false
                }
            }, "line_linked": {
                "enable": true, "distance": 1000, "color": "#52697f", "opacity": 0.2, "width": 1
            }, "move": {
                "enable": true,
                "speed": 4,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false, "rotateX": 600, "rotateY": 1200
                }
            }
        }, "interactivity": {
            "detect_on": "canvas", "events": {
                "onhover": {
                    "enable": false, "mode": "grab"
                }, "onclick": {
                    "enable": false, "mode": "push"
                }, "resize": true
            }, "modes": {
                "grab": {
                    "distance": 140, "line_linked": {
                        "opacity": 1
                    }
                }, "bubble": {
                    "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3
                }, "repulse": {
                    "distance": 200, "duration": 0.4
                }, "push": {
                    "particles_nb": 4
                }, "remove": {
                    "particles_nb": 2
                }
            }
        }, "retina_detect": true
    });
</script>
</body>
</html>
