@extends('layouts.app')
@section('content')
<form id="frm_employee" method="POST" action="{{ route('agregar-empleado') }}">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="firstName">Nombre(s)</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Nombre(s)">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-5">
            <label for="lastName">Apellido(s)</label>
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Apellido(s)">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="email">Correo</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="correo@classicmodelcars.com">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-5">
        <label for="extension">Extension</label>
            <input type="text" class="form-control" name="extension" id="extension" placeholder="x0000" maxlength="10">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-5">
            <label for="jobTitle">Cargo</label>
            <input type="text" class="form-control" name="jobTitle" id="jobTitle" placeholder="Cargo">
            <div class="invalid-feedback"></div>
        </div>
    <div class="form-group col-md-5">
            <label for="reportsTo">Jefe </label>
            <select name="reportsTo" id="reportsTo" class="form-control">
                <option value="">-- N/A --</option>
                @foreach ($chiefs as $jefe)
                    <option value="{{ $jefe->employeeNumber }}"> {{ "{$jefe->firstName} {$jefe->lastName} - {$jefe->jobTitle}" }} </option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-5">
            <label for="city">Ciudad</label>
            <select name="city" id="city" class="form-control">
                <option value="">-- Todas --</option>
                @foreach ($countries as $city)
                    <option value="{{$city->country }}">{{ $city->country }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-5">
            <label for="officeCode"><i id="officeCodeLoading" class="fas fa-spinner fa-spin d-none">&nbsp;</i>Oficina</label>
            <select name="officeCode" id="officeCode" class="form-control">
                <option value="">-- Selecciona una opci&oacute;n --</option>
                @foreach ($offices as $office)
                    <option value="{{ $office->officeCode }}">{{ "{$office->country} - {$office->city}" }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button name="agregar" value="agregar" type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
