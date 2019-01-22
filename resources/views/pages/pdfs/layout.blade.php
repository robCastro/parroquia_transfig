<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<title>Parroquia La Transfiguración - @yield('title')</title>

	<style type="text/css">

		@page{ 
			margin-top : 2.5cm;
			margin-right : 3cm;
			margin-bottom : 2.5cm;
			margin-left : 3cm;
		}

		.pagina{
			/**/
			width : 100%;
		}

		.membretado{
			width: 100%;
			vertical-align: top;
			margin: 0;
		}

		.texto-membrete { 
			/* https://www.cssfontstack.com/Tahoma */
			font-family: Tahoma; 
			font-size: 12px; 
			/*Tamaño 9 de word corresponde a 12px ( https://websemantics.uk/articles/font-size-conversion/ )*/
			font-style: normal; 
			font-variant: normal; 
			font-weight: 590; 
			line-height: 5.5px;
			text-align: right;
			vertical-align: top; 
			color: black;
		}

		.texto-general{ 
			font-family: TimesNewRoman; 
			font-size: 16px; 
			font-style: normal; 
			font-variant: normal; 
			font-weight: 400; 
			line-height: 20px;
			color: black;
			text-align: justify;
		}

		.fecha{
			width: 100%;
			padding-top: 1.5cm;
		}

		.titulo{
			width: 100%;
			padding-top: 2.5cm;
		}

		.contenido{
			width: 100%;
			padding-top: 1.5cm;
		}
		@yield('style-pie')
		/*.pie{
			width: 100%;
			padding-top: 2cm;
			padding-bottom: 3.5cm;
		}*/

		td{margin-left: 0;}

		

	</style>

</head>
<body>

				


	{{-- Inicio de Acta --}}
	<div class="pagina">

		<div class="membretado">
			<table style="width: 100%">
				<tr>
					<td>
						<img src="{{ asset('img/logo_membretado.png') }}">
					</td>
					<td>
						<p class="texto-membrete">Parroquia La Transfiguración, Reparto los Héroes,</p>
						<p class="texto-membrete">Pasaje Triunfal N°17. San Salvador, El Salvador. C.A.</p>
						<p class="texto-membrete">parroquialatransfiguracionss@gmail.com</p>
						<p class="texto-membrete">Tel (503) 2273-6069</p>
						<img style="width: 10.5cm; height: 2px;align-self: right;"  src="{{ asset('img/linea_membrete.png') }}">
					</td>
				</tr>
			</table>
		</div>

		<div class="fecha">
			<p class="texto-general" style="text-align: right;">San Salvador, @yield('fecha')</p>
		</div>


		<div class="titulo">
			<p class="texto-general" style="text-align: center;"><b>@yield('titulo')</b></p>
		</div>


		<div class="contenido">
			@yield('contenido')
			
		</div>

		<div class="pie">
			<p class="texto-general" style="text-align: right;">Pbro. @yield('nombre-padre')</p>
			<p class="texto-general" style="text-align: right;">Párroco</p>
		</div>

	</div>	
	{{-- Fin de Acta --}}



</body>
</html>