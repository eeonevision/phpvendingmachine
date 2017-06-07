<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/8/2017
 * Time: 12:32 AM
 */

use VMApp\BLL\VendingMachine;
use PHPUnit\Framework\TestCase;

class VendingMachineTest extends TestCase
{
    public function getVM()
    {
        return $this->vm = new VendingMachine(
            '../../../Content/userwallet.json',
            '../../../Content/vmwallet.json',
            '../../../Content/products.json'
        );
    }

    public function testGetUserBalance()
    {
        $vm = $this->getVM();
        $this->assertArrayHasKey("5", $vm->getUserBalance());
    }

    public function testGetProducts()
    {
        $vm = $this->getVM();
        $this->assertArrayHasKey("name", $vm->getProductList()[2]);
    }


    public function testGetVMBalance()
    {
        $vm = $this->getVM();
        $this->assertArrayHasKey("2", $vm->getVMBalance());
    }

    public function testInsertCoin(){
        $vm = $this->getVM();
        print_r("Balance before inserting coins:\n");
        $initBalance = $vm->getUserBalance();
        $this->assertTrue($vm->insertCoins(2,10));
        print_r("Balance after inserting coins:\n");
        $endBalance = $vm->getUserBalance();
        $this->assertNotSame($initBalance, $endBalance);
    }

    public function testGetChange(){
        $vm = $this->getVM();
        print_r("Balance before inserting coins:\n");
        $initBalance = $vm->getUserBalance();
        $vm->insertCoins(5,10);
        $vm->getChange();
        print_r("Balance after returned coins:\n");
        $endBalance = $vm->getUserBalance();
        $this->assertNotSame($initBalance,$endBalance);
    }

    public function testBuyProduct(){
        $vm = $this->getVM();
        print_r("The product list before Coffee bought: \n");
        $beforeBuy = $vm->getProductList();
        $vm->insertCoins(5,10);
        $vm->buyProduct("Кофе");
        print_r("The product list after bought: \n");
        $afterBuy = $vm->getProductList();
        $this->assertNotSame($beforeBuy,$afterBuy);
    }

    public function testExceptionWhenBuyProduct(){
        $vm = $this->getVM();
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Sorry, but you have no enough balance for buy this product!");
        $vm->buyProduct("Кофе");
    }
}
