    <div class="col-md-6 col-sm-12">
        <h1>{{ trans('Dashboard.Vendors')}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard.home.index',['locale' => app()->getLocale()])}}">
                        {{ trans('Dashboard.Home')}}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ trans('Dashboard.Vendors')}}
                </li>
            </ol>
        </nav>
    </div>
    <div class="text-right col-md-6 col-sm-12 hidden-xs">
        @if(Auth::user()->can([
            '4_create_vendor'
        ]))
            <a href="{{route('dashboard.vendor.create',['locale' => app()->getLocale()])}}" class="btn btn-outline-success create-button" title="{{ trans('Dashboard.Create_Vendor')}}" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"></i>
                {{ trans('Dashboard.Create_Vendor')}}
            </a>
        @endif
        <button type="button"
                class="btn btn-outline-info btn-toastr"
                data-context="info"
                data-message="This Page To Show All Vendor"
                data-position="bottom-right" title="Help" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-question-circle"></i>
                {{ trans('Dashboard.Help')}}
        </button>
    </div>
