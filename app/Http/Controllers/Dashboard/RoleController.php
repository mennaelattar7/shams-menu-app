<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\RoleRequest;
use App\Models\Department;
use App\Models\DepartmentPosition;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::select(
                            'id',
                            'name',
                            'display_name_en',
                            'display_name_ar',
                            'guard_name'
                    );
            if ($request->search_btn_value == 'pressed') {
                if (! is_null($request->name)) {
                    $roles = $roles->where('name',$request->name);
                }
            }
            return Datatables::of($roles)
                    ->addColumn('name', function (Role $role) {
                        if(app()->getLocale() == "en")
                        {
                            return $role->display_name_en ;
                        }
                        else
                        {
                            return $role->display_name_ar ;
                        }

                    })
                    ->addColumn('guard_name', function (Role $role) {
                        return $role->guard_name;
                    })
                    ->addColumn('action', function (Role $role) {
                        $array_data = [
                            'id' => $role->id ,
                            'name' => $role->name,
                          ];
                        return $array_data ;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('Dashboard.Role.All_Items.index');
    }
    public function create($locale,$context_url,Request $request)
    {
        $locale = app()->getLocale();
        return $this->edit($locale,$context_url, new Role(),$request);
    }
    public function store($locale,$context_url,RoleRequest $request)
    {
        $locale = app()->getLocale();
        $new_role = new Role();
        $new_role->setAttribute('guard_name','web');
        return $this->update($locale, $context_url,$request, $new_role);
    }
    public function show($locale, Role $role,Request $request)
    {
        return view('Dashboard.Role.Single_Item.index',compact('role'));
    }
    public function edit($locale, Role $role,Request $request)
    {
        $products_permissions =  Permission::where('name', 'like','5_'.'%product%')->get();
        $branchs_permissions =  Permission::where('name', 'like','6_'.'%branch%')->get();
        $vendor___menu_category_permissions =Permission::where('name', 'like','7_'.'%vendor___menu_category%')->get();
        $vendors_permissions =Permission::where('name', 'like','8_'.'%vendor%')->get();

        $permission_permissions =  Permission::where('name', 'like','3_'.'%permission%')->get();
        $role_permissions =  Permission::where('name', 'like','2_'.'%role%')->get();
        $user_permissions =  Permission::where('name', 'like','1_'.'%user%')->get();
        return view('Dashboard.Role.Form.index',compact(
            'role',
            'products_permissions',
            'branchs_permissions',
            'vendor___menu_category_permissions',
            'vendors_permissions',

            'permission_permissions',
            'role_permissions',
            'user_permissions'
        ));
    }
    public function update($locale, RoleRequest $request, Role $role)
    {
        $request->insert_update($request,$role);
        if(!$request->ajax())
        {
            $success_msg_status = '';
            if (str_contains(url()->current(), 'store')) {
                $success_msg_status = trans('Dashboard.Has_Been_Created_By');
            } else {
                $success_msg_status = trans('Dashboard.Has_Been_Updated_By');
            }

            return Redirect::route('dashboard.role.edit', ['locale' => app()->getLocale(),'role'=>$role])
                  ->with('success_msg', trans('Dashboard.Role').' '.$success_msg_status.' '.Auth::user()->first_name.' '.Auth::user()->last_name);
        }
        else
        {
            return response()->json([
                'status' => true,
                'message' => 'done',
            ]);
        }
    }
    public function destroy($locale, $role)
    {
        if ($role = Role::findOrFail($role)) {
            $role->deleted_by_id = Auth::user()->id;
            $role->save();
            $role->delete();

            return Redirect::route('dashboard.role.index', ['locale' => app()->getLocale()]);
        }

        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
    public function restore($locale, $role)
    {
        if ($role = Role::withTrashed()->findOrFail($role)) {
            $role->deleted_by_id = null;
            $role->save();
            $role->restore();
            return Redirect::route('dashboard.role.index', ['locale' => app()->getLocale()]);
        }
        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
    public function destroyPermanently($locale, $role)
    {
        if ($role = Role::withTrashed()->findOrFail($role)) {
            $role->forceDelete();
            return Redirect::route('dashboard.role.index', ['locale' => app()->getLocale()]);
        }

        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }

    //Ajax Requests
    public function ajaxNewRole(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'role_name' => 'required|string|unique:roles,name',
            'department_id' =>'nullable'
        ],
        [
            'role_name.required' => trans('Dashboard.Please_Enter_Name'),
            'role_name.unique' => trans('Dashboard.This_Role_Already_Exist'),
            'role_name.string' => trans('Dashboard.Value_Must_Be_String'),
        ]);

        if($validated->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validated->errors()
            ]);
        }
        else
        {
            $new_role = new Role();
            $new_role->department_id = $request->department_id;
            $new_role->name = implode("_",explode(" ",$request->role_name));
            $new_role->display_name = ucwords(implode(" ",explode(" ",$request->role_name))," ");
            $new_role->save();
            return response()->json([
                'status' => true,
                'message' => 'done',
            ]);
        }
    }
}
