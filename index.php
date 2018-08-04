<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('LH_LIB_ROOT', './');

require_once LH_LIB_ROOT . 'lhRuNames/classes/lhRuNames.php';

echo "Тестирование lhRuNames";
$test_names = [
  // Имя,    Полное или код исключения, Найденные имена,  Пол, результат setFullName, уменьшительное звательное
    ["Рита", 2,                         "Маргарита Рита", 0,   "Рита",                "Ритуль Ритусь Тусь"],
    ["Саша", 2,                         "Александр Александра", null, 3, 'Саша'],
    ["Петя", "Петр",                    "Петр", 1, 3, 'Петя'],
    ["Неттакого", 1, "", null, 3, 'Неттакого']
];

$n = new lhRuNames('Петр');
foreach ($test_names as $test) {
    try {
        $full = $n->full($test[0]);
        if ($full !== $test[1]) {
            echo "$test[0] full - FAIL!!! - Ожидалось \"$test[1]\", получено \"$full\"";
            die();
        }
    } catch (Exception $exc) {
        $code = $exc->getCode();
        if ( $code !== $test[1]) {
            echo "$test[0] code - FAIL!!! - Ожидалось \"$test[1]\", получено \"$code\"";
            die();
        }
    }
    echo '.';
    $found = $n->foundNames();
    if ($found !== $test[2]) {
        echo "$test[0] found - FAIL!!! - Ожидалось \"$test[2]\", получено \"$found\"";
        die();
    }
    echo '.';
    $gender = $n->gender();
    if ($gender !== $test[3]) {
        echo "$test[0] gender - FAIL!!! - Ожидалось \"$test[3]\", получено \"$gender\"";
        die();
    }
    echo '.';
    try {
        $n->setFullName($test[0]);
        $full = $n->full();
        if ($full !== $test[4]) {
            echo "$test[0] setFullName - FAIL!!! - Ожидалось \"$test[4]\", получено \"$full\"";
            die();
        }
    } catch (Exception $exc) {
        $code = $exc->getCode();
        if ( $code !== $test[4]) {
            echo "$test[0] code - FAIL!!! - Ожидалось \"$test[4]\", получено \"$code\"";
            die();
        }
    }
    echo '.';
    $dim_voc = implode(' ', $n->dimVocative());
    if ($dim_voc !== $test[5]) {
        echo "$test[0] dimVocative - FAIL!!! - Ожидалось \"$test[5]\", получено \"$dim_voc\"";
        die();
    }
    echo '.';


}
echo "ok\n";

