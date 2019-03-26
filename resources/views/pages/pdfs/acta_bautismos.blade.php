@extends('pages.pdfs.layout')

@section('title', 'Certificado de Confirma')

@section('style-pie')
	.pie{
		width: 100%;
		padding-top: 3.5cm;
	}
@endsection

@section('fecha')
	{{ $hoy['mday'] }} de {{ $arrayHoy['mes'] }} del {{ $hoy['year'] }}
@endsection

@section('titulo', 'CERTIFICADO DE BAUTISMO')

@section('contenido')
	<p class="texto-general">
		CERTIFICA QUE
	</p>
	<p class="texto-general">
		En la parroquia La Transfiguración, @if($arrayFecha['dia'] != 'uno') a los {{ $arrayFecha['dia'] }} días @else el primer día @endif de {{ $arrayFecha['mes'] }} del año {{ $arrayFecha['anio'] }}, el padre {{ $bautismo->padre->nombre }} {{ $bautismo->padre->apellido }}, bautizó solemnemente a: <b>{{ $bautismo->persona->nombre }} {{ $bautismo->persona->apellido }}</b>, que nació @if($arrayFechaNac['dia'] != 'uno') a los {{ $arrayFechaNac['dia'] }} días @else el primer día @endif del mes de {{ $arrayFechaNac['mes'] }} del año {{ $arrayFechaNac['anio'] }}.
	</p>

	<p class="texto-general">
		Siendo @if($bautismo->persona->sexo) Hijo @else Hija @endif de: <b>{{ $bautismo->persona->papa }} y de {{ $bautismo->persona->mama }}.</b>
	</p>

	<p class="texto-general">Siendo padrinos: 
		@foreach($bautismo->padrinos()->get() as $padrino)
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

	<p class="texto-general">
		Libro Nº {{ $bautismo->libro }} Acta {{ $bautismo->acta }} de esta parroquia.
	</p>

@endsection

@section('nombre-padre')
{{ $padreActual->nombre }} {{ $padreActual->apellido }}
@endsection

