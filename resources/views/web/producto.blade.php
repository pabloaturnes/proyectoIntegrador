@extends('web.plantilla')
@section('contenido')
    <body>

    <!--================End Main Header Area =================-->
    <section class="banner_area">
        <div class="container">
            <div class="banner_text">
                <h3>Nuestros Productos</h3>
                <ul>
                    <li><a href="#">Categorías</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!--================End Main Header Area =================-->

    <!--================Product Details Area =================-->
    <section class="product_details_area p_100">
        <div class="container">
            <div class="row product_d_price">
                <div class="col-lg-6">
                    <div class="product_img"><img class="img-fluid" src="img/product/product-details-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product_details_text">
                        <h4>{{ $producto->nombre }}</h4>
                        <p>{{ $producto->descripcion }}</p>
                        <h5>Precio :<span>{{$producto->precio}}</span></h5>
                        <div class="quantity_box">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" placeholder="1" id="cantidad" name="cantidad" required>
                        </div>
                        <a class="pink_more"
                           href="#">@if($producto->precio > 0){{'Comprar'}}@elseif($producto->precio == 0){{'Pedir presupuesto'}}@endif</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Details Area =================-->

    <!--================Similar Product Area =================-->
    <section class="similar_product_area p_100">
        <div class="container">
            <div class="main_title">
                <h2>Más de nuestros productos</h2>
            </div>
            <div class="row similar_product_inner">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="cake_feature_item">
                        <div class="cake_img">

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="cake_feature_item">
                        <div class="cake_img">
                            <img src="img/cake-feature/c-feature-2.jpg" alt="">
                        </div>
                        <div class="cake_text">
                            <h4>$29</h4>
                            <h3>Strawberry Cupcakes</h3>
                            <a class="pest_btn" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="cake_feature_item">
                        <div class="cake_img">
                            <img src="img/cake-feature/c-feature-3.jpg" alt="">
                        </div>
                        <div class="cake_text">
                            <h4>$29</h4>
                            <h3>Strawberry Cupcakes</h3>
                            <a class="pest_btn" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="cake_feature_item">
                        <div class="cake_img">
                            <img src="img/cake-feature/c-feature-4.jpg" alt="">
                        </div>
                        <div class="cake_text">
                            <h4>$29</h4>
                            <h3>Strawberry Cupcakes</h3>
                            <a class="pest_btn" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Similar Product Area =================-->

    </body>
    @endsection
    </html>