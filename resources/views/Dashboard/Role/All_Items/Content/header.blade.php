    <div class="col-md-6 col-sm-12">
        <h1>{{ trans('Dashboard.Roles')}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard.home.index',['locale' => app()->getLocale()])}}">
                        {{ trans('Dashboard.Home')}}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ trans('Dashboard.Roles')}}
                </li>
            </ol>
        </nav>
    </div>
    <div class="text-right col-md-6 col-sm-12 hidden-xs">
        @if(Auth::user()->can([
            '2_create_role'
        ]))
            <a href="{{route('dashboard.role.create',['locale' => app()->getLocale()])}}" class="btn btn-outline-success create-button" title="{{ trans('Dashboard.Create_New_Role')}}" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"></i>
                {{ trans('Dashboard.Create_Role')}}
            </a>
        @endif
        <button type="button"
                class="btn btn-outline-info btn-toastr"
                data-context="info"
                data-message="This Page To Show All Role"
                data-position="bottom-right" title="Help" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-question-circle"></i>
                {{ trans('Dashboard.Help')}}
        </button>
    </div>
