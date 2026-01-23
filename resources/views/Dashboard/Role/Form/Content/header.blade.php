<div class="clearfix row">
    <div class="col-md-6 col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.home.index',['locale'=>app()->getLocale()])}}">
                    {{ trans('Dashboard.Home')}}
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.role.index',['locale'=>app()->getLocale()])}}">
                    {{ trans('Dashboard.Roles')}}
                </a>
            </li>
            @if($role->exists)
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Dashboard.Edit_Role')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Dashboard.New_Role')}}</li>
            @endif
        </ol>
        </nav>
    </div>
    <div class="text-right col-md-6 col-sm-12 hidden-xs">
        <button type="button"
                class="btn btn-outline-info btn-toastr"
                data-context="info"
                data-message="This is general theme info"
                data-position="bottom-right">
                <i class="fa fa-question-circle"></i> {{ trans('Dashboard.Help')}}
        </button>
    </div>
</div>
