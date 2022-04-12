<!DOCTYPE html>
<html>
<head>
    <title>Workorder {{$workorder_id}}</title>
</head>
<body>
    <h1>Workorder ID: {{ $workorder_id }}</h1>
    <h3>Client ID: {{ $client_id }}</h3>
    <h3>Client Name: {{ $client_first_name }} {{ $client_last_name }}</h3>
    <h5></h5>
    <h3>User ID: {{ $user_id }}</h3>
    <h3>User Name: {{ $user_first_name }} {{ $user_last_name }}</h3>
    <h5></h5>
    <h3>State ID: {{ $state_id }}</h3>
    <h3>State Description: {{ $state_description }}</h3>
    <h5></h5>
    <h3>Car Initial State: {{ $car_initial_state }}</h3>
    <h3>Car Initial Date: {{ $car_initial_date }}</h3>
    <h3>Car Final State: {{ $car_final_state }}</h3>
    <h3>Car Final Date: {{ $car_final_date }}</h3>
    <h3>Car Workorder Cost: {{ $car_workorder_price }}</h3>
    <h5></h5>
    <label>Pieces:</label></br></br>
    @forelse ($pieces_workorder as $line)
    <li class="inline mt-2">
        <div>
            {{$line->quantity}} of {{$line->piece->description}} (${{$line->piece->cost}})
        </div>
    </li>
    @empty
    <li>
        No pieces found
    </li>
    @endforelse
    <h3></h3>
    <label>Photos:</label></br></br>
    @if (count($photos_workorder) > 0)
        @for ($i = 0; $i < count($photos_workorder); $i++)
            <div>
                <h5></h5>
                <img src="{{public_path('firebase-temp-uploads').'/'.$photos_workorder[$i]->link}}" width="300"></br>
            </div>
        @endfor
    @else
    <li>
        No photos found
    </li>
    @endif
    <h3></h3>
    <label>Client sign:</label></br></br>
    <div>
        <h5></h5>
        <img src="{{public_path('firebase-temp-uploads').'/'.$client_sign}}" width="300"></br>
    </div>
</body>
</html>