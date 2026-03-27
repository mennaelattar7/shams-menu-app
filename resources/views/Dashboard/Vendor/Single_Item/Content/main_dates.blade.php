
@if($vendor->created_by != null)
    <div class="col-md-6">
        <small class="text-muted">
            {{ trans('Dashboard.Created_By')}}:
        </small>
        <p>
            <a href="{{route('dashboard.user.show',['locale' => app()->getLocale(),'user'=>$vendor->created_by])}}" class="btn btn-link">
                {{$vendor->created_by->name}}
            </a>
            <span>
                ({{ $vendor->created_at->format('d M Y • h:i A') }})
            </span>
            <br>

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
                {{$vendor->updated_by->name}}
            </a>
            <span>
                ({{ $vendor->updated_at->format('d M Y • h:i A') }})
            </span>
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
                {{$vendor->deleted_by->name}}
            </a>
            <span>
                ({{ $vendor->deleted_at->format('d M Y • h:i A') }})
            </span>
        </p>
    </div>
@endif
