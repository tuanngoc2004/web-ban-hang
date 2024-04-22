@extends('admin.main')

@section('content')
    <!-- Existing content... -->

    <div class="row">
        <!-- Card Số lượng sản phẩm -->
        <div class="col-md-4 mb-4">
            <div class="info-box h-100">
                <span class="info-box-icon bg-info"><i class="fas fa-cube"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Số lượng sản phẩm</span>
                    <span class="info-box-number">{{ $productCount }}</span>
                </div>
            </div>
        </div>

        <!-- Card Danh Mục -->
        <div class="col-md-4 mb-4">
            <div class="info-box h-100">
                <span class="info-box-icon bg-success"><i class="fas fa-tags"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Danh Mục</span>
                    <span class="info-box-number">{{ $menuCount }}</span>
                </div>
            </div>
        </div>

        <!-- Card Cart -->
        <div class="col-md-4 mb-4">
            <div class="info-box h-100">
                <span class="info-box-icon bg-warning"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cart</span>
                    <span class="info-box-number">{{ $cartCount }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
