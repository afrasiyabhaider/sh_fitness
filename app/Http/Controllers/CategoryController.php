<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        $parent_categories = Category::latest()->where('parent_id','=',0)->get();
        return view('category.index',compact('categories','parent_categories'));
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
            'title' => 'required|unique:categories,title|min:3'
        ]);

        try {
            DB::beginTransaction();

            $category = new Category();
            $category->title = $request->input('title');
            if ($request->has('parent')) {
                $category->parent_id = $request->input('parent');
            }else{
                $category->parent_id = 0;
            }
            $category->save();

            DB::commit();

            alert()->success('Category Registered','Category Registered Successfully');
            
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('Category Not Registered','Error Occured Please try again '. $ex->getMessage());
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
        $category = Category::find($id);
        $categories = Category::latest()->get();
        $parent_categories = Category::where('id', '!=', $id)->latest()->where('parent_id', '=', 0)->get();
        return view('category.index', compact('categories', 'parent_categories','category'));
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
            'title' => 'required|unique:categories,title,'.$id.'|min:3'
        ]);

        try {
            DB::beginTransaction();

            // dd($request->input());
            $category = Category::find($id);
            $category->title = $request->input('title');
            if ($request->has('parent')) {
                $category->parent_id = $request->input('parent');
            } else {
                $category->parent_id = 0;
            }
            $category->save();

            DB::commit();

            alert()->success('Category Updated', 'Category Updated Successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('Category Not Updated', 'Error Occured Please try again ' . $ex->getMessage());
        }

        return redirect(url('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $message="";

            $category = Category::find($id);
            if ($category->sub_categories()->get()->count() > 0) {
                
                $message = " also disabled ". $category->sub_categories()->get()->count().' sub-categories of '.$category->title.' ';

                $category->sub_categories()->delete();
            }
            $category->delete();

            alert()->success('Category Disabled', 'Category Disabled successfully'.$message.'. Go to Trash Bin > Categories to enable or permanently delete');

            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
        }
        return redirect()->back();
    }
}
