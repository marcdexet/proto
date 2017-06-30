<?php
/**
 * Created by PhpStorm.
 * User: mde
 * Date: 30/06/17
 * Time: 11:15
 */

namespace domain;

use ReflectionClass;


class Source
{
    var $distanceTravail;
    var $nbre_l;
    var $type;
    var $laser;

    function __construct()
    {
        if ( ! Source::$mappers ) {
            $reflect = new ReflectionClass('domain\Source');
            $props = $reflect->getProperties();
            print_r($props);
            $fn = array();
            foreach ($props as $prop) {

                $name = $prop->getName();
                $q = $prop;

                $f = function(&$obj, &$value) {
                    $q->setValue($obj, $value);
                };
                $fn[$name]=&$f;
            }
            Source::$mappers = &$fn;
            print_r(Source::$mappers);
        }
    }


    function mapFromJson($json)
    {
        foreach ($json as $key => $value) {
            $m = Source::$mappers;
            if ( array_key_exists($key, $m) ) {
                $c = $m[$key];
                $c($this,$value);
            }
        }
        print_r($this);
    }

    private static $mappers;
}