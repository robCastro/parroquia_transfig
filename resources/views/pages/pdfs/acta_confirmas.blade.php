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

@section('titulo', 'CERTIFICADO DE CONFIRMA')

@section('contenido')
	<p class="texto-general">
		CERTIFICO QUE
	</p>
	<p class="texto-general">
		En la parroquia La Transfiguración, @if($arrayFecha['dia'] != 'uno') a los {{ $arrayFecha['dia'] }} días @else el primer día @endif de {{ $arrayFecha['mes'] }} del año {{ $arrayFecha['anio'] }}, Monseñor {{ $confirma->padre->nombre }} {{ $confirma->padre->apellido }} administró solemnemente el SACRAMENTO DE LA CONFIRMACIÓN a: <b>{{ $confirma->persona->nombre }} {{ $confirma->persona->apellido }}</b>.
	</p>

	<p class="texto-general">
		@if($confirma->persona->sexo) Hijo @else Hija @endif de: {{ $confirma->persona->papa }} y {{ $confirma->persona->mama }}.
	</p>

	<p class="texto-general">Fueron padrinos: 
		@foreach($confirma->padrinos()->get() as $padrino)
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
		Como consta en el libro de Confirmaciones Libro Nº {{ $confirma->libro }} Acta {{ $confirma->acta }}, Pág {{ $confirma->pagina }} de esta parroquia.
	</p>

@endsection

@section('nombre-padre')
{{ $padreActual->nombre }} {{ $padreActual->apellido }}
@endsection

