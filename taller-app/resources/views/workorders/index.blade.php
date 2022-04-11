<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Workorders
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $workorders->links() }}
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="/workorders/create">New Workorder</a>
                    <table class="table-auto min-w-full divide-y divide-gray-200 mt-6">
                        <thead class="bg-gray-50">
                        <tr>
                            <form method="GET">
                                <td>
                                    <input type="text" name="id" autofocus value="{{request()->get('id')}}">
                                </td>
                                <td>
                                    <input type="text" name="client_id" autofocus value="{{request()->get('client_id')}}">
                                </td>
                                <td>
                                    <input type="text" name="state_id" autofocus value="{{request()->get('state_id')}}">
                                </td>
                                <td>
                                    <input type="text" name="user_id" autofocus value="{{request()->get('user_id')}}">
                                </td>
                                <td>
                                    <input type="text" name="car_initial_state" value="{{request()->get('car_initial_state')}}">
                                </td>
                                <td>
                                    <input type="text" name="car_initial_date" value="{{request()->get('car_initial_date')}}">
                                </td>
                                <td>
                                    <input type="text" name="car_final_state" value="{{request()->get('car_final_state')}}">
                                </td>
                                <td>
                                    <input type="text" name="car_final_date" value="{{request()->get('car_final_date')}}">
                                </td>
                                <td>
                                    <input type="number" name="car_workorder_price" value="{{request()->get('car_workorder_price')}}">
                                </td>
                                <td>
                                    <input type="text" name="client_sign" value="{{request()->get('client_sign')}}">
                                </td>
                                <td>
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Id</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Client Id</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">State Id</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">User Id</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Initial State</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Initial Date</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Final State</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Final Date</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Cost</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider">Client Sign</th>
                            <th scope="col" class="px-6 py-4 text-left uppercase tracking-wider"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($workorders as $workorder)
                        <tr>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->id}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->client_id}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->state_id}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->user_id}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{substr($workorder->car_initial_state, 0, 20)}}...</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->car_initial_date}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{substr($workorder->car_final_state, 0, 20)}}...</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->car_final_date}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$workorder->car_workorder_price}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{substr($workorder->client_sign, 0, 20)}}...</td>
                            <td class="px-6 py-2 whitespace-nowrap">
                                <a class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold px-4 rounded" href="/workorders/{{$workorder->id}}/edit">Edit</a>
                                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded" href="/workorders/{{$workorder->id}}/pieces_list">Pieces</a>
                                <a class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 rounded" href="/workorders/{{$workorder->id}}/photos_list">Photos</a>
                                <a class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold px-4 rounded" href="/workorders/{{$workorder->id}}/signature">Sign</a>
                                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded" href="/workorders/{{$workorder->id}}/export_pdf">Export</a>
                                <a class="bg-red-500 hover:bg-red-700 text-white font-bold px-4 rounded" href="/workorders/{{$workorder->id}}/delete">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="11">No data found 😥</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
