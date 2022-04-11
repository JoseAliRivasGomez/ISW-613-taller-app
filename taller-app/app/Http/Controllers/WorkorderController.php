<?php

namespace App\Http\Controllers;

use App\Models\Workorder;
use App\Models\WorkorderChangedPieces;
use App\Models\Piece;
use App\Models\Client;
use App\Models\User;
use App\Models\WorkorderState;
use App\Models\Photo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workorders = Workorder::query()->orderBy('id');
        $states = WorkorderState::all();
        $clients = Client::all();
        $users = User::all();


        if ($request->has('id') && $request->id) {
            $workorders->where('id', $request->id);
        }

        /*check*/
        if ($request->has('client_name') && $request->client_name) {
            $workorders->where('client_id', $request->client_id);
        }

        /*            $workorders->where('car_initial_state', 'ilike', "%$request->car_initial_state%");

        /*check*/
        if ($request->has('state_id') && $request->state_id) {
            $workorders->where('state_id', $request->state_id);
        }

        /*check*/
        if ($request->has('user_id') && $request->user_id) {
            $workorders->where('user_id', $request->user_id);
        }


      
        if ($request->has('car_initial_date') && $request->car_initial_date) {
            $workorders->where('car_initial_date', 'ilike', "%$request->car_initial_date%");
        }
        
        if ($request->has('car_final_date') && $request->car_final_date) {
            $workorders->where('car_final_date', 'ilike', "%$request->car_final_date%");
        }
        

        return view('workorders.index', ['workorders' => $workorders->paginate(10),
        'states' => $states,
        'clients' => $clients,
        'users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = WorkorderState::all();
        $clients = Client::all();
        return view('workorders.create', [
            'states' => $states,
            'clients' => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'state_id' => 'required',
            'user_id' => 'required',
            'car_initial_state' => 'required',
            'car_initial_date' => 'required'
        ]);

        Workorder::create($request->all());
        alert()->success('Successfull','The workorder has been saved');
        return redirect('/workorders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workorder  $workorder
     * @return \Illuminate\Http\Response
     */
    public function show(Workorder $workorder)
    {
        //
    }



    public function pieces_list(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            WorkorderChangedPieces::create($request->all());
            $piece = Piece::find($request->piece_id);
            $piece_quantity = DB::table('pieces')->where('id', $request->piece_id)->value('quantity');
            $r = $piece_quantity - $request->quantity;
            $piece->update(['quantity' => $r]);
            alert()->success('Successfull','The piece has been added to workorder');
            return redirect("/workorders/$id/pieces_list");
        }
        $workorder = Workorder::find($id);
        $pieces = Piece::all();
        $pieces_workorder = WorkorderChangedPieces::where('workorder_id', $workorder->id)->get();
        return view('workorders.pieces_list', [
            'workorder' => $workorder,
            'pieces_workorder' => $pieces_workorder,
            'pieces' => $pieces
        ]);
    }

    public function removePiece(Request $request)
    {
        WorkorderChangedPieces::where(['id' => $request->id, 'workorder_id' => $request->workorder_id])->delete();
        alert()->success('Successfull','The piece has been removed of workorder');
        return redirect("/workorders/$request->workorder_id/pieces_list");
    }


    
    public function delete($id)
    {
        $workorder = Workorder::find($id);
        return view('workorders.delete', ['workorder' => $workorder]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workorder  $workorder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workorder = Workorder::find($id);
        $states = WorkorderState::all();
        $clients = Client::all();
        return view('workorders.edit', ['workorder' => $workorder,
        'states' => $states,
        'clients' => $clients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workorder  $workorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'state_id' => 'required',
            'user_id' => 'required',
            'car_initial_state' => 'required',
            'car_initial_date' => 'required'
        ]);
        $workorder = Workorder::find($request->id);
        $workorder->update($request->all());
        alert()->success('Successfull','The workorder has been updated');
        return redirect('/workorders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workorder  $workorder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Workorder::destroy($id);
            alert()->success('Successfull','The workorder has been deleted');
            return redirect('/workorders');
        } catch (\Throwable $th) {
            alert()->error('Error','Error to workorder delete');
            return redirect('/workorders');
        }

    }
}
