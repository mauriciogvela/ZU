$('.mdb-select').material_select();

var eliminarImagen = function(that){
	post({
		type:'DELETE',
		url: 'inventario/eliminarImagen',
		data: {
			imagen: $(that).parent().find('img').attr('nombre'),
			producto: $('.jqGuardarProducto').attr('id')
		},
		fn: function(data){
			if(data.Exito){
				toastr.success(data.Msj, {positionClass: 'toast-bottom-right'});
				$(that).parents('.img-producto').fadeOut('slow',function(){
					$(this).remove();
				});
			}else{
				toastr.warning(data.Erorr, {positionClass: 'toast-bottom-right'});
			}
		}
	});
}
var cargarArchivo = function(evt) {
      var files = evt.target.files; // FileList object
        //Obtenemos la imagen del campo "file". 
      for (var i = 0, f; f = files[i]; i++) {         
           //Solo admitimos imágenes.
           if (!f.type.match('image.*')) {
           		toastr.warning("["+files[i].name+"] Tipo de archivo no permitido.", {positionClass: 'toast-bottom-right'});
                continue;
           }
           	var dataImage = new FormData();
           	dataImage.append('image', files[i]);
           	post({
				type:'POST',
				url: 'inventario/subirImagen',
				data: dataImage,
				contentType: false,
				processData: false,
				fn: function(data){
					if(data.Exito){
						$('#listaImagenes').append(
	                    	'<div class="img-producto col-2 center-on-small-only text-md-left">'+
	                    		'<img class="img-thumbnail" src="'+data.Thumbnail+'" nombre="'+data.Nombre+'"/>'+
	                    		'<button type="button" class="close jqEliminarImagen" aria-label="Close">'+
                                    '<span aria-hidden="true">&times;</span>'+
                                '</button>'+
	                    	'</div>'
	                    );
	                    $('.jqEliminarImagen').off('click').on('click',function(){
							eliminarImagen(this);log(this);
						});
	                    toastr.success(data.Msj, {positionClass: 'toast-bottom-right'});
					}else{
						toastr.warning(data.Erorr, {positionClass: 'toast-bottom-right'});
					}
				}
			});
       }
}
var guardarProducto = function(that){
	var imagenes=[];
	$.each($('.img-producto img').not('[save=1]'),function(i,v){
		imagenes[imagenes.length]=$(this).attr('Nombre');
	});
	post({
		type:'POST',
		url: 'inventario/guardar',
		data: { //cambiar a serialize() para optimizar
			id: $(that).attr('id'),
			codigo: $('input#codigo').val(),
			nombre: $('input#nombre').val(),
			descripcion: $('textarea#descripcion').val(),
			idCategoria: $('select#idCategoria').val(),
			visibleWeb: $('input#visibleWeb').is(':checked')?1:0,
			precio: $('input#precio').val(),
			stock: $('input#stock').val(),
			detalles: $('textarea#detalles').val(),
			terminosCondiciones: $('textarea#terminosCondiciones').val(),
			imagenes: imagenes,
		},
		fn: function(data){
			if(data.Exito){
				toastr.success(data.Msj, {positionClass: 'toast-bottom-right'});
				if($(that).attr('id')==''){
					cleanForm($('#container'),data.Campos);
					window.history.pushState("", "", "../agregar");
				}
			}else{
				validateForm($('#container'), data);
				toastr.warning("Revise los campos requeridos.", {positionClass: 'toast-bottom-right'});
			}
		}
	});	
}

/*Asignacion de eventos*/
$('.jqGuardarProducto').off('click').on('click',function(){
	guardarProducto(this);
});
$('.jqEliminarImagen').off('click').on('click',function(){
	eliminarImagen(this);log(this);
});
$('#imagen').off('change').on('change',cargarArchivo);
