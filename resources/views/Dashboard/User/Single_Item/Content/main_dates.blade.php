
@if($user->created_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Created_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$user->created_by,'context_url'=>$context_url])}}" class="btn btn-link">
                {{$user->created_by->first_name}} {{$user->created_by->last_name}} -  ({{ $user->created_at }})
            </a>
        </p>
    </div>
@endif
@if($user->updated_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Updated_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$user->updated_by,'context_url'=>$context_url])}}" class="btn btn-link">
                {{$user->updated_by->first_name}} {{$user->updated_by->last_name}} -  ({{ $user->updated_at }})
            </a>
        </p>
    </div>
@endif
@if($user->deleted_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Deleted_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.main_dashboard.user.show',['locale' => app()->getLocale(),'user'=>$user->deleted_by,'context_url'=>$context_url])}}" class="btn btn-link">
                {{$user->deleted_by->name}} -  ({{ $user->deleted_at }})
            </a>
        </p>
    </div>
@endif
