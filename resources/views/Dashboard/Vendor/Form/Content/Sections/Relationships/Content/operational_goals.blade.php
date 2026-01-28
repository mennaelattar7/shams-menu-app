<div class="tab-pane vivify fadeIn" id="operational_goals">
    <div class="block-header">
        <div class="clearfix row">
            <div class="col-md-12 col-sm-12">
                <h1 style="text-decoration: underline;font-weight: 900;text-align:center">{{ trans('Dashboard.Operational_Goals') }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12"></div>
            <div class="text-right col-md-6 col-sm-12 hidden-xs">
                @if (Auth::user()->canAny(['12_create_evaluation_operational_goal']))
                    <button type="button" class="btn btn-round btn-success" data-toggle="modal"
                        data-target=".new_operational_goal">{{ trans('Dashboard.Create') }}</button>
                @endif
                <button type="button" class="btn btn-outline-info btn-toastr" data-context="info"
                    data-message="This Page To Show All operational_goals" data-position="bottom-right" title="Help"
                    data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-question-circle"></i>
                    Help
                </button>
            </div>

        </div>
    </div>

    <div class="clearfix row">
        <div class="col-lg-12">
            @include('dashboard.operational_goal.all_items.content.datatable.index')
        </div>
    </div>
</div>
