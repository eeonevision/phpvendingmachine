<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 9:02 PM
 */

namespace VMApp\BLL;


interface DataLoaderInterface
{
    public function __construct($filePath);
    public function load();
}