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
        $this->setNameForms($names);
    }
    
    protected function setNameForms($names) {
        $this->names = [];
        $this->names['full'] = array_shift($names);
        foreach ($names as $name) {
            if (preg_match("/^_!(.+)/u", $name, $matches)) {
                $this->names['dim-voc'][] = $matches[1];
            } elseif (preg_match("/^#!(.+)/u", $name, $matches)) {
                $this->names['unf-voc'][] = $matches[1];
            } else {
                preg_match("/^([!_#]?)(.+)/u", $name, $matches);
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
        $this->found_names = '';

        $mens_array = $this->getMatching($name, self::$mens_names);
        $womens_array = $this->getMatching($name, self::$womens_names);
        $count_m = count($mens_array);
        $count_w = count($womens_array);
        if ($count_m && !$count_w) {
            $this->gender = self::$gender_male;
            $names_array = $mens_array;
        } elseif (!$count_m && $count_w) {
            $this->gender = self::$gender_female;
            $names_array = $womens_array;
        } elseif ($count_m && $count_w) {
            $names_array = array_merge($mens_array, $womens_array);
        } else {
            $this->name = null;
            throw new Exception("Не найдено подходящего имени", 1);
        }

        $this->known_name = true;
        $this->setFoundNames($names_array);
        return preg_split("/\s+/u", trim($names_array[0]));
    }

    protected function setFoundNames($names_array) {
        foreach ($names_array as $line) {
            $found_names[] = preg_replace("/^(\w+).*$/u", "$1", $line);
        }
        $this->found_names = implode(' ', $found_names);
        if (isset($found_names[1])) {
            $this->name = null;
            throw new Exception("Найдено больше одного имени", 2);
        }
    }
    
    protected function getMatching($name, $names) {
        $matching = [];
        if (preg_match_all("/^((.*)[_#\s]${name}\b(.*))$/um", $names, $matches)) {
            $matching = array_merge($matching, $matches[1]);
        }
        $new_matching = [];
        foreach ($matching as $string) {
            $new_matching[] = trim($string);
        }
        return $new_matching;
    }
    
    public function short($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return (!empty($this->names['short'])) ? $this->names['short'] : [$this->full()];
    }
    public function shortVocative($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return (!empty($this->names['voc'])) ? $this->names['voc'] : $this->short();
    }
    public function dim($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return (!empty($this->names['dim'])) ? $this->names['dim'] : $this->short();
    }
    public function dimVocative($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return (!empty($this->names['dim-voc'])) ? $this->names['dim-voc'] : $this->dim();
    }
    public function unformal($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return ($this->names['unf']) ? $this->names['unf'] : [$this->full()];
    }
    public function unformalVocative($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return ($this->names['unf-voc']) ? $this->names['unf-voc'] : $this->unformal();
    }
    public function full($name=null) {
        $this->setName($name);
        if (empty($this->name)) {throw new Exception("Имя не установлено", 5);}
        return $this->names['full'];
    }
    
    public function foundNames() {
        return $this->found_names;
    }

    public function setFullName($name) {
        $this->name = $name;
        $this->known_name = false;
        $this->gender = null;
        $this->found_names = '';

        $total = preg_match("/^\s+(${name}\b.*)$/um", self::$mens_names, $mens) + preg_match("/^\s+(${name}\b.*)$/um", self::$womens_names, $womens);
        if ($total > 1) {
            $this->name = null;
            throw new Exception("Найдено больше одного полного имени", 4);
        } elseif ($total == 0) {
            $this->name = $name;
            $this->setNameForms([$name]);
            throw new Exception("Полное имя не найдено", 3);
        } else {
            if (count($mens)) {
                $this->gender = self::$gender_male;
                $this->setNameForms(preg_split("/\s+/u", $mens[1]));
            } else {
                $this->gender = self::$gender_female;
                $this->setNameForms(preg_split("/\s+/u", $womens[1]));
            }
            $this->known_name = true;
        }
    }
}
