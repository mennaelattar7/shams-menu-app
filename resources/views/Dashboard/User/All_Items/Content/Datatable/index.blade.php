    <div class="card">
        <div class="body">
            <div class="card">
                @include('Dashboard.Main_Dashboard.User.All_Items.Content.Datatable.Content.navbar')
                <div class="tab-content mt-0">
                    @include('Dashboard.Main_Dashboard.User.All_Items.Content.Datatable.Content.all')
                    @include('Dashboard.Main_Dashboard.User.All_Items.Content.Datatable.Content.archived')
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            var currentRoute='{{Route::currentRouteName()}}';
            var search_btn_value = 'not_pressed';
            var name = $("#name").val();
            get_user_data(search_btn_value,name);
            get_user_data_archived(search_btn_value,name);

            $('#search_btn').click(function(){
                var name = $("#name").val();
                var search_btn_value = 'pressed';
                $('#user_data').DataTable().destroy();
                $('#user_data_archived').DataTable().destroy();
                get_user_data(search_btn_value,name);
                get_user_data_archived(search_btn_value,name);
            });

            function get_user_data(search_btn_value,name)
            {
                var table = $('#user_data').DataTable({
                    serverSide: false,
                    searching: true,
                    processing: true,
                    searchDelay: 500,
                    responsive: true,
                    ajax: {
                            url: "{{route('dashboard.main_dashboard.user.index',['locale'=>app()->getLocale(),'context_url'=>$context_url])}}",
                            data: {
                                search_btn_value:search_btn_value,
                                name:name,
                              }
                        },
                    order: [],
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            title: function(){
                                return "{{ trans('Dashboard.Users')}}";
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
                                return "{{ trans('Dashboard.Users')}}";
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
                                return "{{ trans('Dashboard.Users')}}";
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
                        {
                            data: 'created_by',
                            name: 'created_by',
                            "render": function(data, type, full, meta) {
                                if (data != null) {
                                    var avatar_path = "{{ asset('kaza/dashboard/assets/images/xs/avatar.png')  }}"
                                    return  '<a href="'+data["url"]+'" title="Show" data-toggle="tooltip" data-placement="top" style="text-decoration:underline" class="btn btn-link">' +
                                                '<img src="'+avatar_path+'" data-toggle="tooltip" data-placement="top" title="Avatar Name" alt="Avatar" class="w35 rounded">'+
                                                '<br>'+
                                                data["name"] +
                                                '<br>'+
                                                data["position"]+
                                            '</a>'+
                                            '<br>'+
                                            data["created_at"];
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'phone_number', name: 'phone_number'},
                        {
                            data:'action',
                            name:'action',
                            "render": function (data, type, full, meta)
                            {
                                var id = data;
                                var locale = "{{ app()->getLocale() }}";
                                var context_url = "{{ $context_url }}";

                                var show_url = "{{route('dashboard.main_dashboard.user.show',['locale' => ':locale','user'=>':id','context_url'=>':context_url'])}}";
                                show_url = show_url.replace(':locale', locale);
                                show_url = show_url.replace(':id', id);
                                show_url = show_url.replace(':context_url',context_url)

                                var edit_url = "{{route('dashboard.main_dashboard.user.edit',['locale' => ':locale','user'=>':id','context_url'=>':context_url'])}}";
                                edit_url = edit_url.replace(':locale', locale);
                                edit_url = edit_url.replace(':id', id);
                                edit_url = edit_url.replace(':context_url',context_url)

                                var delete_url = "{{route('dashboard.main_dashboard.user.delete',['locale' => ':locale','user'=>':id','context_url'=>':context_url'])}}";
                                delete_url = delete_url.replace(':locale', locale);
                                delete_url = delete_url.replace(':id', id);
                                delete_url = delete_url.replace(':context_url',context_url)

                                return  ''+
                                        {{--  @if(Auth::user()->can([
                                            '1_single_user'
                                        ]))
                                            '<a href="'+show_url+'" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                '<i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}'+
                                            '</a>'+
                                        @endif
                                        @if($context_url == "hr-dashboard")
                                            @if(Auth::user()->can([
                                                '1_edit_user'
                                            ]))
                                                '<a href="'+edit_url+'" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                    '<i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}'+
                                                '</a>'+
                                            @endif
                                        @endif
                                        @if($context_url == "hr-dashboard")
                                            @if(Auth::user()->can([
                                                '1_delete_user'
                                            ]))
                                            '<button class="btn btn-danger" data-toggle="modal" data-target="#delete_model_'+data+'" title="{{ trans('Dashboard.Delete')}}" data-toggle="tooltip" data-placement="top">'+
                                                '<i class="fa fa-trash-o"></i> {{ trans('Dashboard.Delete')}}'+
                                            '</button>'+
                                            @endif
                                        @endif  --}}
                                        '<div class="modal fade" id="delete_model_'+data+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">'+
                                            '<div class="modal-dialog modal-lg" role="document">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<h5 class="modal-title" id="exampleModalCenterTitle">'+
                                                            "{{ trans('Dashboard.User')}}"+
                                                        '</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                            '<span aria-hidden="true">&times;</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body" style="text-align: center;">'+
                                                        '<h3>'+
                                                            '<i class="fa fa-trash-o"></i>'+
                                                        '</h3>'+
                                                        '<p>{{ trans('Dashboard.Are_You_Sure_To_Delete_This_User')}} ?!</p>'+
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
                        },
                    ]
                });
            }
            function get_user_data_archived(search_btn_value,name)
            {
                var table = $('#user_data_archived').DataTable({
                    serverSide: false,
                    searching: true,
                    processing: true,
                    searchDelay: 500,
                    responsive: true,
                    ajax: {
                            url: "{{route('dashboard.main_dashboard.user.archived',['locale'=>app()->getLocale(),'context_url'=>$context_url])}}",
                            data: {
                                search_btn_value:search_btn_value,
                                name:name,
                              }
                        },
                    order: [],
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            title: function(){
                                return "{{ trans('Dashboard.Users')}}";
                            },
                            messageBottom: '<br><br><table>'+
                                    '<tr>'+
                                        '<td style="text-align:center">'+
                                            '<p>Signature</p>'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td style="text-align:center">'+
                                            '<p>Dr . Dalia Ahmed Elsers</p>'+
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
                                return "{{ trans('Dashboard.Users')}}";
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
                                return "{{ trans('Dashboard.Users')}}";
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
                        {
                            data: 'created_by',
                            name: 'created_by',
                            "render": function (data, type, full, meta)
                            {
                                return '<a href="users/show/'+data[0]+'" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;text-decoration: underline;">'+
                                            data[1]+
                                        '</a>';
                            }
                        },
                        {
                            data: 'deleted_by',
                            name: 'deleted_by',
                            "render": function (data, type, full, meta)
                            {
                                return '<a href="users/show/'+data[0]+'" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="text-decoration:underline" class="btn btn-link">'+
                                            data[1]+
                                        '</a>'
                            }
                        },
                        {data: 'name', name: 'name'},
                        {
                            data: 'icon',
                            name: 'icon',
                            "render": function(data, type, full, meta) {
                                if (data != null) {
                                    return '<img src=http://127.0.0.1:8000/'+data+' style="width:50px;height:50px">'
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {data: 'deleteing_days', name: 'deleteing_days'},
                        {
                            data:'action',
                            name:'action',
                            "render": function (data, type, full, meta)
                            {
                                var id = data;
                                var locale = "{{ app()->getLocale() }}";
                                var context_url = "{{ $context_url }}"

                                var show_url = "{{route('dashboard.main_dashboard.user.show',['locale' => ':locale','user'=>':id','context_url'=>':context_url'])}}";
                                show_url = show_url.replace(':locale', locale);
                                show_url = show_url.replace(':id', id);
                                show_url = show_url.replace(':context_url',context_url);


                                var restore_url = "{{route('dashboard.main_dashboard.user.restore',['locale' => ':locale','user'=>':id','context_url'=>':context_url'])}}";
                                restore_url = restore_url.replace(':locale', locale);
                                restore_url = restore_url.replace(':id', id);
                                restore_url = restore_url.replace(':context_url',context_url);

                                var delete_permanently_url = "{{route('dashboard.main_dashboard.user.delete_permanently',['locale' => ':locale','user'=>':id','context_url'=>':context_url'])}}";
                                delete_permanently_url = delete_permanently_url.replace(':locale', locale);
                                delete_permanently_url = delete_permanently_url.replace(':id', id);
                                delete_permanently_url = delete_permanently_url.replace(':context_url',context_url);

                                return  ''+
                                        @if(Auth::user()->can([
                                            '1_single_user'
                                        ]))
                                            '<a href="'+show_url+'" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                '<i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}'+
                                            '</a>'+
                                        @endif
                                        @if($context_url == "hr-dashboard")
                                            @if(Auth::user()->can([
                                                '1_delete_permanently_user'
                                            ]))
                                                '<button class="btn btn-danger" data-toggle="modal" data-target="#delete_model_step_two_'+data+'" title="{{ trans('Dashboard.Delete')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                    '<i class="fa fa-trash-o"></i> {{ trans('Dashboard.Delete_permanently')}}'+
                                                '</button>'+
                                            @endif
                                        @endif
                                        @if($context_url == "hr-dashboard")
                                            @if(Auth::user()->can([
                                                '1_restore_user'
                                            ]))
                                                '<button class="btn btn-info" data-toggle="modal" data-target="#restore_model_'+data+'" title="{{ trans('Dashboard.Restore')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;background-color:#9F0FF7">'+
                                                    '<i class="fas fa-trash-restore"></i> {{ trans('Dashboard.Restore')}}'+
                                                '</button>'+
                                            @endif
                                        @endif
                                        '<div class="modal fade" id="restore_model_'+data+'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">'+
                                            '<div class="modal-dialog modal-lg">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<h5 class="modal-title h4" id="myLargeModalLabel">'+
                                                            "{{ trans('Dashboard.User')}}"+
                                                        '</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                        '<span aria-hidden="true">×</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body">'+
                                                        '<p>{{ trans('Dashboard.Do_You_Want_To_Restore_This_User')}} ?!</p>'+
                                                    '</div>'+
                                                    '<div class="modal-footer">'+
                                                        '<button type="button" class="btn btn-round btn-outline-info" data-dismiss="modal">'+
                                                            '{{ trans('Dashboard.No,Close')}}'+
                                                        '</button>'+
                                                        '<a href="'+restore_url+'" class="btn btn-round btn-outline-info">{{ trans('Dashboard.yes,Restore')}}</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="modal fade" id="delete_model_step_two_'+data+'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">'+
                                            '<div class="modal-dialog modal-lg">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<h5 class="modal-title" id="exampleModalCenterTitle">'+
                                                            "{{ trans('Dashboard.User')}}"+
                                                        '</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                            '<span aria-hidden="true">&times;</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body" style="text-align: center;">'+
                                                        '<h3>'+
                                                            '<i class="fa fa-trash-o"></i>'+
                                                        '</h3>'+
                                                        '<p>{{ trans('Dashboard.Are_You_Sure_To_Delete_This_User_Permanently')}} ?!</p>'+
                                                    '</div>'+
                                                    '<div class="modal-footer">'+
                                                        '<button type="button" class="btn btn-round btn-outline-info" data-dismiss="modal">'+
                                                            '{{ trans('Dashboard.No,Close')}}'+
                                                        '</button>'+
                                                        '<a href="'+delete_permanently_url+'" class="btn btn-round btn-outline-info">{{ trans('Dashboard.yes,Delete')}}</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                            }
                        },
                    ]

                });
            }
        });
    </script>
