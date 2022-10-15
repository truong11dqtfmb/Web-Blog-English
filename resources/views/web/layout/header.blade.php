<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('web') }}"><img src="images/version/tech-logo.png" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link btn" href="{{ route('web') }}"> <b style="font-size: 18px;"> ĐQT BLOG HOME </b></a>
                    </li>

                    @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.category',$category->id) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
                
                <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('web.search')}}">
                    <input class="form-control mr-sm-2" type="text" required name="key" placeholder="Search">
                    <button class="btn btn-danger " type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->