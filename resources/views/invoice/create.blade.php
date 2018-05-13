@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Novi račun {{ $invoice_number }}/01/01</div>
                {!! Form::open(array('route' => 'pdf')) !!}
                {{ Form::hidden('invoice_number', $invoice_number) }}
                	<div class="card-body">
	                	<div class="form-row">
	                		<div class="form-group col-md-6">
	                			{{ Form::label('client', 'Kupac:') }}
                                <select name="client" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}, Adresa: {{ $client->address }}, Mjesto: {{ $client->city }}, OIB: {{ $client->oib }}</option>
                                    @endforeach
                                </select>
                            </div>
	                		<div class="form-group col-md-2"> <!-- Date input -->
                                {{ Form::label('invoice_date', 'Datum:') }}
                                {{ Form::text('invoice_date', null, array('class'=>'form-control', 'placeholder' => 'DD.MM.YYYY')) }}
						    </div>
                            <div class="form-group col-md-2"> <!-- Date input -->
                                {{ Form::label('invoice_time', 'Vrijeme:') }}
                                {{ Form::text('invoice_time', null, array('class'=>'form-control', 'placeholder' => 'HH:MM')) }}
                            </div>
                            <div class="form-group col-md-2"> <!-- Date input -->
                                {{ Form::label('place', 'Mjesto:') }}
                                {{ Form::text('place', null, array('class'=>'form-control', 'placeholder' => 'Mjesto izdavanja računa')) }}
                            </div>
	                	</div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {{ Form::label('remark', 'Napomena:') }}
                                <select name="remark" class="form-control">
                                    @foreach ($remarks as $remark)
                                        <option value="{{ $remark->id }}">{{ $remark->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                {{ Form::label('payment_type', 'Način plaćanja:') }}
                                <select name="payment_type" class="form-control">
                                    <option value="Transakcijski račun">Transakcijski račun</option>
                                    <option value="Gotovina">Gotovina</option>   
                                </select>
                            </div>
                            <div class="form-group col-md-3"> <!-- Date input -->
                                {{ Form::label('payment_deadline', 'Dospijeće plaćanja:') }}
                                {{ Form::text('payment_deadline', null, array('class'=>'form-control', 'placeholder' => 'DD.MM.YYYY')) }}
                            </div>
                        </div>
                        @for($i = 0; $i < 10; $i++)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {{ Form::label('products', 'Stavke:') }}
                                <select name="product[{{$i}}]" class="form-control">
                                    <option value="0" selected>Izaberi...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->code }}">{{ $product->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('units', 'JM:') }}
                                <select name="unit[{{$i}}]" class="form-control">
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('amount', 'Količina:') }}
                                {{ Form::text('amount', null, array('class'=>'form-control', 'placeholder' => '20', 'name' => 'amount['.$i.']')) }}
                            </div>
                            <div class="form-group col-md-2">
                                {{ Form::label('price', 'Cijena:') }}
                                {{ Form::text('price', null, array('class'=>'form-control', 'placeholder' => '20', 'name' => 'price['.$i.']')) }}
                            </div>
                        </div>
                        @endfor


                        {{ Form::submit('Spremi', array('class'=>'btn btn-success')) }}

                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection