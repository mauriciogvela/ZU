var controller = 'productos';
$('.mdb-select').material_select();
var eliminarProducto = function(that){
	$('#codigoProducto').html($(that).parents('tr').find('td.jqCodigo').text());
	$('#modalBorrado').modal({
		backdrop: true,
		keyboard: true,
		focus: true,
		show: true,
	});
	$('#confirmarBorrado').off('click').on('click',function(){
		post({
			type:'DELETE',
			url: controller+'/eliminar',
			data: {
				id: $(that).parents('tr').attr('idp')
			},
			fn: function(data){
				if(data.Exito){
					toastr.success(data.Msj, {positionClass: 'toast-bottom-right'});
					$(that).parents('tr').fadeOut('slow',function(){
						$(this).remove();
					});
				}else{
					toastr.warning(data.Error, {positionClass: 'toast-bottom-right'});
				}
			}
		});	
	});

}

var eventosTabla = function(){
	$('.jqEliminarProducto').off('click').on('click',function(){
		eliminarProducto(this);
	});
	$('.jqVisibleProducto').off('click').on('click',function(){
		//visibleProducto(this);
	});
}
var cargarProductos=function(){
	post({
		url: controller+'/listar',
		data: {
			idCategoria: $('select#categoria').val(),
			busqueda: $('input#nombre').val(),
		},
		dataType: 'html',
		fn: function(data){
			$('.jqTablaProductos').html(data);
			$('#tablaProductos').dataTable({
			    "info": false,
			    "searching": false,
			});
			eventosTabla();
		}
	});
}

$('.jqBuscarProducto').off('click').on('click',cargarProductos);
$('input#nombre').off('keypress').on('keypress',function(event){
	if ( event.which == 13 ) {
		event.preventDefault();
		cargarProductos();
	}
});
//inicializacion
cargarProductos();