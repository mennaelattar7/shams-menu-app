    <div class="card">
        <div class="body">
            <div class="card">
                @include('Dashboard.Role.All_Items.Content.Datatable.Content.navbar')
                <div class="mt-0 tab-content">
                    @include('Dashboard.Role.All_Items.Content.Datatable.Content.all')
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if (isset($department->id))
                var department_id = {{ $department->id }}
            @else
                var department_id = "";
            @endif

            var currentRoute='{{Route::currentRouteName()}}';
            var search_btn_value = 'not_pressed';
            var name = $("#name").val();

            get_role_data(search_btn_value,name,department_id);

            $('#search_btn').click(function(){
                var name = $("#name").val();
                var search_btn_value = 'pressed';
                $('#role_data').DataTable().destroy();
                $('#role_data_archived').DataTable().destroy();
                get_role_data(search_btn_value,name,department_id);
            });

            function get_role_data(search_btn_value,name)
            {
                var table = $('#role_data').DataTable({
                    serverSide: false,
                    searching: true,
                    processing: true,
                    searchDelay: 500,
                    responsive: true,
                    ajax: {
                            url: "{{route('dashboard.role.index',['locale'=>app()->getLocale()])}}",
                            data: {
                                search_btn_value:search_btn_value,
                                name:name,
                                department_id:department_id
                              }
                        },
                    order: [],
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            title: function(){
                                return "{{ trans('Dashboard.Roles')}}";
                            },
                            messageBottom: '<br><br><table>'+
                                    '<tr>'+
                                        '<td style="text-align:center">'+
                                            '<p>Signature</p>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td style="text-align:center">'+
                                            '<p>Mr. Mohamed Al-Adel</p>'+
                                        '</td>'+
                                    '</tr>'+
                                '</table>',
                            exportOptions: {
                                columns: ':visible',
                                stripHtml: false,
                                stripNewlines: false
                            }
                        },
                        {
                            extend: 'csv',
                            title: function(){
                                return "{{ trans('Dashboard.Roles')}}";
                            },
                            exportOptions: {
                                columns: ':visible',
                                stripHtml: false,
                                stripNewlines: false
                            }
                        },
                        {
                            extend: 'copy',
                            title: function(){
                                return "{{ trans('Dashboard.Roles')}}";
                            },
                            exportOptions: {
                                columns: ':visible',
                                stripHtml: false,
                                stripNewlines: false
                            }
                        },

                        {
                            extend: 'colvis',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                            }
                        },
                    ],
                    "lengthMenu":[[5,10,25,50,100,200,300,320,340,360,380,400,450,500,1000,-1],[5,10,25,50,100,200,300,320,340,360,380,400,450,500,1000,"All"]],
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'type', name: 'type'},
                        {
                            data:'action',
                            name:'action',
                            "render": function (data, type, full, meta)
                            {
                                var id = data.id;
                                var name = data.name;
                                var locale = "{{ app()->getLocale() }}";

                                var show_url = "{{route('dashboard.role.show',['locale' => ':locale','role'=>':id'])}}";
                                show_url = show_url.replace(':locale', locale);
                                show_url = show_url.replace(':id', id);

                                var edit_url = "{{route('dashboard.role.edit',['locale' => ':locale','role'=>':id'])}}";
                                edit_url = edit_url.replace(':locale', locale);
                                edit_url = edit_url.replace(':id', id);

                                var delete_url = "{{route('dashboard.role.delete',['locale' => ':locale','role'=>':id'])}}";
                                delete_url = delete_url.replace(':locale', locale);
                                delete_url = delete_url.replace(':id', id);

                                if(data["name"] != 'admin')
                                {
                                    return  ''+
                                    @if(Auth::user()->can([
                                        '2_single_role'
                                    ]))
                                        '<a href="'+show_url+'" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                            '<i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}'+
                                        '</a>'+
                                    @endif
                                    @if(Auth::user()->can([
                                        '2_edit_role'
                                    ]))
                                        '<a href="'+edit_url+'" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                            '<i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}'+
                                        '</a>'+
                                    @endif
                                    @if(Auth::user()->can([
                                        '2_delete_role'
                                    ]))
                                    '<button class="btn btn-danger" data-toggle="modal" data-target="#delete_model_'+data+'" title="{{ trans('Dashboard.Delete')}}" data-toggle="tooltip" data-placement="top">'+
                                        '<i class="fa fa-trash-o"></i> {{ trans('Dashboard.Delete')}}'+
                                    '</button>'+
                                    @endif
                                    '<div class="modal fade" id="delete_model_'+data+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">'+
                                        '<div class="modal-dialog modal-lg" role="document">'+
                                            '<div class="modal-content">'+
                                                '<div class="modal-header">'+
                                                    '<h5 class="modal-title" id="exampleModalCenterTitle">'+
                                                        "{{ trans('Dashboard.Role')}}"+
                                                    '</h5>'+
                                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                        '<span aria-hidden="true">&times;</span>'+
                                                    '</button>'+
                                                '</div>'+
                                                '<div class="modal-body" style="text-align: center;">'+
                                                    '<h3>'+
                                                        '<i class="fa fa-trash-o"></i>'+
                                                    '</h3>'+
                                                    '<p>{{ trans('Dashboard.Are_You_Sure_To_Delete_This_Role')}} ?!</p>'+
                                                '</div>'+
                                                '<div class="modal-footer">'+
                                                    '<button type="button" class="btn btn-round btn-outline-info" data-dismiss="modal">'+
                                                        '{{ trans('Dashboard.No,Close')}}'+
                                                    '</button>'+
                                                    '<a href="'+delete_url+'" class="btn btn-round btn-outline-info">{{ trans('Dashboard.yes,Delete')}}</a>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                                }
                                else
                                {
                                    return  ''+
                                    @if(Auth::user()->can([
                                        '2_single_role'
                                    ]))
                                        '<a href="'+show_url+'" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                            '<i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}'+
                                        '</a>'+
                                    @endif
                                    @if(Auth::user()->can([
                                        '2_edit_role'
                                    ]))
                                        '<a href="'+edit_url+'" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                            '<i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}'+
                                        '</a>';
                                    @endif
                                }
                            }
                        },
                    ]
                });
            }
        });
    </script>
