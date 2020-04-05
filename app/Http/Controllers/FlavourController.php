<?php

namespace App\Http\Controllers;

use App\Flavour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlavourController extends Controller
{
    public function __constrct()
    {
        return $this->middleware('auth');
    }
    /**
     *  Return data of Flavours for Laravel Datatables
     * 
     */
    // public function get_dataTable()
    // {
    //     $flavour = Flavour::query();
    //     return DataTables::of($flavour)->addIndexColumn()->make(true);
    //     // ->toJson();
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flavours = Flavour::latest()->get();
       
        return view('flavours.index', compact('flavours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => 'required|min:3|max:30|unique:flavours,title'
        ]);
        try {
            DB::beginTransaction();

            $flavour = new Flavour();

            $flavour->title = $request->input('title');
            $flavour->save();

            alert()->success('Flavour Added', 'Flavour added successfully');

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $flavour = Flavour::find($id);
        $flavours = Flavour::latest()->get();

        return view('flavours.index', compact('flavours', 'flavour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:30|unique:flavours,title,' . $id
        ]);
        try {
            DB::beginTransaction();

            $flavour = Flavour::find($id);

            $flavour->title = $request->input('title');
            $flavour->save();

            alert()->success('Flavour Updated', 'Flavour updated successfully');

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect(url('flavours'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flavour = Flavour::find($id);
        $flavour->delete();

        alert()->success('Flavour Disabled', 'Flavour Disabled successfully. Go to Trash Bin > Flavours to enable or permanently delete');

        return redirect()->back();
    }
}
