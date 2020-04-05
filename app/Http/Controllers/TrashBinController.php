<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flavour;
use App\Size;
use App\User;
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

    /**
     *  Portal User Trash
     * 
     */
    public function get_portal_user_trash()
    {
        $users = User::onlyTrashed()->latest()->get();

        return view('trash_bin.portal_user', compact('users'));
    }
    public function restore_portal_user($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $user = User::onlyTrashed()->find($id);
            $user->restore();

            DB::commit();
            alert()->success('User Restored', 'User restored successfully');
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }
    public function delete_portal_user($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $user = User::onlyTrashed()->find($id);
            $user->forceDelete();

            alert()->success('User Deleted Permanently', 'User deleted permanently');

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }

    /**
     *  Category Trash
     * 
     */
    public function get_category_trash()
    {
        $categories = Category::onlyTrashed()->latest()->get();

        return view('trash_bin.category', compact('categories'));
    }
    public function restore_category($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $category = Category::onlyTrashed()->find($id);
            if ($category->parent_category()->onlyTrashed()->first()) {
                alert()->error('Error','Please enable Parent Category "'.$category->parent_category()->onlyTrashed()->first()->title.'" to enable this category');

                return redirect()->back();
            }
            $category->restore();

            DB::commit();
            alert()->success('Category Restored', 'Category restored successfully');
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }
    public function delete_category($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $category = Category::withTrashed()->find($id);
            if ($category->sub_categories()->withTrashed()->first()) {
                alert()->error('Error', 'Please remove all "'. $category->sub_categories()->withTrashed()->get()->count().'" Sub-Categories of this category to remove this category permanently');

                return redirect()->back();
            }
            $category->forceDelete();

            DB::commit();
            alert()->success('Category Deleted', 'Category Deleted successfully');
        } catch (\Exception $ex) {
            DB::rollBack();

            alert()->error('Error Occured', $ex->getMessage());
        }
        return redirect()->back();
    }
}
