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
      .close{
            position: absolute;
            right: -8px;
            top: -8px;
            border: 1px solid #3a3636!important;
            background: #ffffff!important;
            border-radius: 50%;
            width: 24px;
            height: 24px;
      }
    </style>
@endsection

@section('content')
<div id="container">
        <!-- Formulario -->
          <div class="row">
            <div class="col-md-12 center-on-small-only ">
                <!-- Nav tabs -->
                <div class="tabs-wrapper"> 
                    <ul class="nav classic-tabs tabs-primary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link waves-light active" data-toggle="tab" href="#panel01" role="tab"><i class="fa fa-cube fa-2x" aria-hidden="true"></i><br> Información del producto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-light" data-toggle="tab" href="#panel02" role="tab"><i class="fa fa-plus fa-2x" aria-hidden="true"></i><br> Información adicional</a>
                        </li>
                    </ul>
                </div>

                <!-- Tab panels -->
                <div class="tab-content card">
                    <!--Panel 1-->
                    <div class="tab-pane fade in show active" id="panel01" role="tabpanel">
                            <div class="row">         
                                 <div class="col-3 md-form">
                                    <input placeholder="C&oacute;digo de producto" type="text" id="codigo" class="form-control" value="{{ isset($producto->codigo)?$producto->codigo:'' }}"> 
                                    <label class="col-12" for="codigo" data-error="Campo requerido">&nbsp;</label>
                                 </div>
                                 <div class="col-7 md-form">
                                     <input placeholder="Nombre de producto" type="text" id="nombre" class="form-control" value="{{ isset($producto->nombre)?$producto->nombre:'' }}"> 
                                     <label class="col-12" for="nombre" data-error="Campo requerido">&nbsp;</label>
                                  </div>
                                  <div class="col-2">
                                    <!--p><small><i class="fa fa-certificate fa-1x green-text" aria-hidden="true"></i>Autorizado por ZU</small></p-->
                                 </div>
                            </div>
                            <div class="row">            
                                 <div class="col-10 md-form">
                                    <textarea type="text" id="descripcion" class="md-textarea" placeholder="Descripción de producto">{{ isset($producto->descripcion)?$producto->descripcion:'' }}</textarea>
                                    <label class="col-12" for="descripcion" data-error="Campo requerido">&nbsp;</label>
                                  </div>
                            </div>
                            <br>
                            <div class="row">            
                                     <div class="col-4 md-form">

                                        <input placeholder="Precio" type="text" id="precio" class="form-control" value="{{ isset($producto->precio)?$producto->precio:'' }}"> 
                                          <label class="col-12" class="active" for="precio" data-error="Campo requerido">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Precio por día</label>
                                     </div>
                                     <div class="col-2 text-left">&nbsp;</div>
                                     <div class="col-4 md-form">
                                         <input placeholder="Stock" type="text" id="stock" class="form-control" value="{{ isset($producto->stock)?$producto->stock:'' }}">
                                         <label class="col-12" class="active" for="stock" data-error="Campo requerido">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Piezas en stock</label>
                                      </div>
                                    
                            </div>
                            <div class="row">            
                                     <div class="col-4 md-form">
                                       <select class="mdb-select" id="idCategoria">
                                        <!--option value="" disabled selected>Categoria</option-->
                                        @foreach ($categorias as $key => $categoria)
                                          <option value="{{ $categoria->id }}" @if($categoria->id==$producto->idCategoria) selected @endif>{{ $categoria->nombre }}</option>
                                        @endforeach
                                      </select>
                                      <label class="col-12" for="idCategoria" data-error="Campo requerido">&nbsp;</label>
                                    </div>
                                    <div class="col-2 text-left">&nbsp;</div>
                                    <div class="col-4 text-left md-form">
                                        <fieldset class="form-group">
                                          <input type="checkbox" class="filled-in" id="visibleWeb" {{ isset($producto->visibleWeb)?$producto->visibleWeb:''}}>
                                          <label class="col-12" for="visibleWeb" data-error="Campo requerido">Visible en ZU</label>
                                        </fieldset>
                                    </div>
                            </div> 
                            <hr/>
                            <div class="row" style="min-height: 96px;">            
                                     <div class="col-2">
                                            <div class="file-field">
                                                <form enctype="multipart/form-data" id="formularioImagen">
                                                    <div class="btn btn-primary btn-sm" style="line-height: 1rem;">
                                                      <span>Subir imagen</span>
                                                      <input id="imagen" name="image" type="file">
                                                  </div>
                                                </form>
                                            </div>
                                     </div>
                                           <!--listado imagenes-->
                                    <div class="col-8">
                                      <div class="row" id="listaImagenes">
                                        @foreach ($imagenes as $key => $imagen)
                                        @php
                                          $nombre=explode('/',$imagen);
                                          $nombre=$nombre[count($nombre)-1];
                                        @endphp
                                          <div class="img-producto col-2 center-on-small-only text-md-left">
                                            <img class="img-thumbnail" src="{{asset('img/'.$imagen)}}" save="1"/ nombre="{{$nombre}}">
                                            <button type="button" class="close jqEliminarImagen" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                        @endforeach
                                      </div>
                                                                       
                                    </div>
                                    <!--/listado imagenes-->
                            </div>
                              
                    </div>
                    <!--/.Panel 1-->

                    <!--Panel 2-->
                    <div class="tab-pane fade" id="panel02" role="tabpanel">

                            <div class="row">            
                                     <div class="col-10 md-form">
                                        <textarea type="text" id="detalles" class="md-textarea" placeholder="Detalle adicional de producto">{{ isset($producto->detalles)?$producto->detalles:'' }}</textarea>
                                        <label class="col-12" for="detalles" data-error="Campo requerido">&nbsp;</label>
                                      </div>
                            </div>

                            <div class="row">            
                                     <div class="col-10 md-form">
                                          <textarea type="text" id="terminosCondiciones" class="md-textarea" placeholder="Terminos y condiciones de producto">{{ isset($producto->terminosCondiciones)?$producto->terminosCondiciones:'' }}</textarea>
                                        <label class="col-12" for="terminosCondiciones" data-error="Campo requerido">&nbsp;</label>
                                      </div>
                            </div>

                    </div>
                    <!--/.Panel 2-->
                </div>

            </div>
          </div>
        <!-- /Formulario -->
    <p></p>
           <!--Botones-->
    <div class="row">
      <div class="col-md-6 center-on-small-only text-left">
              <a class="btn btn-default jqCancelar"  href="{{ url('') }}/inventario"> Cancelar</a>
      </div>
      <div class="col-md-6 center-on-small-only text-right">
              <a class="btn btn-primary jqGuardarProducto" id="{{isset($producto->id)?$producto->id:''}}"> Guardar</a>
      </div>
    </div>
          <!--/botones-->

  <p></p>

</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/app/inventario/agregar.js') }}"></script>
@endsection