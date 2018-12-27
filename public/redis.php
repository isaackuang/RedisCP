<?php

$redis = new Redis();
$redis->connect('/tmp/redis.sock');
$redis->set("foo", "bar");
echo $redis->get("foo") . PHP_EOL;
