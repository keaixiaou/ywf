<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/4/1
 * Time: 下午3:45
 */



require 'file.php';

$a = new File();
echo $a->get();


sleep(5);

zrunkit_import("file.php", RUNKIT_IMPORT_CLASS_METHODS|RUNKIT_IMPORT_OVERRIDE);
echo $a->get();