@extends('Dashboard.Main_Dashboard.Layouts.master')

@section('title')
    {{ trans('Dashboard.user')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            @include('Dashboard.Main_Dashboard.User.Single_Item.Content.header')
        </div>

        <div class="clearfix row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans('Dashboard.User')}}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                @include('Dashboard.Main_Dashboard.User.Single_Item.Content.main_links')
                            </div>
                        </div>
                        <br>
                        <div class="row">
                           @include('Dashboard.Main_Dashboard.User.Single_Item.Content.main_dates')
                        </div>
                        <div id="accordion" class="accordion">
                            <div class="card mb-0">
                                <!--main-info-section-->
                                @include('Dashboard.Main_Dashboard.User.Single_Item.Content.All_Info.index')
                            </div>
                        </div>

                        <div class="mb-3 input-group">
                            <a href="{{route('dashboard.main_dashboard.user.index',['locale'=>app()->getLocale(),'context_url'=>$context_url])}}" class="btn btn-outline-info" style="margin: 5px;">
                                {{ trans('Dashboard.Back')}}
                            </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
