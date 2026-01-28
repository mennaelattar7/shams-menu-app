
@if($vendor->created_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Created_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$vendor->created_by])}}" class="btn btn-link">
                {{$vendor->created_by->first_name}} {{$vendor->created_by->last_name}} -  ({{ $vendor->created_at }})
            </a>
        </p>
    </div>
@endif
@if($vendor->updated_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Updated_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$vendor->updated_by])}}" class="btn btn-link">
                {{$vendor->updated_by->first_name}} {{$vendor->updated_by->last_name}} -  ({{ $vendor->updated_at }})
            </a>
        </p>
    </div>
@endif
@if($vendor->deleted_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Deleted_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$vendor->deleted_by])}}" class="btn btn-link">
                {{$vendor->deleted_by->name}} -  ({{ $vendor->deleted_at }})
            </a>
        </p>
    </div>
@endif
