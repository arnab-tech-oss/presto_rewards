<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Role;
use Yajra\DataTables\DataTables;

class OfferController extends Controller
{
  public $page = 'offer';

  public function offer(Request $request)
  {

    if ($request->ajax()) {
      $data = Offer::latest('created_at');
      return datatables::of($data)
        ->addIndexColumn()
        ->addColumn('status', function ($row) {
          $checked = $row->status == 'active' ? 'checked' : '';

          return '<div class="form-check form-switch form-switch-md mb-2">
                            <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('offer.inactive', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                            <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                        </div>';
        })
        ->addColumn('action', function ($row) {
          $actionBtn = view('admin.offermanagement.button', ['item' => $row, 'page' => $this->page]);
          return $actionBtn;
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }
    return view('admin.offermanagement.offerindex');
  }



  public function addoffer()
  {
    $roles = Role::where('role_name', '!=', 'admin')->get();
    return view('admin.offermanagement.addoffer', compact('roles'));
  }

  public function offerpost(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      'start_date' => 'required',
      'end_date' => 'required',
      'cta_type' => 'required',
      // 'action_link' => 'required|url',
    ]);

    $fullPath2 = null;

    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images/banner'), $imageName);
    $fullPath = 'images/banner/' . $imageName;
    if ($request->hasFile('big_image')) {
      $imageName2 = time() . '.' . $request->file('big_image')->extension();
      $request->big_image->move(public_path('images/banner'), $imageName2);
      $fullPath2 = 'images/banner/' . $imageName2;
    }

    // $cta_type = $request->cta_type;
    // if($cta_type == 'link'){
    //   $link = 'http://'.$request->action_link;
    // }

    $entity = new Offer();
    $entity->title = $request->title;
    $entity->description = $request->description;
    $entity->status = 'active';
    $entity->baner = $fullPath;
    $entity->start_date = $request->start_date;
    $entity->end_date = $request->end_date;
    $entity->cta_type = $request->cta_type;
    $entity->action_link = $request->action_link;
    $entity->big_image = $fullPath2;
    $entity->role_id = $request->role_id ?: null;
    $entity->save();

    return redirect()->route('admin.offer')->with('success', 'offer added successfully');
  }

  public function inactiveoffer($id)
  {
    $productcatalog = Offer::where('id', $id)->first();
    if ($productcatalog->status == 'active') {
      $productcatalog->status = 'inactive';
      $productcatalog->save();
    } else {
      $productcatalog->status = 'active';
      $productcatalog->save();
    }
    return redirect()->route('admin.offer');
  }

  public function offeredit($id)
  {

    $offeredit = Offer::where('id', $id)->first();
    return view('admin.offermanagement.offeredit', compact('offeredit'));
  }

  public function offerview($id)
  {
    $view_offer = Offer::where('id', $id)->first();
    return view('admin.offermanagement.viewoffer', compact('view_offer'));
  }

  public function update(Request $request, $id)
  {
    $imageName = null;
    $validator = Validator::make($request->all(), [
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    if ($validator->passes() && $request->hasFile('image')) {
      $imageName = time() . '.' . $request->image->extension();
      $request->image->move(public_path('images/banner'), $imageName);
    }
    $fullPath = 'images/banner/' . $imageName;

    $offerupdate = Offer::where('id', $id)->first();
    $offerupdate->title = $request->title;
    $offerupdate->description = $request->description;
    if ($imageName !== null) {
      $offerupdate->baner = $fullPath;
    }
    $offerupdate->start_date = $request->start_date;
    $offerupdate->end_date = $request->end_date;
    $offerupdate->update($offerupdate->toarray());
    return redirect()->route('admin.offer')->with('update', 'update successfully');
  }
}
