@extends('web.plantilla')
@section('contenido')


        <!--================Faq Area =================-->
        <section class="faq_area p_100">
        	<div class="container">
        		<div class="main_title">
					<h2>Preguntas frecuentes</h2>
					<p>Contestamos todas tus dudas.</p>
				</div>
       			<div class="input-group search_form">
				  <input type="text" class="form-control" placeholder="Busca tu pregunta" aria-label="Recipient's username">
				  <div class="input-group-append">
					<button class="btn btn-outline-secondary" type="button"><i class="lnr lnr-magnifier"></i></button>
				  </div>
				</div>
       			<div class="row faq_collaps">
       				<div class="col-lg-6">
       					<div class="left_side_collaps">
							<div id="accordion">
								<div class="card">
									<div class="card-header" id="headingOne">
										<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<i>+</i>
										<i>-</i>
										Ofrecen decoraciones personalizadas?
										</button>
									</div>
									<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
										Si!!!  Consultanos por nuestra Pastelería decorada. Acompañamos festejos de la manera mas creativa y original!
                                        Qué hacemos?<br></br>

                                        Cupcakes<br></br>
										Cookies<br></br>
										Cake pop<br></br>
										Ice popen<br></br>
										Oreos bañadas<br></br>
										Shots dulces<br></br>
										Tartas dulces<br></br>
                                        Tortas de cumple<br></br>
                                        Tortas de bodas<br></br>
										Lounch salado<br></br>
										Desayunos y meriendas<br></br>
                                        Y mucho más!<br></br>
                                        Tenemos distintas opciones de mesas dulces para hacer de tu evento un momento único!.<br></br>

                                        El presupuesto de un evento o mesa dulce incluye el armado y ambientación?
                                        No.  El armado y la ambientación se cotizan de acuerdo al evento, alquiler de vajilla, etc.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingTwo">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										<i>+</i>
										<i>-</i>
										Costo del Delivery?
										</button>
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
										<div class="card-body">
										La entrega se realiza unicamente en el local.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingThree">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										<i>+</i>
										<i>-</i>
										Medios de Pago
										</button>
									</div>
									<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="card-body">
										Transferencia bancaria, tarjeta de debito, Mercado Pago y efectivo.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingfour">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
										<i>+</i>
										<i>-</i>
										Tienen local? Dónde puedo ver las tortas?
										</button>
									</div>
									<div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
										<div class="card-body">
										No tenemos local a la calle. Nuestra fábrica se encuentra en Moreno. Si necesita hacer alguna degustación, debe solicitarla +54 9 11 2486 9407.
										</div>
									</div>
								</div>
							</div>
       					</div>
       				</div>
       				<div class="col-lg-6">
       					<div class="left_side_collaps">
							<div id="accordion2">
								<div class="card">
									<div class="card-header" id="headingfive">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
										<i>+</i>
										<i>-</i>
										Por donde puedo retirar los pedidos?
										</button>
									</div>
									<div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion2">
										<div class="card-body">
										Los pedidos se podrán retirar por Ecuador 8052, Moreno, con cita previa.<br></br>
                                        Ya que todas nuestras tortas se realizan por pedido no contamos con stock ni muestras.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingsix">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
										<i>+</i>
										<i>-</i>
										Cuanto tiempo antes tengo que hacer el pedido?
										</button>
									</div>
									<div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion2">
										<div class="card-body">
										Elaboramos por pedido, no tenemos stock.
                                        Si estás organizando un evento, lo recomendable es la mayor anticipación posible, para reservar la fecha, 2 semanas a un mes antes es lo ideal.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingseven">
										<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
										<i>+</i>
										<i>-</i>
										Toman ordenes en el día?
										</button>
									</div>
									<div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordion2">
										<div class="card-body">
										No contamos con stock ya que nuestros productos son frescos y se realizan por pedido.
										</div>
									</div>
								</div>
       					</div>
       				</div>
       			</div>
        	</div>
        </section>
        <!--================End Faq Area =================-->
        
        <!--================Faq Form Area =================-->
        <section class="faq_form_area">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-9">
        				<div class="faq_left_form">
        					<div class="faq_title">
        						<h3>No encontraste la respuesta que buscabas? Hacenos una pregunta</h3>
        					</div>
        					<form class="row contact_us_form" action="http://galaxyanalytics.net/demos/cake/theme/cake-html/contact_process.php" method="post" id="contactForm" novalidate="novalidate">
								<div class="form-group col-md-12">
									<input type="text" class="form-control" id="name" name="name" placeholder="Nombre*">
								</div>
								<div class="form-group col-md-12">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email*">
								</div>
								<div class="form-group col-md-12">
									<textarea class="form-control" name="message" id="message" rows="1" placeholder="Pregunta*"></textarea>
								</div>
								<div class="form-group col-md-12">
									<button type="submit" value="submit" class="btn pest_btn form-control">Enviar</button>
								</div>
							</form>
        				</div>
        			</div>
        			<div class="col-md-3"></div>
        		</div>
        	</div>
        </section>
        <!--================End Faq Form Area =================-->
        

@endsection