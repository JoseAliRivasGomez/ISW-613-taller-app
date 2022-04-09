<?php

namespace App\Http\Controllers;

use App\Models\WorkorderState;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WorkorderStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workorderstates = WorkorderState::query()->orderBy('id');

        if ($request->has('id') && $request->id) {
            $workorderstates->where('id', $request->id);
        }

        if ($request->has('description') && $request->description) {
            $workorderstates->where('description', 'ilike', "%$request->description%");
        }

        return view('workorderstates.index', ['workorderstates' => $workorderstates->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workorderstates.create');
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
            'description' => 'required',
        ]);

        WorkorderState::create($request->all());
        alert()->success('Successfull','The Workorder State has been saved');
        return redirect('/workorderstates');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkorderState  $workorderState
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workorderState = WorkorderState::find($id);
        return view('workorderstates.edit', ['workorderState' => $workorderState]);
    }

    public function delete($id)
    {
        $workorderState = WorkorderState::find($id);
        return view('workorderstates.delete', ['workorderState' => $workorderState]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkorderState  $workorderState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $workorderState = WorkorderState::find($request->id);
        $workorderState->update($request->all());
        alert()->success('Successfull','The Workorder State has been updated');
        return redirect('/workorderstates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkorderState  $workorderState
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkorderState::destroy($id);
        alert()->success('Successfull','The Workorder State has been deleted');
        return redirect('/workorderstates');
    }
}