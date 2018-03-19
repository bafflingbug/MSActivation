### KMS

#### 使用帮助
1.  复制KMS文件夹到/data目录下
2.  打开`/etc/rc.local` (添加开机自启动)

        vi /etc/rc.local

3.  添加

        cd /data/kms
        nohup ./vlmcsd-x64-glibc > log.out 2>&1 &
        php /data/kms/www/do.php

4.  打开`corntab -e`(添加计划任务)
    添加

        */10 * * * * /usr/local/php5/bin/php /data/kms/www/do.php

5.  配置Nginx反向代理

        server {
            listen       80;
            server_name  kms.bafflingbug.cn;
            
            location / {
                root   /data/kms/www;
                index  index.php;
            }
            location = /50x.html {
                root   /usr/local/nginx/html;
            }
            location ~ \.php$ {
                root           /data/kms/www;
                fastcgi_param  HTTPS $https if_not_empty; 
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_param  SCRIPT_FILENAME  /data/kms/www/$fastcgi_script_name;
                include        fastcgi_params;
            }
        }


6.  重启Nginx

        service nginx restart

#### 使用tool.php
用于设置外部访问do.php的权限 **(外部访问do.php可手动更新服务器状态)**  
##### 参数说明
参数|说明|示例
:---|:---:|:---:
-u/--nopw|允许外部访问|php tool.php -u<br>php tool.php --nopw
-p/--pw|允许使用密码保护的外部访问<br>当没有设置密码时候使用默认密码123|php tool.php -p=123<br>php tool.php --pw=123<br>php tool.php -p ***(使用默认密码)***
-b/--ban|不允许使用外部访问|php tool.php -b<br>php tool.php --ban
##### 使用密码保护的外部访问
访问 http://*your_domain or IP*/do.php?pw=*your_password*
##### 外部访问的作用
1. 立即更新服务器状态
2. 使用云监控替代计划任务

### Thanks
[Wind4/vlmcsd](https://github.com/Wind4/vlmcsd):KMS Emulator in C
