<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\MainService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $mainService;

    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }
    public function index(){
        // return view('admin.home', [
        //     'title' => 'Trang quản trị Admin'
        // ]);

        $productCount = $this->mainService->ProductCount();
        $menuCount = $this->mainService->MenuCount();
        $cartCount = $this->mainService->CartCount();

        return view('admin.home', [
            'title' => 'Trang quản trị Admin',
            'productCount' => $productCount,
            'menuCount' => $menuCount,
            'cartCount' => $cartCount,
        ]);
    }
}
