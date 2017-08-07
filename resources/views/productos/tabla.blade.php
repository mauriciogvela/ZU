<table class="table table-striped table-hover" id="tablaProductos">
	<thead class="thead-inverse">
		<tr>
			<!--th>&nbsp;</th-->
			<th>&nbsp;</th>
			<th>C&oacute;digo</th>
			<th>Producto</th>
			<th>Categoria</th>
			<th>Inventario</th>
			<th class="text-md-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@if(count($productos)>0)
			@foreach ($productos as $key => $producto)
			    <tr idp="{{ $producto->id }}">
			    	<!--td>{{ $key+1 }}</td-->
			    	<td>
			    		<i class="fa fa-eye {{ ($producto->visibleWeb==1)?'green':'grey'}}-text-icon"" title="{{ ($producto->visibleWeb==1)?'No visible':'Producto visible'}}"></i>
			    	</td>
			    	<td class="jqCodigo">{{ $producto->codigo }}</td>
			    	<td>{{ $producto->nombre }}</td>
			    	<td>{{ $producto->categoria }}</td>
			    	<td>{{ $producto->stock }}</td>
			    	<td class="text-md-center">
						<a class="amber-text" title="Editar producto" href="{{url('productos/editar/'.$producto->id)}}"><i class="fa fa-pencil"></i></a>
						<a class="blue-text" title="Ver uso de stock"><i class="fa fa-calendar"></i></a>
						<a class="red-text jqEliminarProducto" title="Borrar producto"><i class="fa fa-times"></i></a>
						<!--a class="{{ ($producto->visibleWeb==1)?'green':'grey'}}-text-icon jqVisibleProducto" title="{{ ($producto->visibleWeb==1)?'Hacer invisible':'Hacer visible'}}"><i class="fa fa-eye"></i></a-->
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
				{{-- $productos->links() --}}
			</td>
		</tr>
	</tfoot>
</table>
