@extends('layouts.app')

@section('content')
<section class="px-lg-5 px-3 pb-1">
    <div class="responsive" id="category_chips">
        <div class="item">
            <a href="{{route('home')}}" class="btn btn-sm rounded-pill text-capitalize hcolor py-2 px-3" role="button"><p class="h6 m-0">Home</p></a>
        </div>
        @if ($new_counts)
            <div class="item">
                <button class="categoryType btn btn-sm rounded-pill text-capitalize hcolor py-2 px-3" value="Newcomer" role="button">
                    <p class="h6 m-0">Newcomer<span class="h6 ml-2">{{$new_counts}}</span></p>
                </button>
            </div>
        @endif
        @if ($fet_counts)
            <div class="item">
                <button class="categoryType btn btn-sm rounded-pill text-capitalize hcolor py-2 px-3" value="Featured" role="button">
                    <p class="h6 m-0">Featured<span class="h6 ml-2">{{$fet_counts}}</span></p>
                </button>
            </div>
        @endif
        @foreach ($categorie_counts as $key => $item)
            <div class="item">
                <button class="categoryType btn btn-sm rounded-pill text-capitalize hcolor py-2 px-3" value="{{$item->ct_name}}" role="button">
                    <p class="h6 m-0">{{$item->ct_name}}<span class="h6 ml-2">{{$item->ct_count}}</span></p>
                </button>
            </div>
        @endforeach
    </div>
</section>
<section class="pb-4">
    <!--Carousel Wrapper-->
    <div id="main-carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators mb-0">
            @foreach ($bannerlist as $key => $item)
                <li data-target="#main-carousel" data-slide-to="{{$key}}" class="{{($key == 0) ? 'active' : ''}}"></li>
            @endforeach
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            @forelse ($bannerlist as $key => $item)
                <div class="carousel-item {{($key == 0) ? 'active' : ''}}">
                    <div class="view">
                        <img class="d-block w-100" src="{{asset('storage/content/banners/' . $item->banner)}}">
                    </div>
                </div>
            @empty
                <img class="d-block w-100" src="{{asset('images/banner.jpg')}}">
            @endforelse
            {{-- <div class="carousel-item active">
                <div class="view">
                    <img class="d-block w-100" src="{{asset('images/bak-img/back-img-4.jpg')}}" alt="First slide">
                </div>
                //
                <div class="carousel-caption">
                    <h1 class="text-left mb-4"></h1>
                    <!-- Search form -->
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <button class="btn btn-md btn-special gcolor text-capitalize my-0 mr-3 ml-0 px-5 py-2 z-depth-0 waves-effect rounded-pill"
                                type="button" id="search-talent">Find talent</button>
                        </div>
                        <input type="text" class="form-control text-secondary rounded-pill"
                            style="border-width:3px;border-color:#a12373;" placeholder="Find your celebrities"
                            aria-label="Example text with button addon" aria-describedby="search-talent">
                    </div>
                </div>
                //
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="{{asset('images/bak-img/back-img-2.jpg')}}" alt="First slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="{{asset('images/bak-img/back-img-3.jpg')}}" alt="First slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
            </div> --}}
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
</section>

<section id="category-section" class="px-lg-5 px-3">

    <!--/.Newcomer-->
    <div class="pb-4">
        <div class="d-flex justify-content-between align-items-end">
            <p class="h3 font-width-bolder">Newcomer</p>
            <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="Newcomer">See all <i class="fas fa-angle-double-right ml-2"></i></button>
        </div>
        <div class="responsive" id="talent_card-newcomer">
            @foreach ($newtalent as $item)
                <div class="item">
                    <div class="card unique-color-dark border border-0">
                        <!--Card image-->
                        <div class="view zoom text-center rounded">
                            <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                            <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                <div class="mask d-flex align-items-end justify-content-end p-2">
                                    <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                </div>
                            </a>
                        </div>
                        <div class="mt-2 px-2">
                            <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                            <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--/.Featured-->
    <div class="pb-4">
        <div class="d-flex justify-content-between align-items-end">
            <p class="h3 font-width-bolder">Featured</p>
            <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="Featured">See all <i class="fas fa-angle-double-right ml-2"></i></button>
        </div>
        <div class="responsive" id="talent_card-feature">
            @foreach ($featalent as $item)
                <div class="item">
                    <div class="card unique-color-dark border border-0">
                        <!--Card image-->
                        <div class="view zoom text-center rounded">
                            <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                            <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                <div class="mask d-flex align-items-end justify-content-end p-2">
                                    <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                </div>
                            </a>
                        </div>
                        <div class="mt-2 px-2">
                            <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                            <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--/. Category 2-->
    @if (count($ctg_2) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_2[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_2[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-2">
                @foreach ($ctg_2 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 3-->
    @if (count($ctg_3) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_3[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_3[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-3">
                @foreach ($ctg_3 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 4-->
    @if (count($ctg_4) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_4[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_4[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-4">
                @foreach ($ctg_4 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 5-->
    @if (count($ctg_5) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_5[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_5[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-5">
                @foreach ($ctg_5 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 6-->
    @if (count($ctg_6) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_6[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_6[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-6">
                @foreach ($ctg_6 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 7-->
    @if (count($ctg_7) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_7[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_7[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-7">
                @foreach ($ctg_7 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 8-->
    @if (count($ctg_8) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_8[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_8[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-8">
                @foreach ($ctg_8 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!--/. Category 9-->
    @if (count($ctg_9) > 0)
        <div class="pb-4">
            <div class="d-flex justify-content-between align-items-end">
                <p class="h3 font-width-bolder">{{$ctg_9[0]->category}}</p>
                <button type="button" class="categoryType btn btn-lg btn-link text-capitalize text-white seeAll mx-0 p-0" value="{{$ctg_9[0]->category}}">See all <i class="fas fa-angle-double-right ml-2"></i></button>
            </div>
            <div class="responsive" id="talent_card-9">
                @foreach ($ctg_9 as $item)
                    <div class="item">
                        <div class="card unique-color-dark border border-0">
                            <!--Card image-->
                            <div class="view zoom text-center rounded">
                                <img class="img_size img-fluid mh-auto" src="{{$item->avatar ? asset('storage/content/avatar/' . $item->avatar) : asset('images/no_avatar.png')}}">
                                <a href="{{route('talent.profile', ['username' => $item->username])}}">
                                    <div class="mask d-flex align-items-end justify-content-end p-2">
                                        <p class="h6 text-white mb-0">৳ {{$item->vid_price}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 px-2">
                                <h6 class="text-light font-weight-bold mb-0">{{$item->name}}</h6>
                                <p class="text-light mb-0"><small><i>{{$item->category}}</i></small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</section>
@endsection
