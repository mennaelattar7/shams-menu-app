<div class="clearfix row">
    <div class="col-md-6 col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.main_dashboard.home.index',['locale'=>app()->getLocale()])}}">
                    {{ trans('Dashboard.Home')}}
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.main_dashboard.user.index',['locale'=>app()->getLocale(),'context_url'=>$context_url])}}">
                    {{ trans('Dashboard.Users')}}
                </a>
            </li>
            @if($user->exists)
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $user->name }}
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Dashboard.New_user')}}</li>
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
