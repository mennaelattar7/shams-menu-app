@extends('Dashboard.Main_Dashboard.Layouts.master')

@section('title')
    @if($department->exists)
        {{ trans('Dashboard.Edit_Department')}}
    @else
        {{ trans('Dashboard.New_Department')}}
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            @include('Dashboard.Main_Dashboard.Department.Form.Content.header')
        </div>

        <div class="clearfix row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        @if($department->exists)
                            <h2>
                               {{ $department->name }}
                            </h2>
                        @else
                            <h2>
                                {{ trans('Dashboard.New_department')}}
                            </h2>
                        @endif
                    </div>
                    <div class="body">
                        @if($department->exists)
                            <form method="post" action="{{route('dashboard.main_dashboard.department.update',['locale'=>app()->getLocale(),$department,'context_url'=>$context_url])}}" enctype="multipart/form-data">
                            @method('put')
                        @else
                            <form method="post" action="{{route('dashboard.main_dashboard.department.store',['locale'=>app()->getLocale(),'context_url'=>$context_url])}}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <div id="accordion" class="accordion">
                                <div class="card mb-0">
                                    <!--main-info-section-->
                                    @include('Dashboard.Main_Dashboard.Department.Form.Content.Sections.main_info')
                                </div>
                            </div>
                            <div class="mb-3 input-group">
                                @if($department->exists)
                                    <input type="submit" name="Save Changes" class="btn btn-outline-info" value="{{ trans('Dashboard.Save_Changes')}}" style="margin: 5px;width:20%">
                                @else
                                    <input type="submit" name="Create" class="btn btn-outline-info" value="{{ trans('Dashboard.Create')}}" style="margin: 5px;width:20%">
                                @endif
                                <a href="{{route('dashboard.main_dashboard.department.index',['locale'=>app()->getLocale(),'context_url'=>$context_url])}}" class="btn btn-outline-info" style="margin: 5px;">
                                    {{ trans('Dashboard.Cancel')}}
                                </a>
                            </div>
                            {{--  @if (Route::currentRouteName() == 'dashboard.main_dashboard.department.edit')
                                <!--relationships section-->
                                @include('Dashboard.Main_Dashboard.Department.Form.Content.Sections.Relationships.index')
                            @endif  --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
            $context = $(this).data('context');
            $message = $(this).data('message');
            $position = $(this).data('position');

            if ($context === '') {
                $context = 'info';
            }

            if ($position === '') {
                $positionClass = 'toast-bottom-right';
            } else {
                $positionClass = 'toast-' + $position;
            }

            var success_exist = '{{Session::has('success_msg')}}';
            var error_exist = '{{Session::has('error_msg')}}';
            if(success_exist){
                $context = 'success';
                $message = '{{Session::get('success_msg')}}';
                $positionClass = 'toast-top-full-width';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
            }
            if(error_exist){
                $context = 'error';
                $message = '{{Session::get('error_msg')}}';
                $positionClass = 'toast-top-full-width';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
            }


            $('input[name="tags"]').val($('.tagsinput').val());
            $('.tagsinput').change(function(){
                $('input[name="tags"]').val($('.tagsinput').val());
            });
            $('.tags_keywords').click(function(){
                var tag_id = $(this).attr('id');
                var tag_text = $(this).text();
                $('.tagsinput').tagsinput('add', tag_text);
                $('input[name="tags"]').val($('.tagsinput').val());
            });
    });
</script>
@endsection

@push('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{ asset('kaza/dashboard/custom_js/department/custom.js') }}"></script>
@endpush
