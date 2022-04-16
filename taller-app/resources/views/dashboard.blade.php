<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="font-regulat text-3xl text-gray-800 leading-tight">¡Hello!,  <strong> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </strong> </h1>
                </div>
            </div>
            <br>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">This is your workorders summary  </h1><br>
                        <div class="flex flex-row justify-center ">
                            @forelse($workorders as $workorder)
                            <div class="bg-emerald-200 w-1/4 h-28 text-center ml-12 mr-12" >
                            <p>{{$workorder->state_id}}</p>
                            <h1 style="font-size:40pt"><strong>{{$workorder->count}}</strong></h1>
                            </div>
                            @empty
                            <h1 style="font-size:20pt"><strong>No workorders found 😥</strong></h1>
                            @endforelse
                        </div>
                    </div>
                </div>
    </div>
</x-app-layout>
