@extends('Dashboard.Layouts.master')

@section('title')
    {{ trans('Dashboard.Roles')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="clearfix row">
                @include('Dashboard.Role.All_Items.Content.header')
            </div>
            <div class="search_block">
                @include('Dashboard.Role.All_Items.Content.search_block')
            </div>
        </div>

        <div class="clearfix row">
            <div class="col-lg-12">
                @include('Dashboard.Role.All_Items.Content.Datatable.index')
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-toastr').on('click', function() {
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

                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
            });
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
        });
    </script>

@endsection
