

@if(Auth::user()->can([
    '11_single_evaluation_strategic_goal'
]))
    <a href="{{route('dashboard.strategic_goal.show',['locale' => app()->getLocale(),'strategic_goal'=>$strategic_goal])}}" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}
    </a>
@endif
@if(Auth::user()->can([
    '11_edit_evaluation_strategic_goal'
]))
    <a href="{{route('dashboard.strategic_goal.edit',['locale' => app()->getLocale(),'strategic_goal'=>$strategic_goal])}}" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">
        <i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}
    </a>
@endif

