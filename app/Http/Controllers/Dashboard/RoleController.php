<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentPosition;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Role\RoleRequest;
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
    public function show($locale,$context_url, Role $role,Request $request)
    {
        return view('Dashboard.Role.Single_Item.index',compact('role'));
    }
    public function edit($locale,$context_url, Role $role,Request $request)
    {
        $services_permissions =  Permission::where('name', 'like','4_'.'%service%')->get();
        $projects_permissions =  Permission::where('name', 'like','5_'.'%project%')->get();
        $departments_permissions =  Permission::where('name', 'like','6_'.'%department%')->get();
        $request_statuses_permissions =  Permission::where('name', 'like','7_'.'%request_status%')->get();
        $request_types_permissions =  Permission::where('name', 'like','8_'.'%request_type%')->get();
        $project_features_permissions =  Permission::where('name', 'like','9_'.'%project_feature%')->get();
        $customer_requests_permissions =  Permission::where('name', 'like','10_'.'%customer_request%')->get();
        $strategic_goals_permissions =  Permission::where('name', 'like','11_'.'%evaluation_strategic_goal%')->get();
        $operational_goals_permissions = Permission::where('name', 'like','12_'.'%evaluation_operational_goal%')->get();
        $initiatives_permissions = Permission::where('name', 'like','13_'.'%evaluation_initiative%')->get();
        $tasks_definitions_permissions = Permission::where('name', 'like','14_'.'%evaluation_task_definition%')->get();
        $quarters_permissions = Permission::where('name', 'like','15_'.'%quarter%')->get();
        $employees_permissions = Permission::where('name', 'like','16_'.'%employee%')->get();
        $task_details_permissions = Permission::where('name', 'like','17_'.'%task_detail%')->get();
        $positions_permissions =  Permission::where('name', 'like','18_'.'%position%')->get();
        $instProjectPlan_custReq___stages_permissions =  Permission::where('name', 'like','19_'.'%instProjectPlan_custReq___stage%')->get();
        $instProjectPlan_custReq___phases_permissions =  Permission::where('name', 'like','20_'.'%instProjectPlan_custReq___phase%')->get();
        $instProjectPlan_custReq___main_tasks_permissions =  Permission::where('name', 'like','21_'.'%instProjectPlan_custReq___main_task%')->get();
        $instProjectPlan_custReq___sub_tasks_permissions =  Permission::where('name', 'like','22_'.'%instProjectPlan_custReq___sub_task%')->get();
        $instProjectPlan_custReq___dependent_sub_tasks_permissions =  Permission::where('name', 'like','56_'.'%instProjectPlan_custReq___dependent_sub_task%')->get();
        $customer_request_places_permissions = Permission::where('name', 'like','23_'.'%customer_request_place%')->get();
        $instProjectPlan_custReq___main_task_responsibles_permissions =  Permission::where('name', 'like','24_'.'%instProjectPlan_custReq___main_task_responsible%')->get();
        $required_data_types_permissions =  Permission::where('name', 'like','25_'.'%required_data_type%')->get();
        $operations_permissions = Permission::where('name', 'like','26_'.'%operation%')->get();
        $task_operations_permissions = Permission::where('name', 'like','27_'.'%task_operation%')->get();
        $why_kazas_permissions =  Permission::where('name', 'like','28_'.'%why_kaza%')->get();
        $place_activities_permissions =  Permission::where('name', 'like','29_'.'%place_activity%')->get();
        $contact_us_messages_permissions =  Permission::where('name', 'like','30_'.'%contact_us_message%')->get();
        $customer_request_evaluations_permissions =  Permission::where('name', 'like','43_'.'%customer_request_evaluation%')->get();
        $product_categories_permissions =  Permission::where('name', 'like','44_'.'%product_category%')->get();
        $product_brands_permissions =  Permission::where('name', 'like','45_'.'%product_brand%')->get();
        $logistic_specializations_permissions =  Permission::where('name', 'like','46_'.'%logistic_specialization%')->get();
        $store___home_sliders_permissions =  Permission::where('name', 'like','48_'.'%store___home_slider%')->get();
        $store___warranty_types_permissions =  Permission::where('name', 'like','49_'.'%store___warranty_type%')->get();
        $store___features_permissions =  Permission::where('name', 'like','50_'.'%store___feature%')->get();
        $store___products_permissions =  Permission::where('name', 'like','51_'.'%store___product%')->get();
        $store___product_variants_permissions =  Permission::where('name', 'like','52_'.'%store___product_variant%')->get();
        $store___product_variant__medias_permissions =  Permission::where('name', 'like','53_'.'%store___product_variant__media%')->get();
        $risks_permissions =  Permission::where('name', 'like','54_'.'%risk%')->get();
        $resources_permissions =  Permission::where('name', 'like','55_'.'%resource%')->get();
        $real_execution_phases_permissions =  Permission::where('name', 'like','57_'.'%real_execution_phase%')->get();

        $maintMap_custReq___price_offers_permissions =  Permission::where('name', 'like','40_'.'%maintMap_custReq___price_offer%')->get();
        $maintMap_custReq___visits_permissions =  Permission::where('name', 'like','41_'.'%maintMap_custReq___visit%')->get();
        $maintMap_custReq___task_employees_permissions =  Permission::where('name', 'like','47_'.'%maintMap_custReq___task_employee%')->get();
        $maintMap_custReq___employees_permissions =  Permission::where('name', 'like','42_'.'%maintMap_custReq___employee%')->get();




        $permission_permissions =  Permission::where('name', 'like','3_'.'%permission%')->get();
        $role_permissions =  Permission::where('name', 'like','2_'.'%role%')->get();
        $user_permissions =  Permission::where('name', 'like','1_'.'%user%')->get();
        return view('Dashboard.Role.Form.index',compact(
            'role',
            'services_permissions',
            'projects_permissions',
            'departments_permissions',
            'request_statuses_permissions',
            'request_types_permissions',
            'project_features_permissions',
            'customer_requests_permissions',
            'strategic_goals_permissions',
            'operational_goals_permissions',
            'initiatives_permissions',
            'tasks_definitions_permissions',
            'quarters_permissions',
            'employees_permissions',
            'task_details_permissions',
            'positions_permissions',
            'instProjectPlan_custReq___stages_permissions',
            'instProjectPlan_custReq___phases_permissions',
            'instProjectPlan_custReq___main_tasks_permissions',
            'instProjectPlan_custReq___sub_tasks_permissions',
            'instProjectPlan_custReq___dependent_sub_tasks_permissions',
            'customer_request_places_permissions',
            'instProjectPlan_custReq___main_task_responsibles_permissions',
            'required_data_types_permissions',
            'operations_permissions',
            'task_operations_permissions',
            'why_kazas_permissions',
            'product_categories_permissions',
            'product_brands_permissions',
            'place_activities_permissions',
            'contact_us_messages_permissions',
            'customer_request_evaluations_permissions',
            'maintMap_custReq___price_offers_permissions',
            'maintMap_custReq___employees_permissions',
            'maintMap_custReq___visits_permissions',
            'maintMap_custReq___task_employees_permissions',
            'logistic_specializations_permissions',
            'store___home_sliders_permissions',
            'store___warranty_types_permissions',
            'store___features_permissions',
            'store___product_variant__medias_permissions',
            'store___products_permissions',
            'store___product_variants_permissions',
            'risks_permissions',
            'resources_permissions',
            'real_execution_phases_permissions',

            'permission_permissions',
            'role_permissions',
            'user_permissions'
        ));
    }
    public function update($locale,$context_url, RoleRequest $request, Role $role)
    {
        if (Route::currentRouteName() == 'dashboard.main_dashboard.role.update') {

            $request->insert_update($request,$role);
        }
        else
        {
            $request->insert_update($request,$role);
        }

        if(!$request->ajax())
        {
            $success_msg_status = '';
            if (str_contains(url()->current(), 'store')) {
                $success_msg_status = trans('Dashboard.Has_Been_Created_By');
            } else {
                $success_msg_status = trans('Dashboard.Has_Been_Updated_By');
            }

            return Redirect::route('dashboard.main_dashboard.role.edit', ['locale' => app()->getLocale(),'role'=>$role,'context_url'=>$context_url])
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

            return Redirect::route('dashboard.main_dashboard.role.index', ['locale' => app()->getLocale()]);
        }

        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
    public function restore($locale, $role)
    {
        if ($role = Role::withTrashed()->findOrFail($role)) {
            $role->deleted_by_id = null;
            $role->save();
            $role->restore();
            return Redirect::route('dashboard.main_dashboard.role.index', ['locale' => app()->getLocale()]);
        }
        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
    public function destroyPermanently($locale, $role)
    {
        if ($role = Role::withTrashed()->findOrFail($role)) {
            $role->forceDelete();
            return Redirect::route('dashboard.main_dashboard.role.index', ['locale' => app()->getLocale()]);
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
