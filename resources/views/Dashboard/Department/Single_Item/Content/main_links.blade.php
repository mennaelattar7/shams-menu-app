

@if(Auth::user()->can([
    '6_single_department'
]))
    <a href="{{route('dashboard.main_dashboard.department.show',['locale' => app()->getLocale(),'department'=>$department,'context_url'=>$context_url])}}" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}
    </a>
@endif
@if(Auth::user()->can([
    '6_edit_department'
]))
    <a href="{{route('dashboard.main_dashboard.department.edit',['locale' => app()->getLocale(),'department'=>$department,'context_url'=>$context_url])}}" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}
    </a>
@endif

