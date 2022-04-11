<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Workorder
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="/workorders/{{$workorder->id}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{$workorder->user_id}}">
                        <label class="mt-5">Workorder State:</label>
                        <select class="mt-5" name="state_id">
                            @foreach ($states as $state)
                                @if ($workorder->state_id === $state->id)
                                    <option value="{{$state->id}}" selected>
                                        {{$state->description}} 
                                    </option>
                                @else
                                    <option value="{{$state->id}}">
                                        {{$state->description}} 
                                    </option>
                                @endif
                            @endforeach
                        </select></br>
                        <label class="mt-5">Client:</label>
                        <select class="mt-5" name="client_id">
                            @foreach ($clients as $client)
                                @if ($workorder->client_id === $client->id)
                                    <option value="{{$client->id}}" selected>
                                        {{$client->first_name}} {{$client->last_name}}
                                    </option>
                                @else
                                    <option value="{{$client->id}}">
                                        {{$client->first_name}} {{$client->last_name}}
                                    </option>
                                @endif
                            @endforeach
                        </select></br>
                        <label class="mt-5">Car Initial State:</label>
                        <textarea class="mt-5" name="car_initial_state" rows="4" cols="50" required>{{$workorder->car_initial_state}}</textarea></br>
                        <label class="mt-5">Initial Date:</label>
                        <input class="mt-5" type="date" name="car_initial_date" required value="{{substr($workorder->car_initial_date, 0, 10)}}"></br>
                        <label class="mt-5">Car Final State:</label>
                        <textarea class="mt-5" name="car_final_state" rows="4" cols="50">{{$workorder->car_final_state}}</textarea></br>
                        <label class="mt-5">Final Date:</label>
                        <input class="mt-5" type="date" name="car_final_date" value="{{substr($workorder->car_final_date, 0, 10)}}"></br>
                        <label class="mt-5">Workorder cost:</label>
                        <input class="mt-5" type="number" name="car_workorder_price" value="{{$workorder->car_workorder_price}}"></br>
                        <button class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        <a class="mt-5 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="/workorders">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>