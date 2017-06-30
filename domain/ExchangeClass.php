<?php
/**
 * Created by PhpStorm.
 * User: mde
 * Date: 30/06/17
 * Time: 11:08
 */

namespace domain;


class Exchange
{
    private $source;

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource(Source $source)
    {
        $this->source = $source;
    }



}