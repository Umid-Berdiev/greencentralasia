<b>FROM</b> <i>{{ $demo->sender }}</i>,
@switch($demo->type)
    @case('contact')
    <p><b>Форма обращения:</b>Обратная связь</p>
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Ф.И.О. заявителя:</b>&nbsp;{{ $demo->demo_one }}</p>
        <p><b>Эл. почта заявителя: </b>{{$demo->fio}}</p>
        <pre><b>Текст сообщения:</b><br>&nbsp;{{ $demo->demo_two }}</pre>
    </div>
    @break
    @case('contact_client')
    <div>
        <p><b>Мурожаатингиз қабул қилинди. </b></p>
    </div>
    @break
    @case('murojat')
    <div>
        <p><b>Форма обращения:</b>Обращение граждан </p>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Ф.И.О. заявителя:</b>{{ $demo->fio }}</p>
        <p><b>UNIQUE_NUMBER:</b>&nbsp;{{ $demo->demo_one }}</p>
        <pre><b>Текст сообщения:</b><br>&nbsp;{{ $demo->demo_two }}</pre>
    </div>
    @break
    @case('cv')
    <div>
        <p><b>Форма обращения:</b>Отправка резюме </p>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Ф.И.О. заявителя:</b>{{ $demo->fio }}</p>
        <p><b>UNIQUE_NUMBER:</b>&nbsp;{{ $demo->demo_one }}</p>
        <pre><b>Текст сообщения:</b><br>&nbsp;{{ $demo->demo_two }}</pre>
        <p><a href="{{$demo->link}}"><b>Вложение:</b></a></p>
    </div>
    @break
    @case('murojat_client')
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Мурожаатингиз қабул қилинди. </b></p>
        <p><b>Ф.И.О. заявителя:</b>{{ $demo->fio }}</p>
        <p><b>Аризангизни руйхат рақами:</b>&nbsp;{{ $demo->demo_one }}</p>
    </div>
    @break
    @case('murojat_re')
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
        <p><b>Мурожаатингиз Мақоми ўзгарди </b></p>
        @switch( $demo->fio)
            @case(0)
        <p><b>Мақоми : </b>Янги мурожаат</p>
            @break
            @case(1)
            <p><b>Мақоми : </b>Қайта ишланмоқда</p>
            @break
            @case(2)
            <p><b>Мақоми : </b>Кўриб чиқилмоқда</p>
            @break
            @case(3)
            <p><b>Мақоми : </b>Жавоб жўнатилди</p>
            @break
        @endswitch
        <p><b>Аризангизни руйхат рақами:</b>&nbsp;{{ $demo->demo_one }}</p>
    </div>
    @break
    @case('obuna')
    <div>
        <p><b>Источник обращения:</b><a href="http://water.gov.uz">Вебсайт Минводхоз РУз</a></p>
    <?php $date=date_create($demo->demo_two) ?>
        <p><b>{{ $demo->demo_one }} </b></p>
        <p><b>DATE:{{date_format($date,"d.m.Y H:i")}} </b></p>
            <a href="{{URL(App::getLocale().'/obuna/delete?id='.$demo->id)}}"><b>Отписаться от рассылок</b></a>
       <pre>{!! $demo->fio !!}</pre>
    </div>
    @break
    @case('orph')
    <div>

        <p>errortext : <b>{{ $demo->demo_one }} </b></p>
        <p>comment :<pre>{!! $demo->fio !!}</pre></p>
    </div>
    @break

    @endswitch



