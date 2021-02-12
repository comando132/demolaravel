@extends('layouts.app')
@section('content')
    <div class="row justify-content-end">
        <div class="col-1"><a class="btn btn-primary" href="{{ route('agregar-empleado') }}">Agregar</a></div>
    </div>
    <br class="clearfix" />
    <div class="row">
        @foreach ($employees as $emp)
            <div class="col-sm-3">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ "{$emp->firstName} {$emp->lastName}" }}</h5>
                    <p class="card-text">
                        <strong>{{ $emp->jobTitle }} </strong><br />
                        {{ $emp->email}} <br />
                        {{ $emp->extension}}
                    </p>
                    <a href="#" class="btn btn-primary">Detalle</a>
                </div>
                </div>
            </div>
        @endforeach
    </div>
  @endsection
