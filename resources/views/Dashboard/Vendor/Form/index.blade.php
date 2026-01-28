@extends('Dashboard.Layouts.master')

@section('title')
    @if($vendor->exists)
        {{ trans('Dashboard.Edit_Vendor')}}
    @else
        {{ trans('Dashboard.New_Vendor')}}
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            @include('Dashboard.Vendor.Form.Content.header')
        </div>

        <div class="clearfix row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        @if($vendor->exists)
                            <h2>
                               {{ $vendor->name }}
                            </h2>
                        @else
                            <h2>
                                {{ trans('Dashboard.New_vendor')}}
                            </h2>
                        @endif
                    </div>
                    <div class="body">
                        @if($vendor->exists)
                            <form method="post" action="{{route('dashboard.vendor.update',['locale'=>app()->getLocale(),$vendor])}}" enctype="multipart/form-data">
                            @method('put')
                        @else
                            <form method="post" action="{{route('dashboard.vendor.store',['locale'=>app()->getLocale()])}}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <div id="accordion" class="accordion">
                                <div class="mb-0 card">
                                    <!--main-info-section-->
                                    @include('Dashboard.Vendor.Form.Content.Sections.main_info')
                                </div>
                            </div>
                            <div class="mb-3 input-group">
                                @if($vendor->exists)
                                    <input type="submit" name="Save Changes" class="btn btn-outline-info" value="{{ trans('Dashboard.Save_Changes')}}" style="margin: 5px;width:20%">
                                @else
                                    <input type="submit" name="Create" class="btn btn-outline-info" value="{{ trans('Dashboard.Create')}}" style="margin: 5px;width:20%">
                                @endif
                                <a href="{{route('dashboard.vendor.index',['locale'=>app()->getLocale()])}}" class="btn btn-outline-info" style="margin: 5px;">
                                    {{ trans('Dashboard.Cancel')}}
                                </a>
                            </div>
                            {{--  @if (Route::currentRouteName() == 'dashboard.vendor.edit')
                                <!--relationships section-->
                                @include('Dashboard.Vendor.Form.Content.Sections.Relationships.index')
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

    <script src="{{ asset('kaza/dashboard/custom_js/vendor/custom.js') }}"></script>
@endpush
