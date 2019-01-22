@extends('pages.pdfs.layout')

@section('title', 'Constancia de Matrimonio')

@section('style-pie')
	.pie{
		width: 100%;
		padding-top: 2cm;
	}
@endsection

@section('fecha')
	{{ $hoy['mday'] }} de {{ $arrayHoy['mes'] }} del {{ $hoy['year'] }}
@endsection

@section('titulo', 'ACTA DE MATRIMONIO ECLESIAL')

@section('contenido')
	<p class="texto-general">
		En parroquia La Transfiguración se encuentra la partida que literalmente dice:
	</p>
	<p class="texto-general">
		En la parroquia La Transfiguración, San Salvador @if($arrayFecha['dia'] != 'uno') a los {{ $arrayFecha['dia'] }} días @else el primer día @endif de {{ $arrayFecha['mes'] }} del año {{ $arrayFecha['anio'] }}. Previos los tramites de Derecho Civil y canónico, el señor {{ $esposo->nombre }} {{ $esposo->apellido }}, de {{ $edadEsposo }} años de edad, hijo de {{ $esposo->papa }} y {{ $esposo->mama }}, originario de @if($esposoSalv) {{ $esposo->municipio->nombre }}, {{ $esposo->municipio->departamento->nombre }}. @else {{ $esposo->nacionalidad->pais }}. @endif
	</p>

	<p class="texto-general">
		Contrajo Matrimonio Con: {{ $esposa->nombre }} {{ $esposa->apellido }}, de {{ $edadEsposa }} años de edad, hija de {{ $esposa->papa }} y {{ $esposa->mama }}, originaria de @if($esposaSalv) {{ $esposa->municipio->nombre }}, {{ $esposa->municipio->departamento->nombre }}. @else {{ $esposa->nacionalidad->pais }}. @endif
	</p>

	<p class="texto-general">Fueron padrinos: 
		@foreach($matrimonio->padrinos()->get() as $padrino)
			@if($loop->first)
				{{$padrino->nombre}} {{ $padrino->apellido}}
			@else
				@if($loop->last)
					{{' y ' . $padrino->nombre }} {{ $padrino->apellido }}
				@else
					{{', ' . $padrino->nombre }} {{ $padrino->apellido }}
				@endif
			@endif
		@endforeach
	</p>

	<p class="texto-general">Por este medio  hago constar que esta acta corresponde al Libro N° {{ $matrimonio->libro }} y folio {{ $matrimonio->folio }}.</p>

	<p class="texto-general">Atentamente,</p>
@endsection

@section('nombre-padre')
{{ $padreActual->nombre }} {{ $padreActual->apellido }}
@endsection

