<?php

/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 8:51 PM
 */
namespace VMApp\BLL;
interface WalletInterface
{
    public function getBalance();
    public function getFunds($money);
}