<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 9:01 PM
 */

namespace VMApp\BLL;


class VMWallet implements WalletInterface
{
    private $wallet;

    public function __construct($walletPath)
    {
        $this->wallet = (new JsonLoader($walletPath))->load();
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->wallet;
    }

    /**
     * @param $nominal
     * @param $amount
     * @internal param $money
     */
    public function addFunds($nominal, $amount)
    {
        return $this->wallet[$nominal]+=$amount;
    }

    /**
     * @param $nominal
     * @param $amount
     */
    public function withDraw($nominal, $amount)
    {
        return $this->wallet[$nominal]-=$amount;
    }
}