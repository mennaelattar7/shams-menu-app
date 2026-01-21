<div class="card-header" data-toggle="collapse" href="#main_info_section" aria-expanded="true" style="font-size: 20px;background-color: #006AA5;color: white;padding: 20px;padding: 20px !important;">
    <a class="card-title">
        {{ trans('Dashboard.Main_Info')}}
    </a>
</div>
<div id="main_info_section" class="card-body collapse show" data-parent="#accordion" >
    <div class="panel-body">
        <div class="row">
            <!-- display_name_en -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="basic-url"
                        @if($errors->has('display_name_en'))
                            style="color: red"
                        @endif
                    >
                        {{ trans('Dashboard.Name')}} ({{ trans('Dashboard.EN') }})
                        <span class="required-element"> * </span>
                    </label>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-pencil"></i>
                            </span>
                        </div>
                        <input type="text"
                                class="form-control"
                                id="display_name_en"
                                placeholder="{{ trans('Dashboard.Name')}} ({{ trans('Dashboard.EN') }})"
                                name="display_name_en"
                                autocomplete="off"
                                spellcheck="true"
                                aria-label="display_name_en"
                                aria-describedby="basic-addon1"
                                value="{{ old('display_name_en', $role->display_name_en) }}"
                                @if($errors->has('display_name_en'))
                                    style="border:1px solid red"
                                @endif
                                @if(Route::currentRouteName() == "dashboard.role.show")
                                    disabled
                                @endif
                        >
                    </div>
                    @if($errors->has('display_name_en'))
                        <p style="color: red">{{$errors->first('display_name_en')}}</p>
                    @endif
                </div>
            </div>
            <!-- display_name_ar -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="basic-url"
                        @if($errors->has('display_name_ar'))
                            style="color: red"
                        @endif
                    >
                        {{ trans('Dashboard.Name')}} ({{ trans('Dashboard.AR') }})
                        <span class="required-element"> * </span>
                    </label>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-pencil"></i>
                            </span>
                        </div>
                        <input type="text"
                                class="form-control"
                                id="display_name_ar"
                                placeholder="{{ trans('Dashboard.Name')}} ({{ trans('Dashboard.AR') }})"
                                name="display_name_ar"
                                autocomplete="off"
                                spellcheck="true"
                                aria-label="display_name_ar"
                                aria-describedby="basic-addon1"
                                value="{{ old('display_name_ar', $role->display_name_ar) }}"
                                @if($errors->has('display_name_ar'))
                                    style="border:1px solid red"
                                @endif
                                @if(Route::currentRouteName() == "dashboard.role.show")
                                    disabled
                                @endif
                        >
                    </div>
                    @if($errors->has('display_name_ar'))
                        <p style="color: red">{{$errors->first('display_name_ar')}}</p>
                    @endif
                </div>
            </div>
            <!--type-->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="basic-url"
                        @if($errors->has('type'))
                            style="color: red"
                        @endif
                    >
                        {{ trans('Dashboard.Role_Type')}} <span class="required-element"> * </span>
                    </label>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"
                                @if($errors->has('type'))
                                    style="border: 1px solid red;color:red"
                                @endif
                            >
                                <i class="fa fa-list-ul"></i>
                            </label>
                        </div>
                        <select class="custom-select" name="type" id="type"
                        @if($errors->has('type'))
                            style="border: 1px solid red"
                        @endif
                        >
                            <option value="">{{ trans('Dashboard.Choose_Role_Type')}}...</option>
                            <option value="employee"
                                @if(Session::get('type') == "employee")
                                    selected="selected"
                                @endif
                                @if($role->type == "employee")
                                        selected="selected"
                                @endif
                                @if(old('type') == "employee")
                                    selected="selected"
                                @endif
                            >
                                {{ trans(('Dashboard.Employee')) }}
                            </option>
                            <option value="user"
                                @if(Session::get('type') == "user")
                                    selected="selected"
                                @endif
                                @if($role->type == "user")
                                        selected="selected"
                                @endif
                                @if(old('type') == "user")
                                    selected="selected"
                                @endif
                            >
                                {{ trans(('Dashboard.User')) }}
                            </option>
                            <option value="general"
                                @if(Session::get('type') == "general")
                                    selected="selected"
                                @endif
                                @if($role->type == "general")
                                        selected="selected"
                                @endif
                                @if(old('type') == "general")
                                    selected="selected"
                                @endif
                            >
                                {{ trans(('Dashboard.General')) }}
                            </option>
                        </select>
                    </div>
                    @if($errors->has('type'))
                        <p style="color: red">{{$errors->first('type')}}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ trans('Dashboard.Permissions')}}<small></h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-5">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link show active" id="v-service-tab" data-toggle="pill" href="#v-service" role="tab" aria-controls="v-service" aria-selected="true">
                                        {{ trans('Dashboard.Services')}}
                                    </a>
                                    <a class="nav-link" id="v-task_operation-tab" data-toggle="pill" href="#v-task_operation" role="tab" aria-controls="v-task_operation" aria-selected="true">
                                        {{ trans('Dashboard.Tasks_Operations')}}
                                    </a>
                                    <a class="nav-link" id="v-project-tab" data-toggle="pill" href="#v-project" role="tab" aria-controls="v-project" aria-selected="true">
                                        {{ trans('Dashboard.Projects')}}
                                    </a>
                                    <a class="nav-link" id="v-project_feature-tab" data-toggle="pill" href="#v-project_feature" role="tab" aria-controls="v-project_feature" aria-selected="true">
                                        {{ trans('Dashboard.Project_Features')}}
                                    </a>
                                    <a class="nav-link" id="v-customer_request-tab" data-toggle="pill" href="#v-customer_request" role="tab" aria-controls="v-customer_request" aria-selected="true">
                                        {{ trans('Dashboard.Customer_Requests')}}
                                    </a>
                                    <a class="nav-link" id="v-department-tab" data-toggle="pill" href="#v-department" role="tab" aria-controls="v-department" aria-selected="true">
                                        {{ trans('Dashboard.Departments')}}
                                    </a>
                                    <a class="nav-link" id="v-request_status-tab" data-toggle="pill" href="#v-request_status" role="tab" aria-controls="v-request_status" aria-selected="true">
                                        {{ trans('Dashboard.Request_Statuses')}}
                                    </a>
                                    <a class="nav-link" id="v-request_type-tab" data-toggle="pill" href="#v-request_type" role="tab" aria-controls="v-request_type" aria-selected="true">
                                        {{ trans('Dashboard.request_types')}}
                                    </a>
                                    <a class="nav-link" id="v-strategic_goal-tab" data-toggle="pill" href="#v-strategic_goal" role="tab" aria-controls="v-strategic_goal" aria-selected="true">
                                        {{ trans('Dashboard.Strategic_Goals')}}
                                    </a>
                                    <a class="nav-link" id="v-operational_goal-tab" data-toggle="pill" href="#v-operational_goal" role="tab" aria-controls="v-operational_goal" aria-selected="true">
                                        {{ trans('Dashboard.Operational_Goals')}}
                                    </a>
                                    <a class="nav-link" id="v-initiative-tab" data-toggle="pill" href="#v-initiative" role="tab" aria-controls="v-initiative" aria-selected="true">
                                        {{ trans('Dashboard.Initiatives')}}
                                    </a>
                                    <a class="nav-link" id="v-evaluation_task_definition-tab" data-toggle="pill" href="#v-evaluation_task_definition" role="tab" aria-controls="v-evaluation_task_definition" aria-selected="true">
                                        {{ trans('Dashboard.Evaluation_Task_Definitions')}}
                                    </a>
                                    <a class="nav-link" id="v-quarter-tab" data-toggle="pill" href="#v-quarter" role="tab" aria-controls="v-quarter" aria-selected="true">
                                        {{ trans('Dashboard.Quarters')}}
                                    </a>
                                    <a class="nav-link" id="v-employee-tab" data-toggle="pill" href="#v-employee" role="tab" aria-controls="v-employee" aria-selected="true">
                                        {{ trans('Dashboard.Employees')}}
                                    </a>
                                    <a class="nav-link" id="v-task_detail-tab" data-toggle="pill" href="#v-task_detail" role="tab" aria-controls="v-task_detail" aria-selected="true">
                                        {{ trans('Dashboard.Task_Details')}}
                                    </a>
                                    <a class="nav-link" id="v-position-tab" data-toggle="pill" href="#v-position" role="tab" aria-controls="v-position" aria-selected="true">
                                        {{ trans('Dashboard.Positions')}}
                                    </a>
                                    <a class="nav-link" id="v-instProjectPlan_custReq___stage-tab" data-toggle="pill" href="#v-instProjectPlan_custReq___stage" role="tab" aria-controls="v-instProjectPlan_custReq___stage" aria-selected="true">
                                        {{ trans('Dashboard.Project_Customer_Request_Stages')}}
                                    </a>
                                    <a class="nav-link" id="v-instProjectPlan_custReq___phase-tab" data-toggle="pill" href="#v-instProjectPlan_custReq___phase" role="tab" aria-controls="v-instProjectPlan_custReq___phase" aria-selected="true">
                                        {{ trans('Dashboard.Project_Customer_Request_Phases')}}
                                    </a>
                                    <a class="nav-link" id="v-instProjectPlan_custReq___main_task-tab" data-toggle="pill" href="#v-instProjectPlan_custReq___main_task" role="tab" aria-controls="v-instProjectPlan_custReq___main_task" aria-selected="true">
                                        {{ trans('Dashboard.Project_Customer_Request_Main_Tasks')}}
                                    </a>
                                    <a class="nav-link" id="v-instProjectPlan_custReq___sub_task-tab" data-toggle="pill" href="#v-instProjectPlan_custReq___sub_task" role="tab" aria-controls="v-instProjectPlan_custReq___sub_task" aria-selected="true">
                                        {{ trans('Dashboard.Project_Customer_Request_Sub_Tasks')}}
                                    </a>
                                    <a class="nav-link" id="v-instProjectPlan_custReq___dependent_sub_task-tab" data-toggle="pill" href="#v-instProjectPlan_custReq___dependent_sub_task" role="tab" aria-controls="v-instProjectPlan_custReq___dependent_sub_task" aria-selected="true">
                                        {{ trans('Dashboard.Project_Customer_Request_Dependante_Sub_Tasks')}}
                                    </a>

                                    <a class="nav-link" id="v-risk-tab" data-toggle="pill" href="#v-risk" role="tab" aria-controls="v-risk" aria-selected="true">
                                        {{ trans('Dashboard.Risks')}}
                                    </a>
                                    <a class="nav-link" id="v-resource-tab" data-toggle="pill" href="#v-resource" role="tab" aria-controls="v-resource" aria-selected="true">
                                        {{ trans('Dashboard.resource')}}
                                    </a>
                                    <a class="nav-link" id="v-real_execution_phase-tab" data-toggle="pill" href="#v-real_execution_phase" role="tab" aria-controls="v-real_execution_phase" aria-selected="true">
                                        {{ trans('Dashboard.real_execution_phases')}}
                                    </a>
                                    <a class="nav-link" id="v-customer_request_place-tab" data-toggle="pill" href="#v-customer_request_place" role="tab" aria-controls="v-customer_request_place" aria-selected="true">
                                       jhkjbkjbk
                                    </a>
                                    <a class="nav-link" id="v-instProjectPlan_custReq___main_task_responsible-tab" data-toggle="pill" href="#v-instProjectPlan_custReq___main_task_responsible" role="tab" aria-controls="v-instProjectPlan_custReq___main_task_responsible" aria-selected="true">
                                        {{ trans('Dashboard.Main_Task_Responsibles')}}
                                    </a>
                                    <a class="nav-link" id="v-required_data_type-tab" data-toggle="pill" href="#v-required_data_type" role="tab" aria-controls="v-required_data_type" aria-selected="true">
                                        {{ trans('Dashboard.Required_Data_Type')}}
                                    </a>
                                    <a class="nav-link" id="v-operation-tab" data-toggle="pill" href="#v-operation" role="tab" aria-controls="v-operation" aria-selected="true">
                                        {{ trans('Dashboard.Operations') }}
                                    </a>

                                    <a class="nav-link" id="v-why_kaza-tab" data-toggle="pill" href="#v-why_kaza" role="tab" aria-controls="v-why_kaza" aria-selected="true">
                                        {{ trans('Dashboard.Why_Kaza')}}
                                    </a>

                                    <a class="nav-link" id="v-place_activity-tab" data-toggle="pill" href="#v-place_activity" role="tab" aria-controls="v-place_activity" aria-selected="true">
                                        {{ trans('Dashboard.place_activity')}}
                                    </a>
                                    <a class="nav-link" id="v-contact_us_message-tab" data-toggle="pill" href="#v-contact_us_message" role="tab" aria-controls="v-contact_us_message" aria-selected="true">
                                        {{ trans('Dashboard.contact_us_message')}}
                                    </a>
                                    <a class="nav-link" id="v-customer_request_evaluation-tab" data-toggle="pill" href="#v-customer_request_evaluation" role="tab" aria-controls="v-customer_request_evaluation" aria-selected="true">
                                        {{ trans('Dashboard.customer_request_evaluation')}}
                                    </a>

                                    <a class="nav-link" id="v-maintMap_custReq___price_offer-tab" data-toggle="pill" href="#v-maintMap_custReq___price_offer" role="tab" aria-controls="v-maintMap_custReq___price_offer" aria-selected="true">
                                        {{ trans('Dashboard.maintMap_custReq___price_offer')}}
                                    </a>
                                    <a class="nav-link" id="v-maintMap_custReq___visit-tab" data-toggle="pill" href="#v-maintMap_custReq___visit" role="tab" aria-controls="v-maintMap_custReq___visit" aria-selected="true">
                                        {{ trans('Dashboard.maintMap_custReq___visit')}}
                                    </a>
                                    <a class="nav-link" id="v-maintMap_custReq___task_employee-tab" data-toggle="pill" href="#v-maintMap_custReq___task_employee" role="tab" aria-controls="v-maintMap_custReq___task_employee" aria-selected="true">
                                        {{ trans('Dashboard.maintMap_custReq___task_employee')}}
                                    </a>
                                    <a class="nav-link" id="v-maintMap_custReq___employee-tab" data-toggle="pill" href="#v-maintMap_custReq___employee" role="tab" aria-controls="v-maintMap_custReq___employee" aria-selected="true">
                                        {{ trans('Dashboard.maintMap_custReq___employee')}}
                                    </a>
                                    <a class="nav-link" id="v-logistic_specialization-tab" data-toggle="pill" href="#v-logistic_specialization" role="tab" aria-controls="v-logistic_specialization" aria-selected="true">
                                        {{ trans('Dashboard.Logistic_Specializations')}}
                                    </a>
                                    <h6 class="mt-3 mb-1 text-muted">📌 عناصر المتجر</h6>
                                    <a class="nav-link" id="v-product_category-tab" data-toggle="pill" href="#v-product_category" role="tab" aria-controls="v-product_category" aria-selected="true">
                                        {{ trans('Dashboard.product_category')}}
                                    </a>
                                    <a class="nav-link" id="v-product_brand-tab" data-toggle="pill" href="#v-product_brand" role="tab" aria-controls="v-product_brand" aria-selected="true">
                                        {{ trans('Dashboard.product_brand')}}
                                    </a>
                                    <a class="nav-link" id="v-store___home_slider-tab" data-toggle="pill" href="#v-store___home_slider" role="tab" aria-controls="v-store___home_slider" aria-selected="true">
                                        {{ trans('Dashboard.store___home_sliders')}}
                                    </a>
                                    <a class="nav-link" id="v-store___warranty_type-tab" data-toggle="pill" href="#v-store___warranty_type" role="tab" aria-controls="v-store___warranty_type" aria-selected="true">
                                        {{ trans('Dashboard.store___warranty_types')}}
                                    </a>
                                    <a class="nav-link" id="v-store___feature-tab" data-toggle="pill" href="#v-store___feature" role="tab" aria-controls="v-store___feature" aria-selected="true">
                                        {{ trans('Dashboard.store___features')}}
                                    </a>
                                    <a class="nav-link" id="v-store___product_variant__media-tab" data-toggle="pill" href="#v-store___product_variant__media" role="tab" aria-controls="v-store___product_variant__media" aria-selected="true">
                                        {{ trans('Dashboard.store___product_variant__medias')}}
                                    </a>
                                    <a class="nav-link" id="v-store___product-tab" data-toggle="pill" href="#v-store___product" role="tab" aria-controls="v-store___product" aria-selected="true">
                                        {{ trans('Dashboard.store___products')}}
                                    </a>
                                    <a class="nav-link" id="v-store___product_variant-tab" data-toggle="pill" href="#v-store___product_variant" role="tab" aria-controls="v-store___product_variant" aria-selected="true">
                                        {{ trans('Dashboard.store___product_variants')}}
                                    </a>

                                    <h6 class="mt-3 mb-1 text-muted">📌 الصلاحيات و الادوار</h6>
                                    <a class="nav-link" id="v-permission-tab" data-toggle="pill" href="#v-permission" role="tab" aria-controls="v-permission" aria-selected="true">
                                        {{ trans('Dashboard.Permissions')  }}
                                    </a>
                                    <a class="nav-link" id="v-role-tab" data-toggle="pill" href="#v-role" role="tab" aria-controls="v-role" aria-selected="true">
                                        {{ trans('Dashboard.Roles')  }}
                                    </a>
                                    <a class="nav-link" id="v-user-tab" data-toggle="pill" href="#v-user" role="tab" aria-controls="v-user" aria-selected="true">
                                        {{ trans('Dashboard.Users')}}
                                    </a>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane active show" id="v-service" role="tabpanel" aria-labelledby="v-service-tab">
                                        @foreach($services_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-project" role="tabpanel" aria-labelledby="v-project-tab">
                                        @foreach($projects_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-project_feature" role="tabpanel" aria-labelledby="v-project_feature-tab">
                                        @foreach($project_features_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-project_feature" role="tabpanel" aria-labelledby="v-project_feature-tab">
                                        @foreach($project_features_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-customer_request" role="tabpanel" aria-labelledby="v-customer_request-tab">
                                        @foreach($customer_requests_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-department" role="tabpanel" aria-labelledby="v-department-tab">
                                        @foreach($departments_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-request_status" role="tabpanel" aria-labelledby="v-request_status-tab">
                                        @foreach($request_statuses_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-request_type" role="tabpanel" aria-labelledby="v-request_type-tab">
                                        @foreach($request_types_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-strategic_goal" role="tabpanel" aria-labelledby="v-strategic_goal-tab">
                                        @foreach($strategic_goals_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-operational_goal" role="tabpanel" aria-labelledby="v-operational_goal-tab">
                                        @foreach($operational_goals_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-initiative" role="tabpanel" aria-labelledby="v-initiative-tab">
                                        @foreach($initiatives_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-evaluation_task_definition" role="tabpanel" aria-labelledby="v-evaluation_task_definition-tab">
                                        @foreach($tasks_definitions_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-quarter" role="tabpanel" aria-labelledby="v-quarter-tab">
                                        @foreach($quarters_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-employee" role="tabpanel" aria-labelledby="v-employee-tab">
                                        @foreach($employees_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-task_detail" role="tabpanel" aria-labelledby="v-task_detail-tab">
                                        @foreach($task_details_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-position" role="tabpanel" aria-labelledby="v-position-tab">
                                        @foreach($positions_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-instProjectPlan_custReq___stage" role="tabpanel" aria-labelledby="v-instProjectPlan_custReq___stage-tab">
                                        @foreach($instProjectPlan_custReq___stages_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-instProjectPlan_custReq___phase" role="tabpanel" aria-labelledby="v-instProjectPlan_custReq___phase-tab">
                                        @foreach($instProjectPlan_custReq___phases_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-instProjectPlan_custReq___main_task" role="tabpanel" aria-labelledby="v-instProjectPlan_custReq___main_task-tab">
                                        @foreach($instProjectPlan_custReq___main_tasks_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-instProjectPlan_custReq___dependent_sub_task" role="tabpanel" aria-labelledby="v-instProjectPlan_custReq___dependent_sub_task-tab">
                                        @foreach($instProjectPlan_custReq___dependent_sub_tasks_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-instProjectPlan_custReq___sub_task" role="tabpanel" aria-labelledby="v-instProjectPlan_custReq___sub_task-tab">
                                        @foreach($instProjectPlan_custReq___sub_tasks_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-customer_request_place" role="tabpanel" aria-labelledby="v-customer_request_place-tab">
                                        @foreach($customer_request_places_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-instProjectPlan_custReq___main_task_responsible" role="tabpanel" aria-labelledby="v-instProjectPlan_custReq___main_task_responsible-tab">
                                        @foreach($instProjectPlan_custReq___main_task_responsibles_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-required_data_type" role="tabpanel" aria-labelledby="v-required_data_type-tab">
                                        @foreach($required_data_types_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-operation" role="tabpanel" aria-labelledby="v-operation-tab">
                                        @foreach($operations_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-task_operation" role="tabpanel" aria-labelledby="v-task_operation-tab">
                                        @foreach($task_operations_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-risk" role="tabpanel" aria-labelledby="v-risk-tab">
                                        @foreach($risks_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-resource" role="tabpanel" aria-labelledby="v-resource-tab">
                                        @foreach($resources_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-real_execution_phase" role="tabpanel" aria-labelledby="v-real_execution_phase-tab">
                                        @foreach($real_execution_phases_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-why_kaza" role="tabpanel" aria-labelledby="v-why_kaza-tab">
                                        @foreach($why_kazas_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-product_category" role="tabpanel" aria-labelledby="v-product_category-tab">
                                        @foreach($product_categories_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                            @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-product_brand" role="tabpanel" aria-labelledby="v-product_brand-tab">
                                        @foreach($product_brands_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                            @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                    <div class="tab-pane" id="v-place_activity" role="tabpanel" aria-labelledby="v-place_activity-tab">
                                        @foreach($place_activities_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-contact_us_message" role="tabpanel" aria-labelledby="v-contact_us_message-tab">
                                        @foreach($contact_us_messages_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-customer_request_evaluation" role="tabpanel" aria-labelledby="v-customer_request_evaluation-tab">
                                        @foreach($customer_request_evaluations_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="tab-pane" id="v-maintMap_custReq___price_offer" role="tabpanel" aria-labelledby="v-maintMap_custReq___price_offer-tab">
                                        @foreach($maintMap_custReq___price_offers_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-maintMap_custReq___visit" role="tabpanel" aria-labelledby="v-maintMap_custReq___visit-tab">
                                        @foreach($maintMap_custReq___visits_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-maintMap_custReq___task_employee" role="tabpanel" aria-labelledby="v-maintMap_custReq___task_employee-tab">
                                        @foreach($maintMap_custReq___task_employees_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-maintMap_custReq___employee" role="tabpanel" aria-labelledby="v-maintMap_custReq___employee-tab">
                                        @foreach($maintMap_custReq___employees_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-logistic_specialization" role="tabpanel" aria-labelledby="v-logistic_specialization-tab">
                                        @foreach($logistic_specializations_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-store___home_slider" role="tabpanel" aria-labelledby="v-store___home_slider-tab">
                                        @foreach($store___home_sliders_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-store___warranty_type" role="tabpanel" aria-labelledby="v-store___warranty_type-tab">
                                        @foreach($store___warranty_types_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-store___feature" role="tabpanel" aria-labelledby="v-store___feature-tab">
                                        @foreach($store___features_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-store___product_variant__media" role="tabpanel" aria-labelledby="v-store___product_variant__media-tab">
                                        @foreach($store___product_variant__medias_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-store___product" role="tabpanel" aria-labelledby="v-store___product-tab">
                                        @foreach($store___products_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-store___product_variant" role="tabpanel" aria-labelledby="v-store___product_variant-tab">
                                        @foreach($store___product_variants_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-permission" role="tabpanel" aria-labelledby="v-permission-tab">
                                        @foreach($permission_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-role" role="tabpanel" aria-labelledby="v-role-tab">
                                        @foreach($role_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="v-user" role="tabpanel" aria-labelledby="v-user-tab">
                                        @foreach($user_permissions as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                                                                                @if($role->hasPermissionTo($one_permission->name))
                                                            checked="checked"
                                                        @endif
                                                        @if(Route::currentRouteName() == "dashboard.role.show")
                                                            disabled
                                                        @endif
                                                        >
                                                        <span>{{$one_permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



