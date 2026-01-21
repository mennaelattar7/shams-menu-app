<div class="tab-pane active show" id="main_info">
    <div class="table-responsive">
        <table class="table table-hover table-custom spacing8">
            <tbody>
                <tr>
                    <th style="width: 15%;">{{ trans('Dashboard.Name')}} :</th>
                    <td>
                        {{ $strategic_goal->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 15%;">{{ trans('Dashboard.Description')}} :</th>
                    <td>
                        {{ $strategic_goal->description }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
