<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('LH_LIB_ROOT', './');

require_once LH_LIB_ROOT . 'lhRuNames/classes/lhRuNames.php';

$n = new lhRuNames('Дарья');

echo $n->full()."\n";
echo $n->foundNames();
var_dump($n->short());
var_dump($n->shortVocative());
var_dump($n->unformalVocative());

try {
    echo $n->full("Рита")."\n";
}
catch (Exception $ex) {
    echo $n->foundNames();
}
var_dump($n->short());
var_dump($n->shortVocative());
var_dump($n->unformalVocative());
