@extends('web.plantilla')
@section('contenido')

        <!--================Product Area =================-->
        <section class="product_area p_100">
        	<div class="container">
        		<div class="row product_inner_row">
        			<div class="col-lg-9">
        				<div class="row product_item_inner">
							@foreach ($aProductos as $producto)								
								<div class="col-lg-4 col-md-4 col-6">
									<div class="cake_feature_item">
										<div class="cake_img pt-4 " >
											<img src="/web/img/{{ $producto->imagen }}" alt="" height="300" width="230">
										</div>
										<div class="cake_text">
											<h4>{{ $producto->precio }}</h4>
											<h3>{{ $producto->nombre }}</h3>
											@if ($producto->precio == 0)
												<a class="pest_btn" href="/consulta?producto={{$producto->idproducto}}">Consultar</a>
											@else
												<a class="pest_btn" href="/agregar-carrito?idproducto={{$producto->idproducto}}" onclick="fAgregarAlCarrito($request)">
												Añadir al carrito
												</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
        				</div>
						<form method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
							<div class="product_pagination">
								<div class="left_btn">
									<a href="#"><i class="lnr lnr-arrow-left"></i> Productos anteriores</a>
								</div>
								<div class="middle_list">
									<nav aria-label="Page navigation example">
										<ul class="pagination">								
										<li class="page-item active"><a class="page-link" href="#">1</a></li> 
										</ul>
									</nav>
								</div>
								<div class="right_btn"><a href="#">Productos siguientes <i class="lnr lnr-arrow-right"></i></a></div> 
	
							</div>
						</form> 
        			</div>
        			<div class="col-lg-3">
        				<div class="product_left_sidebar">
        					<aside class="left_sidebar search_widget">
								<form method="POST">
										<input type="hidden" name="_token" value="{{ csrf_token() }}"></input> 				
										<input type="text" class="form-control" name="txtBusqueda" placeholder="Ingresa una busqueda">			
										<button class="pest_btn" type="submit" name="busquedaTienda">Buscar</button>
								</form>
        					</aside> 
        					<aside class="left_sidebar p_catgories_widget">
        						<div class="p_w_title">
        							<h3>Categorias de productos</h3>
        						</div>
        						<ul class="list_style">
								<li><a href="/tienda">Todas las Categorias</a></li>
								@foreach ($aCategorias as $categoria)
        							<li><a href="/tienda/?cat={{$categoria->idcategoria}}">{{ $categoria->nombre }}</a></li>
								@endforeach
        						</ul>
        					</aside>
        					<aside class="left_sidebar p_price_widget">
        						<div class="p_w_title">
        							<h3>Filtrar por precio</h3>
        						</div>
        						<div class="filter_price">
									<div id="slider-range"></div>
       								<label for="amount">Rango de precios:</label>
									<input type="text" id="amount" readonly />
       								<a href="#">Filtro</a>
        						</div>
        					</aside>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Product Area =================-->

<script>
	function fAgregarAlCarrito(request){
		$.ajax({
			type: "GET",
			url: "{{asset('producto/agregarAlCarrito') }}",
			data: {id:idProducto},
			async: true,
			dataType: "json",
			success: function (respuesta){
				if(respuesta.err = "0"){
					$("#cantidadDeProductos").html(respuesta.cantidad);
				}else{
					alert("Error al agregar al carrito");
				}
			}
		});
	}


</script>

@endsection