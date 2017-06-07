<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 9:27 PM
 */

namespace VMApp\Models;


class Money
{
    private $owner;
    private $money;

    public function __construct($owner, $money)
    {
        $this->money = $money;
        $this->owner = $owner;
    }

    public function getOwner(){
        return $this->owner;
    }
    public function setOwner($owner){
        $this->owner = $owner;
    }

    public function getMoney(){
        return $this->money;
    }
    public function setMoney($money){
        $this->money = $money;
    }
}