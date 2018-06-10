@extends('layouts.app1')

@section('content')
<div class="right_col" role="main">
  	<div class="panel-body">
  		<div class="col-md-12 col-sm-12">

        	<h1>Edit Owalokasi</h1>

        	<form action="/owa_lokasi/{{$owalokasi->id}}" method="post">
        		<input type="text" name="lokasi_owa" value="{{ $owalokasi->lokasi_owa }}">
        		<input type="submit" name="submit" value="edit">
        		{{ csrf_field() }}
        		<input type="hidden" name="_method" value="PUT">
        	</form>
        	
    	</div>
  	</div>
</div>
@endsection