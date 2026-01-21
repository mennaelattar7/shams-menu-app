    <div class="col-md-6 col-sm-12">
        <h1>{{ trans('Dashboard.Departments')}}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard.main_dashboard.home.index',['locale' => app()->getLocale()])}}">
                        {{ trans('Dashboard.Home')}}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ trans('Dashboard.Departments')}}
                </li>
            </ol>
        </nav>
    </div>
    <div class="text-right col-md-6 col-sm-12 hidden-xs">
        @if(Auth::user()->can([
            '6_create_department'
        ]))
            <a href="{{route('dashboard.main_dashboard.department.create',['locale' => app()->getLocale(),'context_url'=>$context_url])}}" class="btn btn-outline-success create-button" title="{{ trans('Dashboard.Create_New_Department')}}" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-plus"></i>
                {{ trans('Dashboard.Create_Department')}}
            </a>
        @endif
        <button type="button"
                class="btn btn-outline-info btn-toastr"
                data-context="info"
                data-message="This Page To Show All Department"
                data-position="bottom-right" title="Help" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-question-circle"></i>
                {{ trans('Dashboard.Help')}}
        </button>
    </div>
