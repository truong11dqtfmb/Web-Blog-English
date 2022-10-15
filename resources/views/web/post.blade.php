@extends('web.layout.master')

@section('title')
    {{ $post->title }}
@endsection
@section('content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="{{ route('web') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.category',$post->category->id) }}">Blog</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('web.post',$post->id) }}">{{ $post->title }}</a></li>
                        </ol>

                        <span class="color-orange"><a href="{{ route('web.category',$post->category->id) }}" title="">{{ $post->category->name }}</a></span>

                        <h3>{{ $post->title }}</h3>

                        <div class="blog-meta big-meta">
                            <small><a href="{{ route('web') }}" title="">{{ $post->created_at }}</a></small>
                        </div><!-- end meta -->

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="{{ route('web') }}" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="{{ route('web') }}" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="{{ route('web') }}" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div><!-- end post-sharing -->
                    </div><!-- end title -->

                    <div class="single-post-media">
                        <img src="{{ $post->imageUrl() }}" alt="" width="500px" height="700px" >
                    </div><!-- end media -->

                    <div class="blog-content">  
                        <div class="pp">
                            {{-- <p>{{ $post->sumary }} </p> --}}

                            <i>{{ $post->sumary }}</i>


                            <p>{!! $post->content !!}</p>

                        </div><!-- end pp -->



                            
                        </div><!-- end pp -->
                    </div><!-- end content -->



                    <div class="custombox clearfix">
                        <h4 class="small-title">Bài Viết Liên Quan</h4>
                        <div class="row">
                            @foreach ($relate as $rela)
                                
                            <div class="col-lg-4">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{ route('web.post',$rela->id) }}" title="">
                                            <img src="{{ $rela->imageUrl() }}" alt="" width="200px" height="200px" >
                                            <div class="hovereffect">
                                                <span class=""></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta">
                                        <h4><a href="{{ route('web.post',$rela->id) }}" title="">{{ $rela->title }}</a></h4>
                                        <small><a href="{{ route('web.post',$rela->id) }}" title=""> {{ $rela->created_at }}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                            @endforeach

                        </div><!-- end row -->
                    </div><!-- end custom-box -->



                </div><!-- end page-wrapper -->
            </div><!-- end col -->


        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection