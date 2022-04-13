@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
    <div class="container-fluid" id="page_content"  style="background-color: #F5F5F5">
        <div class="container">
            @endsection
            <div class="row section-to-print">
                @section('nowosti')
                    <div class="page-content">
                        <div>
                            <ol class="breadcrumb h6">
                                <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b>@lang('blog.entity_form_block_header')</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" target="_self" ><span class="glyphicon glyphicon-print"></span> @lang('blog.print_button') </a>
                        </div>
                    </div>
                    <div class="col" style="padding-top: 25px;">
                        <div class="col-md-12">
                            <div class="row" id="print_all">
                                <div class="col-sm-6">
                                    
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
                                                    <p>@lang('blog.application_received_message') <span>{{ session()->get('message') }}</span></p>
                                                </div>
                                            @endif
                                        <form action="{{URL('send_post')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="">@lang('blog.full_name')<span class="required">*</span>:</label>
                                                <input type="text" value="{{ old('fio') }}"  name="fio" title="" placeholder="@lang('blog.full_name_placeholder')" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.date_of_birth') <span class="required">*</span>:</label>
                                                <input type="text" value="{{ old('birth') }}"  name="birth" title="" placeholder="@lang('blog.date_of_birth_placeholder')" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.passport_details') <span class="required">*</span>:</label>
                                                <input type="text" value="{{ old('passport') }}"  name="passport" title="" placeholder="@lang('blog.passport_details_placeholder')" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.address') <span class="required">*</span>:</label>
                                                <textarea resize="no" name="adress" cols="25" rows="5" title="" placeholder="@lang('blog.address_placeholder')" class="form-control textarea" id="">{{ old('adress') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.zip_code'):</label>
                                                <input type="text" value="{{ old('index') }}"  name="index" title="" placeholder="@lang('blog.zip_code_placeholder')" class="form-control" id="">
                                            </div>

                                            <div class="form-group">
                                                <label for="">@lang('blog.email') <span class="required">*</span>:</label>
                                                <input type="email" value="{{ old('email') }}"  name="email" title="" placeholder="@lang('blog.email_placeholder')" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.phone_number')</label>
                                                <input type="text" value="{{ old('phone_number') }}"  name="phone_number" title="" placeholder="@lang('blog.phone_number_placeholder') " class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.entity_type') <span class="required">*</span>:</label>
                                                <select name="object_type" class="form-control select" id="">
                                                    <option value="Жисмоний шахс">@lang('blog.physical_entities_submitted')</option>
                                                    <option value="Юридик шахс">@lang('blog.legal_entities_submitted')</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('blog.message_content') <span class="required">*</span>:</label>
                                                <textarea resize="no" name="comment" cols="25" rows="5" title="" placeholder="@lang('blog.message_content')" class="form-control textarea" id="">{{ old('comment') }}</textarea>
                                            </div>
                                           <!-- <div class="form-group forspam">
                                                <label for="">Спамга қарши код <span class="required">*</span>:</label><br>
                                                <img src="images/captcha.jpg" width="150" height="40" class="captcha-image" alt="CAPTCHA" id="">&nbsp;
                                                <input type="text" class="" name="captcha_word" class="" value="" maxlength="5" placeholder="Расмдаги кодни киритинг"><br>
                                                <a href="#" class="" title="">Кодни ўзгартириш</a>
                                                <br>
                                            </div>-->
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary col-md-6" value="@lang('blog.form_btn_send')">
                                            </div>
                                            <div class="clearfix"></div><br>
                                            <div class="alert alert-warning">
                                                <span class="required">*</span> @lang('blog.required_fields_note')
                                            </div><br>

                                        </form>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="">
                                        <div class="page-header">
                                            <h4><b>@lang('blog.application_statistics_banner_header')</b></h4>
                                        </div>
                                        <br/>
                                        <div class="col-xs-12 info-request">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <h4 class="text-center">@lang('blog.submitted_applications_number')</h4>
                                                <p class="text-center">@lang('blog.period') {{$last_month1}} - {{$now1}}</p>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="clearfix"></div>
                                            <p>@lang('blog.submitted_applications_number'): <span class="">{{$all}}</span></p>
                                            <p>@lang('blog.physical_entities_submitted'): <span class="">{{$fiz}}</span></p>
                                            <p>@lang('blog.legal_entities_submitted'): <span class="">{{$yur}}</span></p>
                                            <p>@lang('blog.applications_in_process'): <span class="">{{$worked}}</span></p>
                                            <p>@lang('blog.applications_completed'): <span class="">{{$finished}}</span></p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                    <div class="check-status">
                                        <div class="page-header">
                                            <h4><b>@lang('blog.application_status_check_header')</b></h4>
                                        </div><br>
                                        <div class="">
                                            <p>@lang('blog.application_status_check_message')</p>
                                        </div>
                                        <p>@lang('blog.application_reg_number'):</p>
                                        <form class="form-inline" action="{{URL('/check')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="text"  class="form-control" id="aplication-id" placeholder="@lang('blog.application_reg_number_placeholder')" name="aplication_id">
                                            <button type="submit" class="btn btn-primary pull-right">@lang('blog.btn_check_status')</button>
                                        </form>

                                    </div>
                                    <br>
                                    @if(session()->has('check'))
                                        <div class="alert alert-success">
                                            <h5 class="text-center">@lang('blog.application_status_info')</h5><br>
                                            <p>@lang('blog.application_reg_number'): <span>{{session()->get('check')->unique_number}}</span></p>
                                            <p>@lang('blog.application_date_submitted'): <span>{{session()->get('check')->created_at}}</span></p>
                                            @switch(session()->get('check')->status)
                                                @case(0)
                                            <p>@lang('blog.application_status'): <span>@lang('blog.application_status_new')</span></p>
                                                @break
                                                @case(1)
                                                <p>@lang('blog.application_status'): <span>@lang('blog.application_status_in_process')</span></p>
                                                @break
                                                @case(2)
                                                <p>@lang('blog.application_status'): <span>@lang('blog.application_status_in_review')</span></p>
                                                @break
                                                @case(3)
                                                <p>@lang('blog.application_status'): <span>@lang('blog.application_status_replied')</span></p>
                                                @break
                                            @endswitch
                                        </div>
                                    @endif
                                </div>
                            </div>
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
                            Жисмоний ва юридик шахслар мурожаатлари
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
                <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><img class="img-responsive center-block" src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}" alt=""></a>
            </div>
            <div class="col-xs-8">
                <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><h6>{{$tender->title}}</h6></a>
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
