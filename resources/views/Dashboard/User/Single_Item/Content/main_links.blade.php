

@if(Auth::user()->can([
    '1_single_user'
]))
    <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$user,'context_url'=>$context_url])}}" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}
    </a>
@endif
@if(Auth::user()->can([
    '1_edit_user'
]))
    <a href="{{route('dashboard.main_dashboard.user.edit',['locale' => app()->getLocale(),'user'=>$user,'context_url'=>$context_url])}}" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}
    </a>
@endif

