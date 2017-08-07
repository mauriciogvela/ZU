var controller = 'servicios';
$('.mdb-select').material_select();
var eliminarServicio = function(that){
	$('#codigoServicio').html($(that).parents('tr').find('td.jqCodigo').text());
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
	$('.jqEliminarServicio').off('click').on('click',function(){
		eliminarServicio(this);
	});
	$('.jqVisibleServicio').off('click').on('click',function(){
		//visibleServicio(this);
	});
}
var cargarServicios=function(){
	post({
		url: controller+'/listar',
		data: {
			idCategoria: $('select#categoria').val(),
			busqueda: $('input#nombre').val(),
		},
		dataType: 'html',
		fn: function(data){
			$('.jqTablaServicios').html(data);
			$('#tablaServicios').dataTable({
			    "info": false,
			    "searching": false,
			});
			eventosTabla();
		}
	});
}

$('.jqBuscarServicio').off('click').on('click',cargarServicios);
$('input#nombre').off('keypress').on('keypress',function(event){
	if ( event.which == 13 ) {
		event.preventDefault();
		cargarServicios();
	}
});
//inicializacion
cargarServicios();