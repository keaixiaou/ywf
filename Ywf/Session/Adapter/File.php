<?php
/**
 * User: shenzhe
 * Date: 13-6-17
 */


namespace Ywf\Session\Adapter;

use Ywf\Session\Handle;

class File implements Handle
{
    public function get()
    {
        session_start();
        return $_SESSION;
    }

    public function set($data)
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
}