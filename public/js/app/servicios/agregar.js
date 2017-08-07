var controller = 'servicios';
$('.mdb-select').material_select();
var eliminarImagen = function(that){
	post({
		type:'DELETE',
		url: controller+'/eliminarImagen',
		data: {
			imagen: $(that).parent().find('img').attr('nombre'),
			servicio: $('.jqGuardarServicio').attr('id')
		},
		fn: function(data){
			if(data.Exito){
				toastr.success(data.Msj, {positionClass: 'toast-bottom-right'});
				$(that).parents('.img-upload').fadeOut('slow',function(){
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
				url: controller+'/subirImagen',
				data: dataImage,
				contentType: false,
				processData: false,
				fn: function(data){
					if(data.Exito){
						$('#listaImagenes').append(
	                    	'<div class="img-upload col-2 center-on-small-only text-md-left">'+
	                    		'<img class="img-thumbnail" src="'+data.Thumbnail+'" nombre="'+data.Nombre+'"/>'+
	                    		'<button type="button" class="close close-image jqEliminarImagen" aria-label="Close">'+
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
var guardarServicio = function(that){
	//var imagenes=[];
	var datos={imagenes:[]};
	$.each($('#formularioServicio').serializeArray(),function(i,c){
		datos[c.name]=c.value;
	});
	$.each($('.img-upload img').not('[save=1]'),function(i,v){
		datos.imagenes[datos.imagenes.length]=$(this).attr('Nombre');
	});
	datos.visibilidad=($('#visibilidad').is('checked'))?1:0;
	post({
		type:'POST',
		url: controller+'/guardar',
		data: datos,
		fn: function(data){
			if(data.Exito){
				toastr.success(data.Msj, {positionClass: 'toast-bottom-right'});
				alerta.show({
					title: '¡Listo!',
					type: 'success',
					container: 'Tu servicio ha sido agregado correctamente.',
					buttonText: 'Aceptar',
					fn: function(){
						alerta.hide();
						$(location).attr('href', $('.jqCancelar').attr('href'));
					}
				});
			}else{
				alerta.show({
					title: '¡Atención!',
					container: 'Ocurrio un error en la validación.<br>Favor de revisar los datos.',
					type: 'warning',
					buttonText: 'Aceptar',
					fn: function(){
						log(data);
						validateForm($('#formularioServicio'), data);
						alerta.hide();
					}
				});
			}
		}
	});	
}

/*Asignacion de eventos*/
$('.jqGuardarServicio').off('click').on('click',function(){
	guardarServicio(this);
});
$('.jqEliminarImagen').off('click').on('click',function(){
	eliminarImagen(this);log(this);
});
$('#imagen').off('change').on('change',cargarArchivo);
