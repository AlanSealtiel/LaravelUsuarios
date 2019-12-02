
@extends('layout')

@section('title')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <br/><br/><br/>
            <h2>Crear nuevo usuario</h2>
            <form method='POST' action="@if(!empty($user)){{url('/usuarios/editar/'.$user->id_cliente)}}@else{{url('/usuarios/crear')}}@endif">
                {!!csrf_field()!!}
                <div class="form-group">
                    <label for="clave">Clave:</label>
                    <input type="text" name="clave" id="clave" class="form-control" value="@if(!empty($user)){{$user->clave}}@else{{old('clave')}}@endif">
                    @if ($errors->has('clave'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('clave') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nombre_comercial">Nombre comercial:</label>
                    <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control" value="@if(!empty($user)){{$user->nom_com}}@else{{old('nombre_comercial')}}@endif">
                    @if ($errors->has('nombre_comercial'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('nombre_comercial') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="razon_social">Razón social:</label>
                    <input type="text" name="razon_social" id="razon_social" class="form-control" value="@if(!empty($user)){{$user->raz_soc}}@else{{old('razon_social')}}@endif">
                    @if ($errors->has('razon_social'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('razon_social') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="rfc">RFC:</label>
                    <input type="text" name="rfc" id="rfc" class="form-control" value="@if(!empty($user)){{$user->rfc}}@else{{old('rfc')}}@endif">
                    @if ($errors->has('rfc'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('rfc') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="text" name="edad" id="edad" class="form-control" value="@if(!empty($user)){{$user->edad}}@else{{old('edad')}}@endif">
                    @if ($errors->has('edad'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('edad') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="domicilio">Domicilio:</label>
                    <input type="text" name="domicilio" id="domicilio" class="form-control" value="@if(!empty($user)){{$user->domicilio}}@else{{old('domicilio')}}@endif">
                    @if ($errors->has('domicilio'))
                        <div class="alert alert-danger" role="alert">
                        {{ $errors->first('domicilio') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-check">
                        @if ((!empty($user) && $user->estatus == 1))
                            <input type="checkbox" name="estatus" id="estatus" value="1" checked>
                        @else
                            <input type="checkbox" name="estatus" id="estatus" value="2">
                        @endif
                        <label class="form-check-label" for="estatus">
                            Estatus
                        </label>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">
                    @if(!empty($user))<span>Editar usuario</span>@else<span>Crear usuario</span>@endif
                </button>
            </form>
            <br/>

            @if (!empty($user))
            <form method='POST' action="{{url('/usuarios/eliminar/'.$user->id_cliente)}}">
            {!!csrf_field()!!}
                    <button class="btn btn-danger" type="submit">Eliminar usuario</button>
                </form>
            @endif
        </div>

        <div class="col-6">
            <br/><br/><br/><br/>
            <h3>Lista de usuarios registrados:</h3>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Clave</th>
                    <th scope="col">Nombre comercial</th>
                    <th scope="col">Razón social</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    </tr>
                    @forelse ($users as $user)
                        <tr>
                            <td><a href="{{url("/usuarios/{$user->id_cliente}")}}">{{$user->clave}}</a></td>
                            <td>{{$user->nom_com}}</td>
                            <td>{{$user->raz_soc}}</td>
                            <td>{{$user->rfc}}</td>
                            <td>{{$user->edad}}</td>
                            <td>{{$user->domicilio}}</td>
                            <td>
                                @if ($user->estatus == 1)
                                    Activado 
                                    <input type="checkbox" checked disabled>
                                @elseif ($user->estatus == 2)
                                    Desactivado <input type="checkbox" disabled>
                                @elseif ($user->estatus == 3)
                                    Eliminado <input type="checkbox" disabled>
                                @else
                                    Sin estatus
                                @endif
                                
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-info" role="alert">
                            No hay usuarios registrados
                        </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection