<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('LH_LIB_ROOT', './');

require_once LH_LIB_ROOT . 'lhRuNames/classes/lhRuNames.php';

$n = new lhRuNames('Маша');

echo $n->full()."\n";
var_dump($n->short());
var_dump($n->shortVocative());
var_dump($n->unformalVocative());
