@extends('web.plantilla')
@section('contenido')
        
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Contacto</h3>
        			<ul>
        				<li><a href="/index">Home</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Contact Form Area =================-->
        <section class="contact_form_area p_100">
        	<div class="container">
        		<div class="main_title">
					<h2>Contactame!</h2>
					<h5> ¿Tienes algo en mente para informarnos? Por favor, no se demore en conectarse con nosotros a través de nuestro formulario de contacto.</h5>
				</div>
       			<div class="row">
				   		<?php if (isset($msg)):?>
                        	<div class="alert alert-success" role="alert">
                            	<?php echo $msg; ?>
                        	</div>
                        <?php endif; ?> 
       				<div class="col-lg-7">
       					<form id="form1" class="row contact_us_form" method="POST">
            				<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
           					<div class="form-group col-md-6">
								<input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
							</div>
							<div class="form-group col-md-6">
								<input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email">
							</div>
							<div class="form-group col-md-6">
								<input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Teléfono">
							</div>
				
							<div class="form-group col-md-12">
								<textarea class="form-control" name="txtConsulta" id="txtConsulta" rows="1" placeholder="Mensaje"></textarea>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" value="submit" class="btn order_s_btn form-control">enviar</button>
							</div>
						</form>
       				</div>
       				<div class="col-lg-4 offset-md-1">
       					<div class="contact_details">
       						<div class="contact_d_item">
       							<h3>Dirección :</h3>
       							<p>Moreno, Buenos Aires/Argentina <br /> Ecuador 8052</p>
       						</div>
       						<div class="contact_d_item">
       							<h5>Teléfono : <a href="tel:+5491124869407">+54 9 11 24869407</a></h5>
       							<h5>Email : <a href="mailto:pedidos@jennifersalazar.com.ar">pedidos@jennifersalazar.com.ar</a></h5>
       						</div>
       						<div class="contact_d_item">
       							<h3>Horario :</h3>
       							<p>9:00 – 21:00</p>
       							<p>Lunes – Sabado</p>
       						</div>
       					</div>
       				</div>
       			</div>
        	</div>
        </section>
        <!--================End Contact Form Area =================-->
        
        <!--================End Banner Area =================-->
        <section class="map_area">
            <div id="mapBox" class="mapBox row m0" 
                data-lat="40.701083" 
                data-lon="-74.1522848" 
                data-zoom="13" 
                data-marker="img/map-marker.png" 
                data-info="54B, Tailstoi Town 5238 La city, IA 522364"
                data-mlat="40.701083"
                data-mlon="-74.1522848">
            </div>
        </section>
        <!--================End Banner Area =================-->
 @endsection       