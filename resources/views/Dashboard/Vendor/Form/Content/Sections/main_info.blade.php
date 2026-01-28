<div class="card-header" data-toggle="collapse" href="#main_info_section" aria-expanded="true" style="font-size: 20px;background-color: #F4CE6A;color: black;padding: 20px;padding: 20px !important;">
    <a class="card-title">
        {{ trans('Dashboard.Main_Info')}}
    </a>
</div>
<div id="main_info_section" class="card-body collapse show" data-parent="#accordion" >
    <div class="panel-body">
        <div class="row">
            <!-- vendor_name -->
            <div class="col-md-6">
                <div class="form-group vendor-name-en">
                    <label for="basic-url"
                        @if ($errors->has('vendor_name_en'))
                            style="color: red"
                        @endif
                        @if ($errors->has('vendor_name_ar'))
                            style="color: red"
                        @endif>
                        Name <span class="required-element"> * </span>
                    </label>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-pencil"></i>
                            </span>
                        </div>

                        <input
                            type="text"
                            class="form-control"
                            id="vendor_name_en"
                            placeholder="vendor_name_en"
                            name="vendor_name_en"
                            autocomplete="off"
                            spellcheck="true"
                            aria-label="vendor_name_en"
                            aria-describedby="basic-addon1"
                            value="{{ old('vendor_name_en',json_decode($vendor->getRawOriginal('name'),true) != null ? json_decode($vendor->getRawOriginal('name'),true)['en'] : '' ) }}"
                            @if ($errors->has('vendor_name_en'))
                                style="border:1px solid red"
                            @endif
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="vendor_name_ar"
                            placeholder="vendor_name_ar"
                            name="vendor_name_ar"
                            autocomplete="off"
                            spellcheck="true"
                            aria-label="vendor_name_ar"
                            aria-describedby="basic-addon1"
                            value="{{ old('vendor_name_ar',json_decode($vendor->getRawOriginal('name'),true) != null ? json_decode($vendor->getRawOriginal('name'),true)['ar'] : '' ) }}"
                            @if ($errors->has('vendor_name_ar'))
                                style="border:1px solid red"
                            @endif
                        >
                        <input
                            type="checkbox"
                            data-toggle="toggle"
                            @if(app()->getLocale() == "en")
                                data-on="EN" data-off="AR"
                            @else
                                data-on="AR" data-off="EN"
                            @endif
                            @if(app()->getLocale() == "en")
                            data-onstyle="info"
                            @else
                            data-onstyle="info"
                            @endif
                            id="toggle-event-vendor-name"
                            checked
                        >
                    </div>
                    @if ($errors->has('vendor_name_en'))
                        <p style="color: red">
                            {{ $errors->first('vendor_name_en') }}
                        </p>
                    @endif
                    @if ($errors->has('vendor_name_ar'))
                        <p style="color: red">
                            {{ $errors->first('vendor_name_ar') }}
                        </p>
                    @endif
                </div>
            </div>
            <!--parent_id-->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="basic-url"
                        @if($errors->has('parent_id'))
                            style="color: red"
                        @endif
                    >
                        {{ trans('Dashboard.The_main_vendor_emanating_from_it')}}
                    </label>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"
                                @if($errors->has('parent_id'))
                                    style="border: 1px solid red;color:red"
                                @endif
                            >
                                <i class="fa fa-list-ul"></i>
                            </label>
                        </div>
                        <select class="custom-select" name="parent_id" id="parent_id"
                        @if($errors->has('parent_id'))
                            style="border: 1px solid red"
                        @endif
                        >

                            <option value="">{{ trans('Dashboard.Choose_Vendor')}}...</option>
                            @foreach($all_vendors as $one_vendor)
                                <option value="{{$one_vendor->id}}"
                                    @if(Session::get('parent_id') == $one_vendor->id)
                                        selected="selected"
                                    @endif
                                    @if($vendor->parent_id == $one_vendor->id)
                                            selected="selected"
                                    @endif
                                    @if(old('parent_id') == $one_vendor->id)
                                        selected="selected"
                                    @endif
                                >
                                    {{$one_vendor->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('parent_id'))
                        <p style="color: red">{{$errors->first('parent_id')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



