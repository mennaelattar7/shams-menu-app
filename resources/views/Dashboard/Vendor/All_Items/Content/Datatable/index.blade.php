    <div class="card">
        <div class="body">
            <div class="card">
                @include('Dashboard.Vendor.All_Items.Content.Datatable.Content.navbar')
                <div class="mt-0 tab-content">
                    @include('Dashboard.Vendor.All_Items.Content.Datatable.Content.all')
                    @include('Dashboard.Vendor.All_Items.Content.Datatable.Content.archived')
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
            get_vendor_data(search_btn_value,name);
            get_vendor_data_archived(search_btn_value,name);

            $('#search_btn').click(function(){
                var name = $("#name").val();
                var search_btn_value = 'pressed';
                $('#vendor_data').DataTable().destroy();
                $('#vendor_data_archived').DataTable().destroy();
                get_vendor_data(search_btn_value,name);
                get_vendor_data_archived(search_btn_value,name);
            });

            function get_vendor_data(search_btn_value,name)
            {
                var table = $('#vendor_data').DataTable({
                    serverSide: false,
                    searching: true,
                    processing: true,
                    searchDelay: 500,
                    responsive: true,
                    ajax: {
                            url: "{{route('dashboard.vendor.index',['locale'=>app()->getLocale()])}}",
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
                                return "{{ trans('Dashboard.Vendors')}}";
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
                                return "{{ trans('Dashboard.Vendors')}}";
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
                                return "{{ trans('Dashboard.Vendors')}}";
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
                                    var avatar_path = "{{ asset('shams/dashboard/shams_assets/images/missing_avatar_employee.jpg')  }}"
                                    return  '<a href="'+data["url"]+'" title="Show" data-toggle="tooltip" data-placement="top" style="text-decoration:underline" class="btn btn-link">' +
                                                '<img src="'+avatar_path+'" data-toggle="tooltip" data-placement="top" title="Avatar Name" alt="Avatar" class="rounded w35" style="border-radius: 100% !important;">'+
                                                '<br>'+
                                                '<span style="color:#F4CE6A;font-weight: 600;">'+ data["name"] +'</span>'+
                                            '</a>'+
                                            '<br>'+
                                            data["created_at"];
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            render: function(data, type, full, meta) {
                                if (data != null) {
                                    // الربط الصحيح مع storage
                                    var logo_path = "{{ asset('storage') }}/" + data;
                                    return '<img src="' + logo_path + '" alt="logo" style="height:50px; width:auto;">';
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {data: 'company_name', name: 'company_name'},
                        {data: 'brand_name', name: 'brand_name'},
                        {
                            data: 'status', 
                            name: 'status',
                            "render": function(data, type, full, meta) {
                                if (data != null) {
                                    if(data =="pending_review")
                                    {
                                        return '<span class="badge bg-warning text-dark table-badges">'+data+'</span>';
                                    }
                                    else if(data =="accepted")
                                    {
                                        return '<span class="badge bg-success text-dark table-badges">'+data+'</span>';
                                    }
                                    else if(data =="blocked")
                                    {
                                        return '<span class="badge bg-danger text-dark table-badges">'+data+'</span>';
                                    }
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {
                            data: 'activation_status', 
                            name: 'activation_status',
                            "render": function(data, type, full, meta) {
                                if (data != null) {
                                    if(data =="active")
                                    {
                                        return '<span class="badge bg-default text-light table-badges activation-status-active">'+data+'</span>';
                                    }
                                    else if(data =="inactive")
                                    {
                                        return '<span class="badge bg-default text-light table-badges activation-status-inactive">'+data+'</span>';
                                    }
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {
                            data: 'rating', 
                            name: 'rating',
                            render: function(data, type, full, meta) {
                                if (data != null) {
                                    let stars = '';
                                    let fullStars = Math.floor(data); // عدد النجوم الكاملة
                                    let halfStar = (data % 1) >= 0.5; // هل فيه نصف نجمة؟
                                    let emptyStars = 5 - fullStars - (halfStar ? 1 : 0); // النجوم الفارغة

                                    // النجوم الكاملة
                                    for (let i = 0; i < fullStars; i++) {
                                        stars += '<i class="fa-solid fa-star text-warning"></i>';
                                    }

                                    // نصف نجمة
                                    if (halfStar) {
                                        stars += '<i class="fa-solid fa-star-half-stroke text-warning"></i>';
                                    }

                                    // النجوم الفارغة
                                    for (let i = 0; i < emptyStars; i++) {
                                        stars += '<i class="fa-regular fa-star text-warning"></i>';
                                    }

                                    return stars;
                                } else {
                                    return '-----';
                                }
                            }
                        },
                        {
                            data:'action',
                            name:'action',
                            "render": function (data, type, full, meta)
                            {
                                var id = data;
                                var locale = "{{ app()->getLocale() }}";

                                var show_url = "{{route('dashboard.vendor.show',['locale' => ':locale','vendor'=>':id'])}}";
                                show_url = show_url.replace(':locale', locale);
                                show_url = show_url.replace(':id', id);

                                var edit_url = "{{route('dashboard.vendor.edit',['locale' => ':locale','vendor'=>':id'])}}";
                                edit_url = edit_url.replace(':locale', locale);
                                edit_url = edit_url.replace(':id', id);

                                var delete_url = "{{route('dashboard.vendor.delete',['locale' => ':locale','vendor'=>':id'])}}";
                                delete_url = delete_url.replace(':locale', locale);
                                delete_url = delete_url.replace(':id', id);

                                return  ''+
                                        @if(Auth::user()->can([
                                            '4_single_vendor'
                                        ]))
                                            '<a href="'+show_url+'" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                '<i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}'+
                                            '</a>'+
                                        @endif

                                        @if(Auth::user()->can([
                                            '4_edit_vendor'
                                        ]))
                                            '<a href="'+edit_url+'" class="btn btn-warning" title="{{ trans('Dashboard.Edit')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                '<i class="fa fa-edit"></i> {{ trans('Dashboard.Edit')}}'+
                                            '</a>'+
                                        @endif


                                        @if(Auth::user()->can([
                                            '4_delete_vendor'
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
                                                            "{{ trans('Dashboard.Vendor')}}"+
                                                        '</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                            '<span aria-hidden="true">&times;</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body" style="text-align: center;">'+
                                                        '<h3>'+
                                                            '<i class="fa fa-trash-o"></i>'+
                                                        '</h3>'+
                                                        '<p>{{ trans('Dashboard.Are_You_Sure_To_Delete_This_Vendor')}} ?!</p>'+
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
            function get_vendor_data_archived(search_btn_value,name)
            {
                var table = $('#vendor_data_archived').DataTable({
                    serverSide: false,
                    searching: true,
                    processing: true,
                    searchDelay: 500,
                    responsive: true,
                    ajax: {
                            url: "{{route('dashboard.vendor.archived',['locale'=>app()->getLocale()])}}",
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
                                return "{{ trans('Dashboard.Vendors')}}";
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
                                return "{{ trans('Dashboard.Vendors')}}";
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
                                return "{{ trans('Dashboard.Vendors')}}";
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

                                var show_url = "{{route('dashboard.vendor.show',['locale' => ':locale','vendor'=>':id'])}}";
                                show_url = show_url.replace(':locale', locale);
                                show_url = show_url.replace(':id', id);


                                var restore_url = "{{route('dashboard.vendor.restore',['locale' => ':locale','vendor'=>':id'])}}";
                                restore_url = restore_url.replace(':locale', locale);
                                restore_url = restore_url.replace(':id', id);

                                var delete_permanently_url = "{{route('dashboard.vendor.delete_permanently',['locale' => ':locale','vendor'=>':id'])}}";
                                delete_permanently_url = delete_permanently_url.replace(':locale', locale);
                                delete_permanently_url = delete_permanently_url.replace(':id', id);

                                return  ''+
                                        @if(Auth::user()->can([
                                            '4_single_vendor'
                                        ]))
                                            '<a href="'+show_url+'" class="btn btn-info" title="{{ trans('Dashboard.Show')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                '<i class="fa fa-info-circle"></i> {{ trans('Dashboard.Show')}}'+
                                            '</a>'+
                                        @endif

                                        @if(Auth::user()->can([
                                            '4_delete_permanently_vendor'
                                        ]))
                                            '<button class="btn btn-danger" data-toggle="modal" data-target="#delete_model_step_two_'+data+'" title="{{ trans('Dashboard.Delete')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;">'+
                                                '<i class="fa fa-trash-o"></i> {{ trans('Dashboard.Delete_permanently')}}'+
                                            '</button>'+
                                        @endif

                                        @if(Auth::user()->can([
                                            '4_restore_vendor'
                                        ]))
                                            '<button class="btn btn-info" data-toggle="modal" data-target="#restore_model_'+data+'" title="{{ trans('Dashboard.Restore')}}" data-toggle="tooltip" data-placement="top" style="margin: 0px 5px;background-color:#9F0FF7">'+
                                                '<i class="fas fa-trash-restore"></i> {{ trans('Dashboard.Restore')}}'+
                                            '</button>'+
                                        @endif

                                        '<div class="modal fade" id="restore_model_'+data+'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">'+
                                            '<div class="modal-dialog modal-lg">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<h5 class="modal-title h4" id="myLargeModalLabel">'+
                                                            "{{ trans('Dashboard.Vendor')}}"+
                                                        '</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                        '<span aria-hidden="true">×</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body">'+
                                                        '<p>{{ trans('Dashboard.Do_You_Want_To_Restore_This_Vendor')}} ?!</p>'+
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
                                                            "{{ trans('Dashboard.Vendor')}}"+
                                                        '</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                                            '<span aria-hidden="true">&times;</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body" style="text-align: center;">'+
                                                        '<h3>'+
                                                            '<i class="fa fa-trash-o"></i>'+
                                                        '</h3>'+
                                                        '<p>{{ trans('Dashboard.Are_You_Sure_To_Delete_This_Vendor_Permanently')}} ?!</p>'+
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
