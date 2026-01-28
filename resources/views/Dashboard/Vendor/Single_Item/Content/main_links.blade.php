

@if(Auth::user()->can([
    '4_single_vendor'
]))
    <a href="{{route('dashboard.vendor.show',['locale' => app()->getLocale(),'vendor'=>$vendor])}}" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}
    </a>
@endif
@if(Auth::user()->can([
    '4_edit_vendor'
]))
    <a href="{{route('dashboard.vendor.edit',['locale' => app()->getLocale(),'vendor'=>$vendor])}}" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}
    </a>
@endif

