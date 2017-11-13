<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/4/11
 * Time: 下午3:26
 */

function newChild($func_name) {
    echo "enter newChild\n";
    $args = func_get_args();
    unset($args[0]);
    $pid =  pcntl_fork();
    if ($pid == 0) {
        function_exists($func_name) and exit(call_user_func_array($func_name, $args)) or exit(-1);
    } else if($pid == -1) {
        echo "Couldn't create child process";
    } else {
        return $pid;
    }
}

function on_timer() {
    $pid = posix_getpid();
    echo "timer called:$pid\n";
}

/**
 * @param $func string, function name
 * @param $timeouts int, microtimes for time delay
 */
function timer($func, $timeouts){

    echo "enter timer\n";
    $base = event_base_new();
    var_dump($base);
    $event = event_new();

    var_dump($event);
    event_set($event, 0, EV_TIMEOUT, $func);
    event_base_set($event, $base);
    event_add($event, $timeouts);

    event_base_loop($base);
}

$pid = newChild("timer", "on_timer", 5000000);

if ($pid > 0) {
    $pid = posix_getpid();

    echo "pid:$pid, master process exit\n";
}