<ul class="nav navbar-nav nav-font">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop<b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            @foreach ($category as $item )
            <li><a href="/shopphp/san-pham/{{ $item-> SeoTitle }}/{{ $item -> id }}">{{ $item -> CategoryName }}</a></li>
            @endforeach
            
        </ul>
    </li>
    
    <div class="clearfix"></div>
</ul>