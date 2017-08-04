@extends('layout.master')

@include('layout.menu')

@section('css')
    <style type="text/css">
      textarea.md-textarea+label:after {
        top: 111px!important;
      }
      .img-producto img{
        max-width: 128px!important;
        min-width: 128px!important;
        min-height: 96px!important;
        max-height: 96px!important;
      }
      .close-image{
            position: absolute;
            right: -8px;
            top: -8px;
            border: 1px solid #3a3636!important;
            background: #ffffff!important;
            border-radius: 50%;
            width: 24px;
            height: 24px;
      }
      .select-wrapper input.select-dropdown{
        height: 3.4rem;
      }
    </style>
@endsection

@section('content')
<div class="row">
  <form class="col-lg-12 col-md-12 col-sm-12" id="formularioProducto">
    <!-- Nav tabs -->
    <div class="tabs-wrapper"> 
      <ul class="nav classic-tabs tabs-primary" role="tablist">
        <li class="nav-item">
          <a class="nav-link waves-light active" data-toggle="tab" href="#informacionProducto" role="tab">
            <i class="fa fa-cube fa-3x" aria-hidden="true"></i><br> Información general
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-light" data-toggle="tab" href="#adicionalesProducto" role="tab">
            <i class="fa fa-gavel fa-3x" aria-hidden="true"></i><br> Detalles adicionales
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-light" data-toggle="tab" href="#multimediaProducto" role="tab">
            <i class="fa fa-image fa-3x" aria-hidden="true"></i><br> Imagenes y video
          </a>
        </li>
      </ul>
    </div>
    <!-- Tab panels -->
    <div class="tab-content card">
      <div class="tab-pane fade in show active" id="informacionProducto" role="tabpanel">
        <div class="row">
          <div class="col-lg-12 text-left">
            <p>
              <small>
                <i class="fa fa-certificate fa-2x orange-text" aria-hidden="true"></i> Producto pendiente de autorización ZU
              </small>
            </p>
          </div>
          <div class="col-lg-6 md-form">
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="&nbsp;"> 
            <label class="col-lg-12" for="nombre" data-error="Error">Nombre del producto</label>
          </div>
          <div class="col-lg-2 md-form">
            <input type="text" id="codigo" name="codigo" class="form-control" placeholder="&nbsp;"> 
            <label class="col-lg-12" for="codigo" data-error="Error">C&oacute;digo del producto</label>
          </div>
          <div class="col-lg-2 md-form">
            <select class="mdb-select" id="idCategoria" name="idCategoria">
              @foreach ($categorias as $key => $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
              @endforeach
            </select>
            <label class="col-lg-12" for="idCategoria" data-error="Error">Categor&iacute;a</label>
          </div>
          <div class="col-lg-2 text-left md-form">
            <fieldset class="form-group">
              <input type="checkbox" class="filled-in" id="visibilidad" name="visibilidad">
              <label class="col-lg-12" for="visibilidad" data-error="Error">Visible</label>
            </fieldset>
          </div>
          <div class="col-lg-12 md-form">
            <textarea type="text" id="descripcion" name="descripcion" class="md-textarea" placeholder="&nbsp;"></textarea>
            <label class="col-lg-12" for="descripcion" data-error="Error">Descripci&oacute;n</label>
          </div>
          <div class="col-lg-3 md-form">
            <input type="number" id="existencia" name="existencia" class="form-control" min="0" value="0" placeholder="&nbsp;">
            <label class="col-lg-12" class="active" for="existencia" data-error="Error">Existencia</label>
          </div>
          <div class="col-lg-3 md-form">
            <input type="number" id="capacidad" name="capacidad" class="form-control" min="1" value="1" placeholder="&nbsp;"> 
            <label class="col-lg-12" for="capacidad" data-error="Error">Capacidad del producto</label>
          </div>
          <div class="col-lg-3 md-form">
            <input type="number" id="cantidadMinima" name="cantidadMinima" class="form-control" min="1" value="1" placeholder="&nbsp;"> 
            <label class="col-lg-12" class="active" for="cantidadMinima" data-error="Error">Renta minima</label>
          </div>
          <div class="col-lg-3 md-form">
            <input type="number" id="precioUnitario" name="precioUnitario" class="form-control" min="0" value="0" placeholder="&nbsp;"> 
            <label class="col-lg-12" class="active" for="precioUnitario" data-error="Error">Precio unitario</label>
          </div>
        </div>
      </div>
      <div class="tab-pane fade in" id="adicionalesProducto" role="tabpanel">
        <div class="col-lg-6 md-form">
          <textarea type="text" id="detalles" name="detalles" row="6" class="md-textarea" placeholder="Ej. Caracter&iacute;sticas t&eacute;cnicas que describan mejor al producto"></textarea>
          <label class="col-lg-6" for="detalles" data-error="Error">Especificaciones técnicas</label>
        </div>
        <div class="col-lg-6 md-form">
          <textarea type="text" id="terminosCondiciones" name="terminosCondiciones" row="6" class="md-textarea" placeholder="&nbsp;"></textarea>
          <label class="col-lg-12" for="terminosCondiciones" data-error="Error">Terminos y condiciones</label>
        </div>
      </div>
      <div class="tab-pane fade in" id="multimediaProducto" role="tabpanel">
        <div class="row" style="min-height: 96px;">            
          <div class="col-2">
            <div class="file-field">
              <form enctype="multipart/form-data" id="formularioImagen">
                <div class="btn btn-primary btn-sm" style="line-height: 1rem;">
                  <span>Elegir archivo</span>
                  <input id="imagen" name="image" type="file">
                </div>
              </form>
            </div>
          </div>
          <!--listado imagenes-->
          <div class="col-8">
            <div class="row" id="listaImagenes">
              <!--Aqui se agregaran los thumbs de las imagenes cargadas-->
            </div>
          </div>
          <!--/listado imagenes-->
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <a class="btn btn-default jqCancelar" href="{{route('productos')}}"> Regresar a la tabla</a>
        </div>
        <div class="col-md-6">
          <a class="btn btn-primary jqGuardarProducto pull-right"> Guardar producto</a>
        </div>  
      </div>
    </div>
  </form>
  <div class="col-md-12">&nbsp;</div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/app/productos/agregarProducto.js') }}"></script>
@endsection