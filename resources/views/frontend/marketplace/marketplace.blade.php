@extends('frontend.marketplace.layout.app')
@section('content')
<section class="barter-1">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="#" class="market-c">Marketplace</a>
                <div class="market-div">
                    <a href="#" class="market-a">New Arrivals</a>
                    <a href="#" class="market-a">Top 100 Best Seller </a>
                    <a href="#">Led</a>
                    <a href="#">Electronic</a>
                    <a href="#">vehicle</a>
                    <a href="#">E Bike</a>
                    <a href="#">Sport</a>
                    <a href="#">Bed</a>
                    <a href="#">E Car</a>
                    <a href="#" class="market-a">All categlories</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="owl-carousel barter-bg1 owl-theme">
                    <div class="item">
                        <h4 class="barter1-a">Power to the pro</h4>
                        <h4 class="barter1-b">Feel special this summer with 15% off*</h4>
                        <a href="#" class="barter1-btn">Shop now</a>
                    </div>
                    <div class="item">
                        <h4 class="barter1-a">Power to the pro</h4>
                        <h4 class="barter1-b">Feel special this summer with 15% off*</h4>
                        <a href="#" class="barter1-btn">Shop now</a>
                    </div>
                    <div class="item">
                        <h4 class="barter1-a">Power to the pro</h4>
                        <h4 class="barter1-b">Feel special this summer with 15% off*</h4>
                        <a href="#" class="barter1-btn">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{ asset('assets/images/market/main-2.png') }}" class="main2-img" />
            </div>
        </div>
    </div>
</section>

<section class="barter-2">
    <div class="container">
        <h3 class="barter2-a">All Products</h3>
        <div class="owl-carousel product-carousel owl-theme">
            <div class="item">
                <a href="#">
                    <img src="{{ asset('assets/images/market/p1.png') }}" class="p1-img" />
                    <div class="price-div">
                        <p class="price-p">$79.00</p>
                        <p class="price-c">$99.00</p>
                    </div>
                    <h3 class="product-h3">Product 1</h3>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('assets/images/market/p2.png') }}" class="p1-img" />
                    <div class="price-div">
                        <p class="price-p">$79.00</p>
                        <p class="price-c">$99.00</p>
                    </div>
                    <h3 class="product-h3">Product 1</h3>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('assets/images/market/p3.png') }}" class="p1-img" />
                    <div class="price-div">
                        <p class="price-p">$79.00</p>
                        <p class="price-c">$99.00</p>
                    </div>
                    <h3 class="product-h3">Product 1</h3>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('assets/images/market/p1.png') }}" class="p1-img" />
                    <div class="price-div">
                        <p class="price-p">$79.00</p>
                        <p class="price-c">$99.00</p>
                    </div>
                    <h3 class="product-h3">Product 1</h3>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('assets/images/market/p2.png') }}" class="p1-img" />
                    <div class="price-div">
                        <p class="price-p">$79.00</p>
                        <p class="price-c">$99.00</p>
                    </div>
                    <h3 class="product-h3">Product 1</h3>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('assets/images/market/p3.png') }}" class="p1-img" />
                    <div class="price-div">
                        <p class="price-p">$79.00</p>
                        <p class="price-c">$99.00</p>
                    </div>
                    <h3 class="product-h3">Product 1</h3>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="barter-3">
    <div class="container">
        <h3 class="barter3-a">Our Feature Products</h3>
        <div class="container mt-3">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">Featured</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Top rated</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">Most Sale</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>

                    {{-- @forelse ($products as $product)
                    <div class="main-imgbox">
                        <div class="imgbox">
                            @if (isset($product->images()->first()->path))
                            <img src="{{ asset('storage/' . $product->images()->first()->path) }}" class="imbox-img" />
                            @endif
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="{{ route('marketplace.details', $product->id) }}" class="imgbox-b">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <p class="imgbox-c">${{ $product->price }}</p>
                            <a href="{{ route('marketplace.details', $product->id) }}" class="eye-icon"><i
                                    class="fa-regular fa-eye"></i></a>
                        </div>
                        @empty
                        <div class="alert alert-info text-center">
                            <h5>No products found.</h5>
                            <p>It looks like we don't have any products to show you right now. Try searching for
                                something else or check back later!</p>
                        </div>
                        @endforelse --}}

                        <div class="main-imgbox">
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f1.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f2.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f3.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f4.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f5.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f6.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f7.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                            <div class="imgbox">
                                <img src="{{ asset('assets/images/market/f8.png') }}" class="imbox-img" />
                                <h4 class="imgbox-a">Vivid FHD LED</h4>
                                <a href="#" class="imgbox-b">
                                    <h4>Model J11</h4>
                                </a>
                                <p class="imgbox-c">$1,215.00</p>
                                <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <div class="main-imgbox">
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f1.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f2.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f3.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f4.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f5.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f6.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f7.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f8.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                    <div class="main-imgbox">
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f1.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f2.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f3.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f4.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f5.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f6.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f7.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                        <div class="imgbox">
                            <img src="{{ asset('assets/images/market/f8.png') }}" class="imbox-img" />
                            <h4 class="imgbox-a">Vivid FHD LED</h4>
                            <a href="#" class="imgbox-b">
                                <h4>Model J11</h4>
                            </a>
                            <p class="imgbox-c">$1,215.00</p>
                            <a href="#" class="eye-icon"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
