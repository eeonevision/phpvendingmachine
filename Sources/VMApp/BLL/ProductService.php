<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 6/7/2017
 * Time: 10:29 PM
 */

namespace VMApp\BLL;


class ProductService
{
    private $products;

    public function __construct($productsPath)
    {
        $this->products = (new JsonLoader($productsPath))->load();
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getProductKey($name)
    {
        $key = array_search($name, $this->products, true);
        return $key;
    }

    public function buyProduct($key)
    {
        if ($this->products[$key]['amount'] > 0) {
            $this->products[$key]['amount']--;
            return true;
        }
        return false;
    }
}