<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lhRuNamesInterface
 *
 * @author user
 */
interface lhRuNamesInterface {

    public function full($name=null); // Возвращает полную форму переданного имени

    // Функции возвращают массив возможных вариантов имен даже если вариант один
    // должен возвращаться массив содержащий один элемент
    public function dim($name=null);                    // Петечка, Петюша, Петенька, Коленька, Колясик, Андрюша
    public function short($name=null);                  // Петя, Коля, Андрей
    public function dimVocative($param);                // Петечка, Петюш, Петенька, Коленька, Колясь, Андрюш
    public function shortVocative($name=null);          // Петь, Коль, Андрей
    public function unformal($name=null);               // Петро, Петрович, Колян, Андрюха
    public function unformalVocative($name=null);       // Андрюх

    public function setFullName($name);                 // Установка переданного имени как полного
    
}
