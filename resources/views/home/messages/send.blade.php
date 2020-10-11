@extends('layouts.home')
@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="row">

            <div class="col-md-6 offset-3  ">
                <div class="card">
                    <div class="card-header">
                        Enviar mensaje

                    </div>
                    <div class="card-body">

                        <form action="{{route('sendMessage')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="device_id">Dispositivo</label>
                                <select name="device_id" id="device_id" class="form-control">
                                    <option value="" disabled>Selecciona un dipositivo</option>
                                    <option value="random" >Enviar desde cualquier dispositivo</option>
                                    @foreach($devices as $device)
                                        <option value="{{$device->id}}">{{$device->device_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Número de celular</label>
                                <input type="tel" name="phone" id="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea class="form-control" id="message" name="message">
                                </textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Enviar</button>
                            </div>



                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
