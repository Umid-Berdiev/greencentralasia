@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
<div class="container-fluid" id="page_content" style="background-color: #F5F5F5">
    <div class="container">
        @endsection
        <div class="row">
            @section('nowosti')
            <div class="page-content">
                <div>
                    <ol class="breadcrumb h6">
                        <li><a href="{{URL(App::getLocale().'/')}}"
                                title="{{ __('blog.bosh') }}">{{ __('blog.bosh') }}</a></li>
                    </ol>
                </div>
            </div>

            <div class="page-header row">
                <div class="col-md-9">
                    <h4><b>{{ __('blog.resume_pagetitle') }}</b></h4>
                </div>
                <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                    <a class="page-print-link pull-right" style="cursor:pointer;" target="_self"><span
                            class="glyphicon glyphicon-print"></span> {{ __('blog.print_button') }}</a>
                </div>
            </div>
            <div class="col" style="padding-top: 25px;">
                <div class="text-left">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <p>Мурожаатингиз қабул қилинди. Аризангизни руйхат рақами: <span>
                                {{ session()->get('message') }}</span></p>
                    </div>
                    @endif
                    <form action="{{URL('/cv_form_post')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">{{ __('blog.full_name') }}<span class="required">*</span>:</label>
                            <input type="text" value="{{ old('fio') }}" name="fio" title=""
                                placeholder="{{ __('blog.full_name_placeholder') }}" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.email') }} <span class="required">*</span>:</label>
                            <input type="email" value="{{ old('email') }}" name="email" title=""
                                placeholder="{{ __('blog.email_placeholder') }}" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.phone_number') }}</label>
                            <input type="text" value="{{ old('phone') }}" name="phone" title=""
                                placeholder="{{ __('blog.phone_number_placeholder') }}" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.additional_message') }} <span class="required">*</span>:</label>
                            <textarea resize="no" name="comment" cols="25" rows="5" title=""
                                placeholder="{{ __('blog.additional_message_placeholder') }}"
                                class="form-control textarea" id="">{{ old('comment') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('blog.file_attachment') }}</label>
                            <input type="file" name="file">
                        </div>

                        <!--<div class="form-group forspam">
                                    <label for="">Спамга қарши код <span class="required">*</span>:</label><br>
                                    <img src="{{URL('images/captcha.jpg')}}" width="150" height="40" class="captcha-image" alt="CAPTCHA" id="">&nbsp;
                                    <input type="text" class="" name="captcha_word" class="" value="" maxlength="5" placeholder="Расмдаги кодни киритинг"><br>
                                    <a href="#" class="" title="">Кодни ўзгартириш</a>
                                    <br>
                                </div>-->
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary col-md-6"
                                value="{{ __('blog.form_btn_send') }}">
                        </div>
                        <div class="clearfix"></div><br>
                        <div class="alert alert-warning">
                            <span class="required">*</span> {{ __('blog.required_fields_note') }}
                        </div><br>


                    </form>
                </div>


            </div>

            @endsection

            @section('statistika')
            @endsection
        </div>
        @section('nav_page')
        <div class="col-md-3" style="padding-top: 50px;">
            <div class="col menu-item-structure">
                <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                    {{ __('blog.resume_pagetitle') }}
                </div>
                <div class="list-group">

                </div>
            </div>
        </div>
        @endsection
    </div>
</div>
@section('tender')


@foreach($tenders as $key=>$tender)
<div class="row">
    <div class="col-xs-4" style="padding-top: 10px">
        <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><img
                class="img-responsive center-block"
                src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}" alt=""></a>
    </div>
    <div class="col-xs-8">
        <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}">
            <h6>{{$tender->title}}</h6>
        </a>
    </div>
</div>
@endforeach

@endsection
@section('regional_uprav')
@endsection
@section('poleznaya-info')
@endsection
@section('video_foto_baner')
@endsection
</div>