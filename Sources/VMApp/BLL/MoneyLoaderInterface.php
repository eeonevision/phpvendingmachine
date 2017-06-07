<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 9:02 PM
 */

namespace VMApp\BLL;


interface MoneyLoaderInterface
{
    public function __construct($moneyPath);
    public function load();
}