<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/4/20
 * Time: 下午1:56
 */


echo " \033[32;40m [OPEN] \033[0m\n";
exit();
$info ='Which type application would you create? (use <space> to select)';
fwrite(\STDOUT, $info.PHP_EOL);
exec('stty -icanon');
fwrite(\STDOUT, html_entity_decode("&#x276F;")." ".html_entity_decode("&#x25CF;")." HTTP".PHP_EOL);
$tcp = "  ".html_entity_decode("&#x25CB;")." TCP"."\e[10D";
fwrite(\STDOUT, $tcp);

fwrite(\STDOUT, "\e[?25l");
$stdin = fopen('php://stdin', 'r');
$sure = false;
while ($char = fread($stdin, 1)) {
    switch ($char) {
        case "\n":
            fwrite(\STDOUT, "\e[0m");
            fwrite(\STDOUT, "\e[?25h");
            $sure = true;
            break; // Break the while loop as well

        case "\e":
            $tmpc = fread($stdin, 2);
            fwrite(\STDOUT, "\e[1A\r");
            if($tmpc=='[B'){

                fwrite(\STDOUT, "  ".html_entity_decode("&#x25CB;")." HTTP".PHP_EOL);
                fwrite(\STDOUT, html_entity_decode("&#x276F;")." ".html_entity_decode("&#x25CF;")." TCP"."\e[10D");
            }else{
                fwrite(\STDOUT, html_entity_decode("&#x276F;")." ".html_entity_decode("&#x25CF;")." HTTP".PHP_EOL);
                fwrite(\STDOUT, "  ".html_entity_decode("&#x25CB;")." TCP"."\e[10D");
            }
            fwrite(\STDOUT, "\e[?25l");
            break;

        case ' ':
            break;
        default:
            break;
    }
    if($sure===true)
        break;
}
exec('stty sane');
exit();