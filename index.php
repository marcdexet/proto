<?php
require_once "./samples/SampleService.php";
require_once "./service/ConversionService.php";
require_once "./domain/SourceClass.php";

use samples\SampleService;
use service\ConversionService;


class Index
{
    function run() {
        $sampleService = new SampleService();
        $conversionService = new ConversionService();

        print_r($sampleService->generateSample("std"));
        echo "\n";
        $jsonGarcia = $sampleService->generateSample("garcia");
        print_r($jsonGarcia);

        $nested = $conversionService->fromFlatToNested( json_decode($jsonGarcia));
        print_r($nested);

        $flat = $conversionService->fromNestedToFlat($nested);
        print_r($flat);

        $src = new \domain\Source();

        $src->mapFromJson($nested);



    }
}

$index = new Index();
$index->run();



