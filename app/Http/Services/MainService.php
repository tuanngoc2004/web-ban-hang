<?php


namespace App\Http\Services;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Product;

class MainService
{
    public function ProductCount()
    {
        return Product::count();
    }

    public function MenuCount()
    {
        return Menu::count();
    }

    public function CartCount()
    {
        return Cart::count();
    }
}