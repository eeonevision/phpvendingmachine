<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 9:43 PM
 */

namespace VMApp\BLL;


class VendingMachine
{
    private $userWallet;
    private $vmWallet;
    private $products;
    private $currentBalance;

    /**
     * VendingMachine constructor.
     * @param $userWalletPath
     * @param $vmWalletPath
     * @param $productsPath
     */
    public function __construct($userWalletPath, $vmWalletPath, $productsPath)
    {
        $this->userWallet = new UserWallet($userWalletPath);
        $this->vmWallet = new VMWallet($vmWalletPath);
        $this->products = new ProductService($productsPath);
        $this->currentBalance = 0;
    }

    public function insertCoins($nominal, $amount)
    {
        if ($this->userWallet->withDraw($nominal, $amount)) {
            $this->vmWallet->addFunds($nominal, $amount);
            print_r("The current balance is:" . $this->currentBalance += ($nominal * $amount));
            return true;
        } else {
            print_r("You want to insert not existed nominal in your wallet...");
            return false;
        }
    }

    public function getChange()
    {
        if ($this->currentBalance != 0) {
            $sortedArray = krsort($this->getVMBalance());

            foreach ($sortedArray as $key => $value) {
                $parts = $this->currentBalance % $key;
                $this->vmWallet->withDraw($key, $parts);
                $this->userWallet->addFunds($key, $parts);
                $this->currentBalance -= ($key * $parts);
            }

            $this->currentBalance = 0;

            print_r("The change was funded...");
            return true;
        } else {
            print_r("You have not insert any coins in the machine!");
            return false;
        }
    }

    public function getProductList()
    {

    }

    public function getVMBalance()
    {
        $balance = $this->vmWallet->getBalance();
        print_r($balance);

        return $balance;
    }

    public function getCurrentBalance()
    {
        return $this->currentBalance;
    }

    public function buyProduct($productID)
    {

    }
}