<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lhRuNames
 *
 * @author user
 */
require_once __DIR__ . '/../abstract/lhAbstractRuNames.php';

class lhRuNames extends lhAbstractRuNames {
    protected $found_names;

    protected function setNames() {
        $names = $this->findName();
        $this->names['full'] = array_shift($names);
        foreach ($names as $name) {
            if (preg_match("/^_!(.+)/", $name, $matches)) {
                $this->names['dim-voc'][] = $matches[1];
            } elseif (preg_match("/^#!(.+)/", $name, $matches)) {
                $this->names['unf-voc'][] = $matches[1];
            } else {
                preg_match("/^([!_#]?)(.+)/", $name, $matches);
                switch ($matches[1]) {
                    case '!':
                        $this->names['voc'][] = $matches[2];
                        break;
                    case '_':
                        $this->names['dim'][] = $matches[2];
                        break;
                    case '#':
                        $this->names['unf'][] = $matches[2];
                        break;
                    case '':
                        $this->names['short'][] = $matches[2];
                        break;
                    default:
                        throw new Exception('Не верный префикс имени в базе имен');
                }
            }
        }
    }
    
    protected function findName() {
        $name = $this->name;
        $this->known_name = false;
        $this->gender = null;
        
        $names_array = [];
        
        if (preg_match_all("/^((.*)[_#\s]$name(.*))$/um", self::$mens_names, $matches)) {
            if (count($matches)) $this->gender = self::$gender_male;
            $names_array = array_merge($names_array, $matches[1]);
            $this->known_name = true;
        }
        if (preg_match_all("/^((.*)[_#\s]$name(.*))$/um", self::$womens_names, $matches)) {
            if (count($matches)) $this->gender = $this->gender ? null : self::$gender_female;
            $names_array = array_merge($names_array, $matches[1]);
            $this->known_name = true;
        }
        
        if (count($names_array) != 1) {
            $found_names = [];
            foreach ($names_array as $line) {
                $split = preg_split("/\s+/", trim($line), 2);
                $found_names[] = $split[0];
            }
            $this->found_names = implode(' ', $found_names);
            throw new Exception("Имя не найдено или найдено больше одного имени");
        }
        return preg_split("/\s+/", trim($names_array[0]));
    }
    
    public function short($name=null) {
        return ($this->names['short']) ? $this->names['short'] : [$this->full()];
    }
    public function shortVocative($name=null) {
        return ($this->names['voc']) ? $this->names['voc'] : $this->short();
    }
    public function dim($name=null) {
        return ($this->names['dim']) ? $this->names['dim'] : $this->short();
    }
    public function dimVocative($name=null) {
        return ($this->names['dim-voc']) ? $this->names['dim-voc'] : $this->dim();
    }
    public function unformal($name=null) {
        return ($this->names['unf']) ? $this->names['unf'] : [$this->full()];
    }
    public function unformalVocative($name=null) {
        return ($this->names['unf-voc']) ? $this->names['unf-voc'] : $this->unformal();
    }
    public function full($name=null) {
        return $this->names['full'];
    }

}
