<ul class="nav navbar-nav nav-font">
    @foreach ($category as $item )
    <li class="dropdown">
        <a href="/shopphp/san-pham/{{ $item-> SeoTitle }}/{{ $item -> id }}">{{ $item -> CategoryName }}</a>
    </li>
    @endforeach
    <div class="clearfix"></div>
</ul>