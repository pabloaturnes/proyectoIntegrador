@extends('web.plantilla')
@section('contenido')

        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Seminarios</h3>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Blog Main Area =================-->
        <section class="main_blog_area p_100">
        	<div class="container">
        		<div class="blog_area_inner">
					<div class="main_blog_column row">
					@foreach ($aSeminarios as $seminario)
						<div class="col-lg-6">
							<div class="blog_item">
								<div>
									<img src="/web/img/{{$seminario->imagen}}" style="height: 300px" alt="">
								</div>
								<div class="blog_text">
									<div class="blog_time">
										<div class="float-left">
											<a href="#">{{date_format(date_create($seminario->fecha_carga), 'd/m/Y')}}</a>
										</div>
										<div class="float-right">
											<ul class="list_style">
												<li><a href="#">Fecha del Curso :{{date_format(date_create($seminario->fecha_curso), 'd/m/Y')}}</a></li>
											</ul>
										</div>
									</div>
									<a href="#"><h4>{{ $seminario->nombre }}</h4></a>
									<h6>¿Que Realizaremos?</h6>
									<p>{{$seminario->contenido}}</p>
									<h6>¿Que Veremos?</h6>
									<p>{{$seminario->descripcion}}</p>
									<h6>Tener en cuenta:</h6>
									<p>{{$seminario->observacion}}</p>
									<h6>Horario y Dirección</h6>
									<p>Comianza:{{$seminario->horario}} en {{$seminario->direccion}}</p>
									<a class="pink_more" href="/contacto">Inscribirme Ahora</a>
								</div>
							</div>
						</div>
					@endforeach
					</div>
					<nav aria-label="Page navigation example" class="blog_pagination">
						<ul class="pagination">
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
						</ul>
					</nav>
        		</div>
        	</div>
        </section>
        <!--================End Blog Main Area =================-->
        
@endsection