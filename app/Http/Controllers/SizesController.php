<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SizesController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::latest()->get();

        return view('sizes.index', compact('sizes'));
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
            'unit' => ['required', Rule::notIn(0)],
            'weight' => 'required|numeric',
            'servings' => 'required|numeric',
        ]);

        $sizes = new Size();

        $sizes->unit = $request->input('unit');
        $sizes->weight = $request->input('weight');
        $sizes->servings = $request->input('servings');
        $sizes->save();

        alert()->success('Size Added', 'Size added successfully');

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
        $size = Size::find($id);

        $sizes = Size::latest()->get();

        return view('sizes.index', compact('sizes', 'size'));
        // return view('sizes.edit', compact('size'));
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
            'unit' => ['required', Rule::notIn(0)],
            'weight' => 'required|numeric',
            'servings' => 'required|numeric',
        ]);

        $sizes = Size::find($id);

        $sizes->unit = $request->input('unit');
        $sizes->weight = $request->input('weight');
        $sizes->servings = $request->input('servings');
        $sizes->save();

        alert()->success('Size Updated', 'Size updated successfully');

        return redirect(url('sizes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::find($id);
        $size->delete();

        alert()->success('Size Disabled', 'Size Disabled successfully. Go to Trash Bin > Sizes to enable or permanently delete');

        return redirect()->back();
    }
}
