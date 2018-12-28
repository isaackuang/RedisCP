<?php

class RedisPool
{
    public $redis;
    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('/tmp/redis.sock');
    }

    public function __call(string $methodName, array $parameters = [])
    {
        if (method_exists($this->redis, $methodName)) {
            return call_user_func_array([$this->redis, $methodName], $parameters);
        }
        throw new RuntimeException("Method $methodName not exists.");
    }

}
