$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var modalDialogMsj=$('#modalDialogMsj').modal({
	keyboard: false,
	backdrop: true,
	focus: true
});
function modal={
	show: function(obj){
		$.extend({
			title: '¡Atencion!',
			container: '',
			buttonText: 'Aceptar',
			fn: function(){}
		},obj);
		modalDialogMsj.find('#tituloModalDialogMsj').text(obj.title);
		modalDialogMsj.find('#bodyModalDialogMsj').html(obj.container);
		modalDialogMsj.find('#buttonModalDialogMsj').text(obj.buttonText);
		modalDialogMsj.find('#buttonModalDialogMsj').off('click').on('click',obj.fn);
		modalDialogMsj.modal('show');
	},
	hide: function(){
		modalDialogMsj.modal('hide');	
	}
}
function log(v=''){
	console.log(v);
}
function post( obj ){
	$.ajax({
		type: ((typeof(obj.type)!="undefined")?obj.type:"GET"),
		url: urlCore+((typeof(obj.url)!="undefined")?obj.url:''),
		data: obj.data,
		dataType: (typeof(obj.dataType)!="undefined")?obj.dataType:"JSON",
		contentType: (typeof(obj.contentType)!="undefined")?obj.contentType:'application/x-www-form-urlencoded; charset=UTF-8',
		processData: (typeof(obj.processData))?obj.processData:true,
		context: document.body
	}).done(			
		(typeof(obj.fn)!="undefined")
		? obj.fn
		: function(){
		}
	).fail(function(data){
		log(data);
		log(obj);
		log("Fallo la peticion.");
	});
}
function cleanForm(container, fields){
	$(fields).each(function(i,v){
		$(container).find('#'+v).material_select('destroy');
		$(container).find('#'+v).val('');
		$(container).find('#'+v).find('option').removeAttr('selected');
		$(container).find('#'+v).prop('checked',false);
		if($(container).find('#'+v+'>option').length>0){
			$(container).find('#'+v).material_select();
		}
	});
}
function validateForm(container, errors){
	$(container).find('select,input,textarea').removeClass('invalid');
	$(container).find('label').attr('data-error','');
	$.each(errors, function(i,error){
		$(container).find('#'+i).parent().find('label').attr('data-error',error.join(','));
		$(container).find('#'+i).addClass('invalid');
	});

}
$.extend( true, $.fn.dataTable.defaults, {
    "info": false,
    "searching": false,
    "language": {
	    "lengthMenu": "Mostrando _MENU_ registros por pagina",
	    "zeroRecords": "No hay registros",
	    "info": "Mostrando página _PAGE_ de _PAGES_",
	    "infoEmpty": "Sin registros",
	    "infoFiltered": "(filtrados de _MAX_ registros totales)",
	    "oPaginate": {
			"sFirst":    	"<<",
			"sPrevious": 	"<",
			"sNext":     	">",
			"sLast":     	">>"
		},
	},
} );

toastr.options = {
    "closeButton": true, // true/false
    "debug": false, // true/false
    "newestOnTop": false, // true/false
    "progressBar": false, // true/false
    "positionClass": "toast-top-right", // toast-top-right / toast-top-left / toast-bottom-right / toast-bottom-left
    "preventDuplicates": true, //true/false
    "onclick": null,
    "showDuration": "300", // in milliseconds
    "hideDuration": "1000", // in milliseconds
    "timeOut": "5000", // in milliseconds
    "extendedTimeOut": "1000", // in milliseconds
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}