### KMS
**vlmcsd-x64-glibc仅用于测试使用，请替换部署微软官方的KMS服务器**
#### 使用帮助
0. 确认已经安装redis和php-redis组件
1. 复制KMS文件夹到/data目录下
2. 打开`/etc/rc.local`并添加 (添加开机自启动)

        cd /home/kms
        nohup ./vlmcsd-x64-glibc > log.out 2>&1 &
        php /home/kms/www/do.php

3. 修改配置（可选）

    详细内容见“配置”一节

4. 打开`corntab -e`(添加计划任务/可选)并添加

        */10 * * * * /usr/local/php5/bin/php /home/kms/www/do.php

5.  配置Nginx反向代理

        server {
            listen       80;
            server_name  example.com;
            
            location / {
                root   /home/kms/www;
                index  index.php;
            }
            location = /50x.html {
                root   /usr/local/nginx/html;
            }
            location ~ \.php$ {
                root           /home/kms/www;
                fastcgi_param  HTTPS $https if_not_empty; 
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_param  SCRIPT_FILENAME  /home/kms/www/$fastcgi_script_name;
                include        fastcgi_params;
            }
        }


6.  重启Nginx

        service nginx restart

#### 配置
1. do.php的配置

     配置项|说明|类型
     :---|:---:|:---:
     $pw|原始密码两次md5加密后的值（均为32位小写）|string
     $needpw|是否需要密码|bool
     $http|是否允许通过http执行do.php|bool
     $expire|缓存的生效时间（秒）| int

2. cache.php的配置

     配置项|说明|类型
     :---|:---:|:---:
     $host|redis使用的域名或者ip|string
     $port|redis使用的端口|string

##### 使用密码保护的外部访问
访问 http://*your_domain or IP*/do.php?pw=*your_password*
##### 外部访问的作用
1. 立即更新服务器状态
2. 使用云监控替代计划任务

### Thanks
[Wind4/vlmcsd](https://github.com/Wind4/vlmcsd):KMS Emulator in C
