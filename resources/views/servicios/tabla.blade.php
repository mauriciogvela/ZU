<table class="table table-striped table-hover" id="tablaServicios">
	<thead class="thead-inverse">
		<tr>
			<!--th>&nbsp;</th-->
			<th>&nbsp;</th>
			<th>C&oacute;digo</th>
			<th>Servicio</th>
			<th>Categoria</th>
			<th>Inventario</th>
			<th class="text-md-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@if(count($servicios)>0)
			@foreach ($servicios as $key => $servicio)
			    <tr idp="{{ $servicio->id }}">
			    	<!--td>{{ $key+1 }}</td-->
			    	<td>
			    		<i class="fa fa-eye {{ ($servicio->visibleWeb==1)?'green':'grey'}}-text-icon"" title="{{ ($servicio->visibleWeb==1)?'No visible':'Servicio visible'}}"></i>
			    	</td>
			    	<td class="jqCodigo">{{ $servicio->codigo }}</td>
			    	<td>{{ $servicio->nombre }}</td>
			    	<td>{{ $servicio->categoria }}</td>
			    	<td>{{ $servicio->stock }}</td>
			    	<td class="text-md-center">
						<a class="amber-text" title="Editar servicio" href="{{url('servicios/editar/'.$servicio->id)}}"><i class="fa fa-pencil"></i></a>
						<a class="blue-text" title="Ver uso de stock"><i class="fa fa-calendar"></i></a>
						<a class="red-text jqEliminarservicio" title="Borrar servicio"><i class="fa fa-times"></i></a>
						<!--a class="{{ ($servicio->visibleWeb==1)?'green':'grey'}}-text-icon jqVisibleservicio" title="{{ ($servicio->visibleWeb==1)?'Hacer invisible':'Hacer visible'}}"><i class="fa fa-eye"></i></a-->
			    	</td>
			    </tr>
			@endforeach
		@else
				<tr>
			    	<td colspan="6" class="text-md-center">No se encontraron resultados</td>
			    </tr>
		@endif

	</tbody>
	<tfoot class="tfoot-inverse">
		<tr>
			<td colspan="6">
				{{-- $servicios->links() --}}
			</td>
		</tr>
	</tfoot>
</table>
