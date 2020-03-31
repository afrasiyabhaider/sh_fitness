<?php

namespace App\Http\Controllers;

use App\Flavour;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrashBinController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     *  Sizes Trash
     * 
     */
    public function get_size_trash()
    {
        $sizes = Size::onlyTrashed()->latest()->get();

        return view('trash_bin.sizes', compact('sizes'));
    }
    public function restore_size($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $size = Size::onlyTrashed()->find($id);
            $size->restore();

            DB::commit();
            alert()->success('Size Restored', 'Size restored successfully');
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }
    public function delete_size($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $size = Size::onlyTrashed()->find($id);
            $size->forceDelete();

            alert()->success('Size Deleted Permanently', 'Size deleted permanently');

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }

    /**
     *  Flavours Trash
     * 
     */
    public function get_flavour_trash()
    {
        $flavours = Flavour::onlyTrashed()->latest()->get();

        return view('trash_bin.flavours', compact('flavours'));
    }
    public function restore_flavour($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $flavour = Flavour::onlyTrashed()->find($id);
            $flavour->restore();

            DB::commit();
            alert()->success('Flavour Restored', 'Flavour restored successfully');
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }
    public function delete_flavour($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $flavour = Flavour::onlyTrashed()->find($id);
            $flavour->forceDelete();

            alert()->success('Flavour Deleted Permanently', 'Flavour deleted permanently');

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }
}
