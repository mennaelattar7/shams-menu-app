<div class="tab-pane vivify fadeIn " id="employees">
    <div class="block-header">
        <div class="clearfix row">
            <div class="col-md-12 col-sm-12">
                <h1 style="text-decoration: underline;font-weight: 900;text-align:center">{{ trans('Dashboard.Employees') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12"></div>
            <div class="text-right col-md-6 col-sm-12 hidden-xs">
                @if (Auth::user()->canAny(['16_create_employee']))
                    <button type="button" class="btn btn-round btn-success" data-toggle="modal"
                        data-target=".new_employee">{{ trans('Dashboard.Create') }}</button>
                @endif
                <button type="button" class="btn btn-outline-info btn-toastr" data-context="info"
                    data-message="This Page To Show All Employees" data-position="bottom-right" title="Help"
                    data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-question-circle"></i>
                    Help
                </button>
            </div>

        </div>
    </div>

    <div class="clearfix row">
        <div class="col-lg-12">
            @include('dashboard.employee.all_items.content.datatable.index')
        </div>
    </div>
</div>
