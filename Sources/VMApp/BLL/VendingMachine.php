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
            print_r("The current balance is increased to:" . $this->currentBalance += ($nominal * $amount));
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

            print_r("The change was gave to you...");
            return true;
        } else {
            print_r("You have not insert any coins in the machine!");
            return false;
        }
    }

    public function getProductList()
    {
        $products = $this->products->getProducts();
        print_r("The list of products:\n $products");
        return $products;
    }

    public function getVMBalance()
    {
        $balance = $this->vmWallet->getBalance();
        print_r("The Vending machine balance is: $balance");

        return $balance;
    }

    public function getCurrentBalance()
    {
        print_r("The current balance is: $this->currentBalance");
        return $this->currentBalance;
    }

    public function buyProduct($name)
    {
        $key = $this->products->getProductKey($name);
        if ($key != null || $key != false) {
            $product = $this->products->getProducts()[$key];
            if ($this->currentBalance >= $product['price']) {
                if ($this->products->buyProduct($key)) {
                    $this->currentBalance -= $product['price'];
                    print_r("The product was bought successfully!");
                    return true;
                }
                print_r("Sorry, but you have no enough balance for buy this product!");
            }
            print_r("Sorry, this product was not found.");
        }
        return false;
    }
}