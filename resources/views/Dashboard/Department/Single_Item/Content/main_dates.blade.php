
@if($department->created_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Created_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$department->created_by,'context_url'=>$context_url])}}" class="btn btn-link">
                {{$department->created_by->first_name}} {{$department->created_by->last_name}} -  ({{ $department->created_at }})
            </a>
        </p>
    </div>
@endif
@if($department->updated_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Updated_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$department->updated_by,'context_url'=>$context_url])}}" class="btn btn-link">
                {{$department->updated_by->first_name}} {{$department->updated_by->last_name}} -  ({{ $department->updated_at }})
            </a>
        </p>
    </div>
@endif
@if($department->deleted_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Deleted_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$department->deleted_by,'context_url'=>$context_url])}}" class="btn btn-link">
                {{$department->deleted_by->name}} -  ({{ $department->deleted_at }})
            </a>
        </p>
    </div>
@endif
