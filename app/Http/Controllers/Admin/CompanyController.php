<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Admin\BaseController;

class CompanyController extends Controller
{
    public $page = 'Company';
    public function company(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::latest('created_at');
            return datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';

                    return '<div class="form-check form-switch form-switch-md mb-2">
                    <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onchange="changeStatus(\'' . route('company.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                                <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                            </div>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.companymanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.companymanagement.companyindex');
    }

    public function status($id)
    {
        $status = Company::where('id', $id)->first();

        if ($status->status == "active") {
            Company::where('id', $id)->update(['status' => 'inactive']);
            return "InActive";
        } else {
            Company::where('id', $id)->update(['status' => 'active']);
            return "Active";
        }
    }

    public function view($id)
    {
        $company = Company::where('id', $id)->first();
        return view('admin.companymanagement.companyview', compact('company'));
    }

    public function edit($id)
    {
        $company = Company::where('id', $id)->first();
        return view('admin.companymanagement.editcompany', compact('company'));
    }

    public function companyupdate(Request $request, $id)
    {
        $imageName = null;

        $userid = auth()->id();

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'brand_title' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes() && $request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/company'), $imageName);
            }

            $fullPath = 'images/company/' . $imageName;

            $company_update = Company::where('id', $id)->first();

            $company_update->brand_title = $request->brand_title;
            $company_update->company_name = $request->brand_name;
            $company_update->company_address = $request->company_address;
            $company_update->bank_name = $request->bank_name;
            $company_update->bank_acc_number  = $request->bank_acc_number;
            $company_update->bank_ifsc = $request->bank_ifsc;
            $company_update->gstin  = $request->gstin;
            $company_update->status  = $request->status;
            if ($imageName !== null) {
                $company_update->logo = $fullPath;
            }
            $company_update->updated_by = $userid;
            $company_update->update($company_update->toArray());

            if ($company_update->update()) {
                return redirect()->route('admin.company')->with('update_success', 'Company Update Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update company.');
            }
        }
    }

    public function addcompany()
    {
        return view('admin.companymanagement.addcompany');
    }

    public function companypost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'company_name' => 'required',
            'brand_title' => 'required',
            // 'company_address' => 'required',
            // 'bank_name' => 'required',
            // 'bank_acc_number' => 'required|unique:companies,bank_acc_number',
            // 'bank_ifsc' => 'required',
            // 'gstin' => 'required|unique:companies,gstin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $id = auth()->id();

            // $imageName = time() . '.' . $request->image->extension();
            // $request->image->move(public_path('images/company'), $imageName);
            // $fullPath = 'images/company/' . $imageName;


            $entity = new Company();
            $entity->company_name  = $request->company_name;
            $entity->brand_title = $request->brand_title;
            $entity->company_address = $request->company_address;
            $entity->bank_name = $request->bank_name;
            $entity->bank_acc_number = $request->bank_acc_number;
            $entity->bank_ifsc = $request->bank_ifsc;
            $entity->gstin = $request->gstin;
            // $entity->logo = $fullPath;
            $entity->created_by = $id;
            $entity->save();

            if ($entity->save()) {
                return redirect()->route('admin.company')->with('success', "Company Added successfully");
            } else {
                return response()->back()->with('failure', "Something went wrong");
            }
        }
    }

    function deletecompany ($id)
    {
        $data = Company::where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Record not found'], 404);
        }
        else
        {
            $data->delete();
            return response()->json(['message' => 'Record delete successfully']);
        }
    }

    public function serachproduct($id)
    {
        $data = Company::where('id', $id)->first();
        return $data;
    }

}
