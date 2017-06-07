<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 9:11 PM
 */

namespace VMApp\BLL;


class JsonMoneyLoader implements MoneyLoaderInterface
{
    private $file;
    /**
     * JsonMoneyLoader constructor.
     * @param $moneyPath
     */
    public function __construct($moneyPath)
    {
        $this->file = file_get_contents($moneyPath);
    }

    /**
     * Load the money balance of vending machine from json file
     */
    public function load()
    {
        $result = json_decode($this->file, true);
        if(json_last_error() === 0){
            return $result;
        } else {
            echo "JSON file has invalid format!";
            return null;
        }
    }
}