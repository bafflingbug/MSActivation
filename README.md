### KMS

#### 使用帮助
1.  复制KMS文件夹到/data目录下
2.  打开`/etc/rc.local` (添加开机自启动)

        vi /etc/rc.local

3.  添加

        cd /data/kms
        ./vlmcsd-x64-glibc &

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
