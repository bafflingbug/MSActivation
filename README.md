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
            listen      443 ssl;
            server_name  kms.bafflingbug.cn;
            ssl on;
            ssl_certificate 1_kms.bafflingbug.cn_bundle.crt;
            ssl_certificate_key 2_kms.bafflingbug.cn.key;
            ssl_session_timeout 5m;
            ssl_protocols TLSv1 TLSv1.1 TLSv1.2; #按照这个协议配置
            ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:HIGH:!aNULL:!MD5:!RC4:!DHE;#按照这个套件配置
            ssl_prefer_server_ciphers on; 
            location / {
                root   /data/kms/www;
                index  index.php;
            }
            location = /50x.html {
                root   /usr/local/nginx/html;
            }
            error_page 497  https://$host$uri$args;
            location ~ \.php$ {
                root           /data/kms/www;
                fastcgi_param HTTPS $https if_not_empty; 
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
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