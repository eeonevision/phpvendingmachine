<?php

/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 8:54 PM
 */
namespace VMApp\Models;
class Product
{
    private $name;
    private $price;
    private $amount;

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price = $price;
    }

    public function getAmount(){
        return $this->amount;
    }
    public function setAmount($amount){
        $this->amount = $amount;
    }
}