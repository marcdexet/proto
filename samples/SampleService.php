<?php
/**
 * Created by PhpStorm.
 * User: mde
 * Date: 30/06/17
 * Time: 11:19
 */

namespace samples;


class SampleService
{
    public function generateSample($id) {
        if( !$id) {
            $id="std";
        }
        $data = [];

        if ( $id === "std" ) {
            $data = [
                'distanceTravail' => 2,
                'sou' =>  [
                    'nbre_l' => 1,
                    'type' => 1,
                    'las' => [
                        'app1' => 1,
                        't' => 1.23,
                        'ttot' => 1,
                        'fp' => 5.2345
                    ]
                ]
            ];
        }

        if ( $id === "garcia" ) {

            $data = [
                'distanceTravail' => 2,
                'sou.nbre_l' => 1,
                'sou.type' => 1,
                'sou.las.app1' => 1,
                'sou.las.t' => 1.23,
                'sou.las.ttot' => 1,
                'sou.las.fp' => 5.2345,
                'foo.pts' => [1.0, 2.0, 3.0]
            ];
        }
        return json_encode($data, JSON_PRETTY_PRINT);
    }

}