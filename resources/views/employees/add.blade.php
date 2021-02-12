@extends('layouts.app')
@section('content')
<form id="frm_employee" method="POST" action="{{ (!empty($id)) ? route('editardatos-empleado', ['id' => $id]) : route('guardar-empleado') }}">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="firstName">Nombre(s)</label>
            <input type="text" class="form-control {{ ($errors->has('firstName')) ? 'is-invalid' : '' }}" name="firstName" id="firstName"
            value="{{ old('firstName', $employee->firstName)}}" placeholder="Nombre(s)">
            <div class="invalid-feedback">{{ $errors->first('firstName') }}</div>
        </div>
        <div class="form-group col-md-5">
            <label for="lastName">Apellido(s)</label>
            <input type="text" class="form-control {{ ($errors->has('lastName')) ? 'is-invalid' : '' }}" name="lastName" id="lastName"
            value="{{ old('lastName', $employee->lastName)}}" placeholder="Apellido(s)">
            <div class="invalid-feedback">{{ $errors->first('lastName') }}</div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="email">Correo</label>
            <input type="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" name="email" id="email"
            value="{{ old('email', $employee->email)}}" placeholder="correo@classicmodelcars.com">
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>
        <div class="form-group col-md-5">
        <label for="extension">Extension</label>
            <input type="text" class="form-control {{ ($errors->has('extension')) ? 'is-invalid' : '' }}" name="extension" id="extension"
            value="{{ old('extension', $employee->extension)}}" placeholder="x0000" maxlength="10">
            <div class="invalid-feedback">{{ $errors->first('extension') }}</div>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-5">
            <label for="jobTitle">Cargo</label>
            <input type="text" class="form-control {{ ($errors->has('jobTitle')) ? 'is-invalid' : '' }}" name="jobTitle" id="jobTitle"
            value="{{ old('jobTitle', $employee->jobTitle)}}" placeholder="Cargo">
            <div class="invalid-feedback">{{ $errors->first('jobTitle') }}</div>
        </div>
    <div class="form-group col-md-5">
            <label for="reportsTo">Jefe </label>
            <select name="reportsTo" id="reportsTo" class="form-control {{ ($errors->has('reportsTo')) ? 'is-invalid' : '' }}">
                <option value="">-- N/A --</option>
                @foreach ($chiefs as $jefe)
                    <option value="{{ $jefe->employeeNumber }}" {{ (old('reportsTo', $employee->reportsTo) == $jefe->employeeNumber) ? 'selected' : '' }}> {{ "{$jefe->firstName} {$jefe->lastName} - {$jefe->jobTitle}" }} </option>
                @endforeach
            </select>
            <div class="invalid-feedback">{{ $errors->first('reportsTo') }}</div>
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
            <select name="officeCode" id="officeCode" class="form-control {{ ($errors->has('officeCode')) ? 'is-invalid' : '' }}">
                <option value="">-- Selecciona una opci&oacute;n --</option>
                @foreach ($offices as $office)
                    <option value="{{ $office->officeCode }}" {{ (old('officeCode', $employee->officeCode) == $office->officeCode) ? 'selected' : ''}}>{{ "{$office->country} - {$office->city}" }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">{{ $errors->first('officeCode') }}</div>
        </div>
    </div>
    <button name="agregar" value="agregar" type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#city').on('change', function() {
                $('#officeCodeLoading').removeClass('d-none');
                $.ajax({
                    url: '{{ route('getOffices') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "city": $(this).val()
                    },
                    success: (data, textStatus) => {
                        $('#officeCode').html('<option value="">-- Selecciona una opci&oacute;n --</option>');
                        for (let key in data) {
                            text = `<option value="${key}">${data[key]}</option>`;
                            $('#officeCode').append(text);
                        }
                    },
                    complete: () => {
                        setTimeout(()=>{
                            $('#officeCodeLoading').addClass('d-none');
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endsection
