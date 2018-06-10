@extends('layouts.app1')

@section('content')
<div class="right_col" role="main">
  	<div class="panel-body">
  		<div class="col-md-12 col-sm-12">
        Haii
        <hr>
        @foreach($owalokasis as $owalokasi)
          <li>
            <a href="/owa_lokasi/{{$owalokasi->id}}">{{ $owalokasi->lokasi_owa }}</a>
            <form action="/owa_lokasi/{{$owalokasi->id}}" method="post">
              <input type="submit" name="submit" value="delete">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="Delete">
            </form>
          </li>
        @endforeach
      </div>
  	</div>
</div>
@endsection
