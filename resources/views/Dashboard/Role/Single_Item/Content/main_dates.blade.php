
@if($strategic_goal->created_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Created_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$strategic_goal->created_by])}}" class="btn btn-link">
                {{$strategic_goal->created_by->first_name}} {{$strategic_goal->created_by->last_name}} -  ({{ $strategic_goal->created_at }})
            </a>
        </p>
    </div>
@endif
@if($strategic_goal->updated_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Updated_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$strategic_goal->updated_by])}}" class="btn btn-link">
                {{$strategic_goal->updated_by->first_name}} {{$strategic_goal->updated_by->last_name}}-  ({{ $strategic_goal->updated_at }})
            </a>
        </p>
    </div>
@endif
@if($strategic_goal->deleted_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Deleted_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$strategic_goal->deleted_by])}}" class="btn btn-link">
                {{$strategic_goal->deleted_by->name}} -  ({{ $strategic_goal->deleted_at }})
            </a>
        </p>
    </div>
@endif
