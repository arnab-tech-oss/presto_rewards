<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function index()
    {
 
        $id = auth()->user()->id;
        $users = User::with('address')->where('id',$id)->get();
        // $user_address= UserAddress::all();
        return view('admin.adminprofile.admindetails', compact('users'));
    }


    public function edit($id)
    {
        $admin=User::where('id',$id)->first();
        $adminusers=UserAddress::where('user_id',$id)->first();
        return view('admin.adminprofile.adminedit', compact('admin','adminusers'));
    }
    public function update(Request $request, $id)
    {
         $admin_update=User::where('id',$id)->first();
         $admin_update->full_name=$request->admin_name;
         $admin_update->phone=$request->phone;
         $admin_update->password= Hash::make($request->password);
         $admin_update->update($admin_update->toarray());

         UserAddress::where('user_id',$id)->update([
            'address_1' => $request->address_1,
            'state' => $request->state,
            'district' => $request->district,
            'postal_code' => $request->pin,
        ]);
        //  $adminuser->update($adminuser->toarray());
         return redirect()->route('admin.view.index')->with('update','update successfully');
    }
    
  
}
