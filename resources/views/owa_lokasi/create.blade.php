@extends('layouts.app1')

@section('content')
<div class="right_col" role="main">
  	<div class="panel-body">
  		<div class="col-md-12 col-sm-12">

        	<h1>Create Owalokasi</h1>

        	<form action="/owa_lokasi" method="post">
        		<input type="text" name="lokasi_owa" value="{{ old('lokasi_owa') }}">
            @if($errors->has('lokasi_owa'))
             <p> {{ $errors->first('lokasi_owa')}} </p>
            @endif

        		<input type="submit" name="submit" value="Create">
        		{{ csrf_field() }}
        	</form>

         <!--  @if(count($errors)>0)
          <ul>
            @foreach($errors->all() as $error)
              <li> {{ $error }} </li>
            @endforeach
          </ul>
          @endif -->
        	
    	</div>
  	</div>
</div>
@endsection