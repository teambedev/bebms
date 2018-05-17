@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Računi
                </div>
                <div class="card-body">
                    <a class="btn btn-info" href="{{ route('invoice.create') }}">{{ __('Novi') }}</a>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                            <th scope="col">Company</th>
                            @endif
                            <th scope="col">Client</th>
                            <th scope="col">Date</th>
                            <th scope="col">Price</th>
                            <th scope="col">Plaćeno</th>
                            <th scope="col">PDF</th>
                            <th scope="col">Akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <th scope="row">{{ $invoice->invoice_number }}</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                <td>{{ $invoice->company->name }}</td>
                            @endif
                            <td>{{ $invoice->client->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d.m.Y') }}</td>
                            <td>{{ number_format($invoice->totalPrice(), 2, ',', '.') }}</td>
                            <td>
                                @if($invoice->is_paid)
                                    DA
                                @else
                                    NE
                                @endif
                            </td>
                            <td><a class="btn btn-success" href="{{ route('invoice.pdf', ['id' => $invoice->id]) }}">{{ __('Print') }}</a></td>
                            <td><a class="btn btn-secondary" href="{{ route('invoice.edit', ['id' => $invoice->id]) }}">Uredi</a></td>
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