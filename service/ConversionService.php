<?php
/**
 * Created by PhpStorm.
 * User: mde
 * Date: 30/06/17
 * Time: 11:55
 */

namespace service;


class ConversionService
{

    /**
     * Converts a "flat" json object with malformed keys to a nested array.
     * Converts ['path.to.key' => 'value'] to ['path' => ['to' => ['key' => value ]]]
     * @param $flat JSON array
     * @param array $nested
     * @return array nested array
     */
    function fromFlatToNested($flat, $nested = array())
    {

        foreach ($flat as $key => $value) {
            $array = &$nested;
            // convert 'path.to.key' to ['path', 'to','key']
            $parts = explode('.', $key);
            $len = count($parts);
            for ($i = 0; $i < $len; $i++) {
                $part = $parts[$i];

                if ($i == $len - 1) {
                    // Affect LEAF value
                    $array[$part] = $value;
                } else if (!array_key_exists($part, $array)) {
                    // Create missing parents
                    $array = &$array[$part];
                }
            }
        }
        return $nested;
    }

    /**
     * Does the contrary of fromFlatToNested
     * @param $nested
     * @param array $flat
     * @return array
     */
    function fromNestedToFlat($nested, $flat = array())
    {
            $path = array();
            $this->buildKeyPath($nested, $path, $flat);
            return $flat;
    }

    /**
     * Builds the key by traversing the nested array
     * and affects value to built key
     * @param $nested
     * @param $path
     * @param $flat
     * @return mixed
     */
    function buildKeyPath($nested, $path, &$flat)
    {
        foreach ($nested as $key => $value) {

            $path[] = $key;
            if (is_array($value)) {
                $this->buildKeyPath($nested[$key], $path, $flat);
            } else {
                $flatKey = join('.', $path);
                $flat[ $flatKey ] = $value;
                $path = [];
            }
        }
        return $value;
    }

}