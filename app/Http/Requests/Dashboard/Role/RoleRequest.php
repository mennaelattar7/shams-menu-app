<?php

namespace App\Http\Requests\Dashboard\Role;

use App\Models\DepartmentPosition;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function prepareForValidation()
    {
        // ضيفي أي attribute هنا
        $this->merge([
            'name' => str_replace(' ', '_', strtolower($this->display_name_en))
        ]);
    }
    public function rules()
    {
        if(Route::currentRouteName() == "dashboard.main_dashboard.role.store")
        {
            return [
                'display_name_en' => 'required',
                'display_name_ar' => 'required',
                'name' => 'sometimes|required|string|unique:roles,name|regex:/^\S*$/u',
                'type' => 'required'
                // 'display_name' => 'required|string|unique:roles,display_name',
                // 'department_id' =>'nullable'
            ];
        }
        else
        {
            return [
                'display_name_en' =>[
                    'required',
                ] ,
                'display_name_ar' =>[
                    'required',
                ] ,
                'name' =>[
                    'sometimes',
                    'required',
                    'string',
                    'unique:roles,name,'.$this->role->id,
                    'regex:/^\S*$/u'
                ] ,
                'type' => 'required'
            ];
        }
    }



    public function messages()
    {
        return[
            'role_display_name_en.required' => trans('Dashboard.Please_Enter_Name_of_Role_In_English'),
            'role_display_name_ar.required' => trans('Dashboard.Please_Enter_Name_of_Role_In_Arabic'),
        ];
    }

    public function insert_update($request,$role)
    {
        $role->name = $this->name;
        $role->display_name_en = $this->display_name_en;
        $role->display_name_ar = $this->display_name_ar;
        $role->type = $this->type;
        $role->save();
        //assign permissions
        $permissions_name_array = [];
        if($this->permission_ids != null)
        {
            for ($i=0; $i < count($this->permission_ids) ; $i++)
            {
                $permission = Permission::find($this->permission_ids[$i]);
                if($role->type =="vendor_employee")
                {
                    $permission->is_vendor = true;
                    $permission->save();
                }
                array_push($permissions_name_array,$permission->name);
            }
        }
        $role->syncPermissions($permissions_name_array);
    }
}
