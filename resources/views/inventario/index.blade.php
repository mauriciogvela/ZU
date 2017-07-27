@extends('layout.master')

@include('layout.menu')


@section('css')
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet" />
    <style type="text/css">
    	.grey-text-icon {
		    color: #b7b7b7!important;
		}
		.green-text-icon {
		    color: #21e029!important;
		}
		.dataTables_length select{
			display: inline-block;
		}
    </style>
@endsection

@section('content')
	{{-- Botonera inicio --}}
    <div class="row">
	    <div class="col-md-12 center-on-small-only text-md-right">
			<a class="btn btn-right btn-primary" href="{{url('inventario/agregar')}}"><i class="fa fa-tag left"></i> Nuevo Producto</a>
			<a class="btn btn-secondary"><i class="fa fa-chevron-circle-up left"></i> Importar stock</a>	
			<a class="btn btn-default"><i class="fa fa-chevron-circle-down left"></i> Exportar stock</a>
	    </div>
	</div>
	{{-- Botonera fin --}}
	{{-- Busqueda inicio --}}
	<div class="row">
		<div class="col-md-12 center-on-small-only text-md-left">
			<div class="card">
				<div class="card-header blue-color-dark white-text">
					Busqueda de mis productos
				</div>
				<div class="card-block">
					<form action='#'>
						<div class="md-form">
							<div class="row">            
								<div class="col-6">
									<input placeholder="Nombre de producto" type="text" id="nombre" class="form-control"> 
								</div>
								<div class="col-4">
									<select class="mdb-select" id="categoria">
										<option value="" selected>Todas las categorias</option>
										@foreach ($categorias as $key => $categoria)
											<option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-2 text-right">
									<a class="btn btn-sm btn-primary jqBuscarProducto"><i class="fa fa-search left"></i> buscar</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{{-- Busqueda fin --}}
	<br>
	{{-- Litado inicio --}}
	<div class="row">
		<div class="col-md-12 center-on-small-only text-md-center jqTablaProductos">
			Cargando productos...
		</div>
	</div>
	{{-- Litado fin --}}
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/app/inventario/inventario.js') }}"></script>
@endsection
{{-- Modal borrado inicio --}}
<div class="modal fade" id="modalBorrado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-warning" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead">Confirmación de borrado de producto</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-check fa-4x mb-1 animated rotateIn"></i>
                    <p>¿Está usted seguro que desa eliminar el producto <code id="codigoProducto"></code> del stock?</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary-modal" id="confirmarBorrado" data-dismiss="modal">Aceptar</i></a>
                <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>
{{-- Modal borrado fin --}}