@extends('layouts.home')
@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="row">

            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        Dispositivos

                    </div>
                    <div class="card-body">
                        <a href="{{url('home/send/messages')}}" class="btn btn-outline-success float-right mb-4">
                            Enviar mensajes
                        </a>


                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Dispositivo</th>
                                    <th scope="col">Mensajes enviados</th>
                                    <th scope="col">Mensajes recibidos</th>
                                    <th scope="col">Región</th>
                                    <th scope="col">Registro</th>
                                   <!--
                                    <th scope="col">Acciones</th>
                                   -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devices as $device)
                                    <tr>
                                        <th scope="row">{{$device->id}}</th>
                                        <td>{{$device->device_name}}</td>

                                        <td>{{$device->messages->where('type', '=', 'remit')->count()}}</td>
                                        <td>{{$device->messages->where('type', '=', 'receiver')->count()}}</td>
                                        <td>{{$device->region}}</td>
                                        <td>{{$device->created_at}}</td>
                                    <!--
                                        <td>
                                            <a href="{{url('/home/send/message/test/'.$device->id)}}"> Test</a>
                                        </td>
                                           -->
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
