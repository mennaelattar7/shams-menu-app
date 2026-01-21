<div class="tab-pane active show" id="main_info">
    <div class="table-responsive">
        <table class="table table-hover table-custom spacing8">
            <tbody>
                <tr>
                    <th style="width: 15%;">{{ trans('Dashboard.Name')}} :</th>
                    <td>
                        {{ $user->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 15%;">{{ trans('Dashboard.The_main_user_emanating_from_it')}} :</th>
                    <td>
                        {{ $user->parent->name }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
