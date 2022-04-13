@extends('layout.defualt')
@section('top-menu')
<div class="top-menu">
    @include('layout.menu')
</div>
@endsection
@section('suvfaoliati')
@foreach($suv_xujaliks as $val)
<a href="{{url(App::getLocale().'/page/'.$val->page_category_group_id.'/'.$val->page_group_id)}}"
    class="list-group-item"><img src="{{URL(App::getLocale().'/downloads?type=page&id='.$val->page_group_id)}}" alt=""
        width="30" height="30" />
    <p>{{$val->title}}</p>
</a>
@endforeach
@endsection
@section('newsblok')
<br />
<div class="row" style="margin: 0">
    @if(count($posts) >= 2)
    @for($i=0;$i< 2;$i++) <div class="col-sm-6">
        <a href="{{URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)}}"><img
                class="img-responsive" src="{{URL(App::getLocale().'/downloads?type=post&id='.$posts[$i]->group)}}"
                alt=""></a>
        <h4><a
                href="{{URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)}}">{{$posts[$i]->title}}</a>
        </h4>
        <?php $date=date_create($posts[$i]->datetime) ?>
        <h6>{{date_format($date,"d.m.Y H:i")}}</h6>
</div>
@endfor
@else
@for($i=0;$i< count($posts);$i++) <div class="col-sm-6">
    <a href="{{URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)}}"><img
            class="img-responsive" src="{{URL(App::getLocale().'/downloads?type=post&id='.$posts[$i]->group)}}"
            alt=""></a>
    <h4><a
            href="{{URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)}}">{{$posts[$i]->title}}</a>
    </h4>
    <?php $date=date_create($posts[$i]->datetime) ?>
    <h6>{{date_format($date,"d.m.Y H:i")}}</h6>
    </div>
    @endfor
    @endif
    </div>
    @for($i=2;$i< count($posts);$i++) <div class="row" style="margin: 0;">
        <div class="col-sm-4"><br />
            <a href="{{URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)}}">
                <img class="img-responsive" src="{{URL(App::getLocale().'/downloads?type=post&id='.$posts[$i]->group)}}"
                    alt="">
            </a>
        </div>
        <div class="col-sm-8">
            <h4><a
                    href="{{URL(App::getLocale().'/posts/'.$posts[$i]->category_group_id.'/'.$posts[$i]->group)}}">{{$posts[$i]->title}}</a>
            </h4>
            <?php $date=date_create($posts[$i]->datetime) ?>
            <h6>{{date_format($date,"d.m.Y | H:i")}}</h6>
            <p>{!! $posts[$i]->decription !!}</p>
        </div>
        </div>
        @endfor
        @endsection
        @section('sorovnoma')
        @endsection
        @section('tender')
        @foreach($tenders as $key=>$tender)
        <div class="row">
            <div class="col-xs-4" style="padding-top: 10px">
                <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><img
                        class="img-responsive center-block"
                        src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}" alt=""></a>
            </div>
            <div class="col-xs-8 force-margin">
                <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}">
                    <h6>{{$tender->title}}</h6>
                </a>
            </div>
        </div>
        @endforeach
        @endsection