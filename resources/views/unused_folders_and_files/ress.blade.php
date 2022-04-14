<rss version="2.0">

  <channel>
    <title>{{ $title }}</title>
    <link>{{ URL('/') }}</link>
    <description>{{ $title }}</description>

    @foreach($table as $value)

    <item>
      <title>{{ $value["title"] }}</title>
      <link>{{ $value["link"] }}</link>
      <description>{!! $value["description"] !!} </description>
    </item>
    @endforeach

  </channel>

</rss>
