@extends('pages.pdfs.layout')

@section('title', 'Certificado de Confirma')

@section('style-pie')
	.pie{
		width: 100%;
		padding-top: 4cm;
	}
@endsection

@section('fecha')
	{{ $hoy['mday'] }} de {{ $arrayHoy['mes'] }} del {{ $hoy['year'] }}
@endsection

@section('titulo', 'CERTIFICADO DE COMUNIÓN')

@section('contenido')
	<p class="texto-general">
		Hacemos constar que después de haber sido @if($sexo) catequizado @else catequizada @endif en la doctrina de Iniciación cristiana <b>{{ $nombre }} {{ $apellido }}</b> recibió de manos del Padre. {{ $padre->nombre }} {{ $padre->apellido }}, el sacramento de la Sagrada Comunión en esta parroquia La Transfiguración, @if($arrayFecha['dia'] != 'uno') a los {{ $arrayFecha['dia'] }} días @else el primer día @endif de {{ $arrayFecha['mes'] }} del año {{ $arrayFecha['anio'] }}.
	</p>

	<p class="texto-general">
		Se extiende la presente en San Salvador, @if($arrayHoy['dia'] != 'uno') a los {{ $arrayHoy['dia'] }} días @else el primer día @endif de {{ $arrayHoy['mes'] }} del año {{ $arrayHoy['anio'] }}.
	</p>

@endsection

@section('nombre-padre')
{{ $padreActual->nombre }} {{ $padreActual->apellido }}
@endsection

