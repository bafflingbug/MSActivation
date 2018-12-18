<?php
class cache{
        private $redis;

	// config start
        private $host = 'localhost';
        private $port = '6379';
        // config end

        function __construct(){
                $this->redis = new Redis();
                $this->redis->pconnect($this->host, $this->port);
        }

        function get($key){
                $data = $this->redis->get($key);
                return unserialize($data) ?: null;
        }

        function set($key, $value=null, $expire=600){
                return $this->redis->set($key, serialize($value), $expire);
        }

        function clear($keys){
                $this->redis->unlink($keys);
        }
}
