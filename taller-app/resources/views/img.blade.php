

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Client
        </h2>
    </x-slot>

    <div class="container">
    <div class="row">
      {{-- Uplode form and picture  --}}
      <div class="col-lg-6">
        <div class="card shadow rounded">
          <div class="card-body">
            <h3 class="text-primary">Upload Image</h3><br>
            {!! Form::open(['action' => 'App\Http\Controllers\ImageController@store', 'method' => 'POST' , 'files'=>true]) !!}

            <div class="form-group">
              {!! Form::label('image', 'Uplode Picture') !!}
              <br>
              {!! Form::file('image', null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="col-lg-6 pt-lg-0 pt-3">
        <div class="card shadow rounded">
          <div class="card-body">
            <h3 class="text-primary">Image fetched from Firebase Storage.</h3>
            <img src="{{ $image }}" class="img-fluid" alt="Responsive image">
            <br>
            <a href="{{ $image }}">Link generated from Firebase</a>
            {!! Form::open(['method'=>'DELETE', 'action'=> ['App\Http\Controllers\ImageController@destroy',"delete"]]) !!}
            <div class="form-group pt-2">
              {!! Form::submit('Delete Image', ['class'=>'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
