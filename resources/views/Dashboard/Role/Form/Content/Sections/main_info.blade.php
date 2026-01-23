<div class="card-header" data-toggle="collapse" href="#main_info_section" aria-expanded="true" style="font-size: 20px;background-color: #F4CE6A;color: black;padding: 20px;padding: 20px !important;">
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
                            <option value="shams_employee"
                                @if(Session::get('type') == "shams_employee")
                                    selected="selected"
                                @endif
                                @if($role->type == "shams_employee")
                                        selected="selected"
                                @endif
                                @if(old('type') == "shams_employee")
                                    selected="selected"
                                @endif
                            >
                                {{ trans(('Dashboard.Shams_Employee')) }}
                            </option>
                            <option value="vendor_employee"
                                @if(Session::get('type') == "vendor_employee")
                                    selected="selected"
                                @endif
                                @if($role->type == "vendor_employee")
                                        selected="selected"
                                @endif
                                @if(old('type') == "vendor_employee")
                                    selected="selected"
                                @endif
                            >
                                {{ trans(('Dashboard.Vendor_Employee')) }}
                            </option>
                            <option value="other"
                                @if(Session::get('type') == "other")
                                    selected="selected"
                                @endif
                                @if($role->type == "other")
                                        selected="selected"
                                @endif
                                @if(old('type') == "other")
                                    selected="selected"
                                @endif
                            >
                                {{ trans(('Dashboard.Other')) }}
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
                                    <h6 class="mt-3 mb-1 text-muted">Vendor Modules</h6>
                                    <br>
                                    <a class="nav-link show active" id="v-product-tab" data-toggle="pill" href="#v-product" role="tab" aria-controls="v-product" aria-selected="true">
                                        {{ trans('Dashboard.Products')}}
                                    </a>
                                    <a class="nav-link" id="v-branch-tab" data-toggle="pill" href="#v-branch" role="tab" aria-controls="v-branch" aria-selected="true">
                                        {{ trans('Dashboard.Branches')}}
                                    </a>
                                    <a class="nav-link" id="v-vendor___menu_category-tab" data-toggle="pill" href="#v-vendor___menu_category" role="tab" aria-controls="v-vendor___menu_category" aria-selected="true">
                                        {{ trans('Dashboard.Menu_Categories')}}
                                    </a>
                                    <a class="nav-link" id="v-vendor-tab" data-toggle="pill" href="#v-vendor" role="tab" aria-controls="v-vendor" aria-selected="true">
                                        {{ trans('Dashboard.Vendor')}}
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
                                    <div class="tab-pane active show" id="v-product" role="tabpanel" aria-labelledby="v-product-tab">
                                        <h6><i>-- {{ $role->guard_name }} Guard Name --</i></h6>
                                        @foreach($products_permissions->where('guard_name',$role->guard_name) as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission))
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
                                    <div class="tab-pane" id="v-branch" role="tabpanel" aria-labelledby="v-branch-tab">
                                        <h6><i>-- {{ $role->guard_name }} Guard Name --</i></h6>
                                        @foreach($branchs_permissions->where('guard_name',$role->guard_name) as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission))
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
                                    <div class="tab-pane" id="v-vendor___menu_category" role="tabpanel" aria-labelledby="v-vendor___menu_category-tab">
                                        <h6><i>-- {{ $role->guard_name }} Guard Name --</i></h6>
                                        @foreach($vendor___menu_category_permissions->where('guard_name',$role->guard_name) as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission))
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
                                    <div class="tab-pane" id="v-vendor" role="tabpanel" aria-labelledby="v-vendor-tab">
                                        <h6><i>-- {{ $role->guard_name }} Guard Name --</i></h6>
                                        @foreach($vendors_permissions->where('guard_name',$role->guard_name) as $one_permission)
                                            <div class="col-md-12">
                                                <div class="fancy-checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                        @if($role->hasPermissionTo($one_permission))
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



