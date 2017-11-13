<?php
/**
 * Created by PhpStorm.
 * User: zhaoye
 * Date: 2017/3/24
 * Time: 下午2:36
 */

class DocParser {
    private $params = array ();
    function parse($doc = '') {
        if ($doc == '') {
            return $this->params;
        }
        // Get the comment
        if (preg_match ( '#^/\*\*(.*)\*/#s', $doc, $comment ) === false)
            return $this->params;
        $comment = trim ( $comment [1] );
        // Get all the lines and strip the * from the first character
        if (preg_match_all ( '#^\s*\*(.*)#m', $comment, $lines ) === false)
            return $this->params;
        $this->parseLines ( $lines [1] );
        return $this->params;
    }
    private function parseLines($lines) {
        foreach ( $lines as $line ) {
            $parsedLine = $this->parseLine ( $line ); // Parse the line

            if ($parsedLine === false && ! isset ( $this->params ['description'] )) {
                if (isset ( $desc )) {
                    // Store the first line in the short description
                    $this->params ['description'] = implode ( PHP_EOL, $desc );
                }
                $desc = array ();
            } elseif ($parsedLine !== false) {
                $desc [] = $parsedLine; // Store the line in the long description
            }
        }

        if (! empty ( $desc )){
            $desc = implode ( ' ', $desc );
            $this->params ['long_description'] = $desc;
        }

    }
    private function parseLine($line) {
        // trim the whitespace from the line
        $line = trim ( $line );

        if (empty ( $line ))
            return false; // Empty line

        if (strpos ( $line, '@' ) === 0) {
            $param = null;
            $values = [];
            $explodeArray = explode(' ', substr($line, 1));
            $isParam = false;
            foreach($explodeArray as $key => $value){
                if(!empty($value)){
                    if(!$isParam){
                        $param = $value;
                        $isParam = true;
                    }else{
                        $values[] = str_replace('$', '',$value);
                    }

                }
            }

            // Parse the line and return false if the parameter is valid
            if (!empty($param && $this->setParam ( $param, $values )))
                return false;
        }

        return $line;
    }
    private function setParam($param, $value) {
        if ($param == 'param' || $param == 'return'){
            $this->params[$param][] = $value;
        }else{
            $this->params[$param] = $value[0];
        }
        return true;
    }
}