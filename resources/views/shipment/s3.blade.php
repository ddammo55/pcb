@extends('master')

@section('content')



@foreach($responseArray as $product)
  {{ $product }}
@endforeach


<div class="ui segment">
  <div class="ui three column very relaxed grid">

    @include('shipment._shipmentList')

  </div>






@endsection
