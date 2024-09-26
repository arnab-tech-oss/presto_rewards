<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAddress;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Console\Migrations\BaseCommand;

class UsermanagementController extends Controller
{

  public function role(Request $request)
  {
    //$roles = Role::get();
    //return view ('admin.usermanagement.roleindex',compact('roles'));
    if ($request->ajax()) {
       $data = Role::latest();
      return datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          if ($row->role_name != 'admin' && $row->role_name != 'customer' && $row->role_name != 'technician' && $row->role_name != 'distributors' && $row->role_name != 'wholesaler' && $row->role_name != 'retailer') {
            $actionBtn = view('admin.usermanagement.button1',['item' => $row, 'page' => $this->page]);
            return $actionBtn;
        }
    })
    ->rawColumns(['action'])
    ->make(true);
    }
    return view('admin.usermanagement.roleindex');

  }

  public function addrole()
    {

      return view('admin.usermanagement.addrole',);
    }

    public function postrole(Request $request)
    {

      $validateData = Validator::make($request->all(),[
          'role_name' => 'required',
          'description' => 'required',
        ]);

        if($validateData->fails()){
          return redirect()->back()->withErrors($validateData)->withInput();
        }else{

          $id = auth()->id();

          $entity = new Role();

        $entity->role_name = $request->role_name;
        $entity->description = $request->description;
        $entity->created_by = $id;
        $entity->save();

        if ($entity->save()) {

          return redirect()->route('admin.role')->with('roll_success', 'Role Added Successfully');
        } else {
          return redirect()->back()->with('roll_failure', 'Some thing went Worong');
        }
      }
    }

    public function viewrole($id)
    {
      $user = Role::where('id', $id)->first();
      return view('admin.usermanagement.roleview', compact('user'));
    }

    public function editrole($id)
    {
      $edit_user = Role::where('id', $id)->first();
      return view('admin.usermanagement.roleedit', compact('edit_user'));
    }

    public function updaterole(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $role_update = Role::where('id', $id)->first();

            $role_update->role_name = $request->name;
            $role_update->description = $request->description;


            if ($role_update->update()) {
                return redirect()->route('admin.company')->with('update_success', 'Company Update Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update company.');
            }
        }
    }


    public function deleterole($id)
    {
      $data = Role::where('id', $id)->first();

      if (!$data) {
          return response()->json(['error' => 'Record not found'], 404);
      }
      else
      {
          $data->delete();
          return response()->json(['message' => 'Record delete successfully']);
      }
    }

    // public function deleterole($id)
    // {
    //   Role::where('id',$id)->delete();
    //   return redirect()->route('admin.usermanagement')->with('roll_delete', 'Roll delete Successfully');
    // }

    public $page = 'User';
    public function usermanagement(Request $request)
    {

      if ($request->ajax()) {
        $data = User::with('role')->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = view('admin.usermanagement.button', ['item' => $row, 'page' => $this->page]);
                return $actionBtn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    return view('admin.usermanagement.userindex');

    }

    public function adduser()
    {

      $roles = Role::get();
      $companies = Company::get();
      return view('admin.usermanagement.adduser',compact('roles','companies'));
    }

    public function userpost(Request $request)
    {
        $validateData = Validator::make($request->all(),[
          'full_name' => 'required',
          'email_id' => 'required|email|unique:users,email',
          'phone_number' => 'required',
          'password' => 'required',
          'role' => 'required',
          'address_1' => 'required',
          // 'state' => 'required',
          // 'district' => 'required',
          // 'postal_code' => 'required',
        ]);


        if($validateData->fails()){
          return redirect()->back()->withErrors($validateData)->withInput();
        }else{

        $entity = new User();
        $entity->full_name = $request->full_name;
        $entity->email = $request->email_id;
        $entity->phone = $request->phone_number;
        $entity->password = Hash::make($request->password);
        $entity->user_type = 'user';
        $entity->role_id = $request->role;
        // $entity->company_id = $request->company_id;
        $entity->save();


          if($entity->save()){

            $id = $entity->id;  // Get the ID of the newly created user

            $data = new UserAddress();
            $data->user_id = $id;
            $data->address_1 = $request->address_1;
            // $data->address_2 = $request->address_2;
            // $data->state = $request->state;
            // $data->district = $request->district;
            // $data->postal_code = $request->postal_code;
            $data->save();
          }

        if ($data->save()) {
          return redirect()->route('admin.usermanagement')->with('adduser', 'User Added Successfully');
        } else {
          return redirect()->back()->with('failure', 'Something Went Worng');
        }
    }
    }

    public function userview($id)
    {
      $user = User::with('role','company','address')->where('id', $id)->first();
      //return $user;
     return view ('admin.usermanagement.userview', compact('user'));
    }

    public function useredit($id)
    {
      $user = User::with('address')->where('id',$id)->first();
      return view('admin.usermanagement.edituser', compact('user'));
    }

    public function userupdate(Request $request, $id)
    {
      $validateData = Validator::make($request->all(),[
        'phone' => 'sometimes|digits:10',
      ]);

      if($validateData->fails()){
        return redirect()->back()->withErrors($validateData)->withInput();
      }else{



          User::where('id',$id)->update([
          'phone' => $request->phone,

        ]);
        UserAddress::where('user_id',$id)->update([
          'address_1' => $request->address_1,
          'address_2' => $request->address_2,
          'state' => $request->state,
          'district' => $request->district,
          'postal_code' => $request->postal_code,

        ]);
        // $user_update = User::with('address')->where('id', $id)->first();
        // $user_update->phone = $request->phone;
        // $user_update->address->address_1 = $request->address_1;
        // $user_update->address->address_2 = $request->address_2;
        // $user_update->address->district = $request->district;
        // $user_update->address->postal_code = $request->postal_code;
        // $user_update->update($user_update->toArray());


        // if ($user_update->update()){
        //   return redirect()->route('admin.usermanagement')->with('update_success','Update Successfull');
        // }else{
        //   return redirect()->back()->with('update_failed','Some thing went wrong');
        // }


      }

      return redirect()->route('admin.usermanagement');

    }
  }
    //*** this code use for user delete or deactivate.....

    // public function inactiuser($id)
    // {
    //     $productcatalog = User::where('id', $id)->first();
    //   if ($productcatalog->status=='active')
    //   {
    //     $productcatalog->status = 'inactive';
    //     $productcatalog->save();
    //   }else{
    //     $productcatalog->status = 'active';
    //     $productcatalog->save();
    //   }
    //   return redirect()->route('admin.offer');
    // }



