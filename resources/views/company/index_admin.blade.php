@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<a class="btn btn-info" href="{{ route('company.create') }}">Nova tvrtka</a>
			@foreach($companies as $company)
				<div class="card">
					<div class="card-header">
						Podaci o tvrtki
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-4">
								<h5>Naziv:</h5><p><strong>{{ $company->name }}</strong></p>
								<h5>Vlasnik:</h5><p><strong>{{ $company->owner }}</strong></p>
								<h5>Adresa:</h5><p><strong>{{ $company->address }}</strong></p>
								<h5>Mjesto:</h5><p><strong>{{ $company->zip_code }} {{ $company->city }}</strong></p>
							</div>
							<div class="form-group col-md-4">
								<h5>OIB:</h5><p><strong>{{ $company->oib }}</strong></p>
								<h5>IBAN:</h5><p><strong>{{ $company->iban }}</strong></p>
								<h5>Banka:</h5><p><strong>{{ $company->bank_info }}</strong></p>
								<h5>Djelatnost:</h5><p><strong>{{ $company->activity }}</strong></p>
							</div>
							<div class="form-group col-md-4">
								<p><img src="{{ asset('storage/'.$company->logo_path) }}" class="img-fluid img-thumbnail" height="200" width="200" alt="Company logo!"></p>
								<h5>Boja:</h5><p style="color: #{{ $company->color }};"><strong>{{ $company->color }}</strong></p>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-2">
								<a class="btn btn-secondary" href="{{ route('company.edit', [$company->id]) }}">Uredi</a>
							</div>
							<div class="form-group col-md-2">
								{!! Form::open(["route"=>["company.destroy", $company->id], "method" => "DELETE"]); !!}
                                {!! Form::submit("Obriši ", array("class"=>"btn btn-danger")); !!}
                                {!! Form::close(); !!}
							</div>
						</div>
					</div>
				</div>
			@endforeach
        </div>
    </div>
</div>
@endsection