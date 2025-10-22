@extends('layouts.master')
@section('content')
    <!-- page-header start-->
  	<section class="video_page-header insight_page-header2">
  		<div class="in_video">
            <video autoplay muted loop>
                  <source src="{{ asset('assets/assets/img/insight/header.mp4') }}" type="video/mp4">
            </video>
            <div class="insight_page-content">
				<div class="insight_page-text">
					<h3>All In One</h3>
                    <h2><span>Onlien </span>Product</h2>
					<p>You will get all the products you like. Welcome to our digital products from CreativeSoft.</p>
				</div>
			</div>
        </div>
  	</section>
    <!-- page-header end-->
    <!-- insight-blog start -->
    <section class="ingsight_blog-page pt-80">
        <div class="container container-menu">
            <div class="row pb-40">
               <div class="col-lg-12">
                    <div class="insight_filtering-top mt-5">
                        <form action="{{ route('products') }}" method="GET">
    <div class="search-top_form">
        <!-- Category -->
        <div class="inight_filter-list">
            <select class="form-select" name="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Language -->
        <div class="inight_filter-list">
            <select class="form-select" name="language" onchange="this.form.submit()">
                <option value="">All Languages</option>
                @foreach($languages as $lang)
                    <option value="{{ $lang->id }}" {{ request('language') == $lang->id ? 'selected' : '' }}>
                        {{ $lang->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Feature -->
        <div class="inight_filter-list">
            <select class="form-select" name="feature" onchange="this.form.submit()">
                <option value="">All Features</option>
                @foreach($features as $feature)
                    <option value="{{ $feature->id }}" {{ request('feature') == $feature->id ? 'selected' : '' }}>
                        {{ $feature->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Search -->
        <div class="inight_filter-list">
            <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" class="form-control" onkeypress="if(event.key === 'Enter'){ this.form.submit(); }">
        </div>

        <!-- Sort -->
        <div class="inight_filter-list">
            <select class="form-select" name="sort" onchange="this.form.submit()">
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Recent</option>
            </select>
        </div>
    </div>
</form>

                    </div>
               </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="insight-blog-single">
                            <div class="img">
                                {{-- যদি multiple image থাকে, প্রথমটা দেখাও --}}
                                @if($product->images->count() > 0)
                                   <img src="{{ asset($product->images->first()->image) }}" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('assets/assets/img/default.jpg') }}" alt="default">
                                @endif

                                <div class="read_more-now">
                                    <div class="icon"><i class="far fa-comment-alt"></i></div>
                                    <h4>
                                        <a href="{{ route('product.details', $product->id) }}">more</a>
                                    </h4>
                                </div>
                            </div>

                            <div class="insight-content">
                                <h3>
                                    <a href="{{ route('product.details', $product->id) }}">
                                        {{ $product->title }}
                                    </a>
                                </h3>

                                <p>{{ Str::limit($product->description, 80) }}</p>

                                <div class="insight-btn">
                                    <ul>
                                        {{-- Category --}}
                                        @if($product->category)
                                            <li><a href="#">{{ $product->category->name }}</a></li>
                                        @endif

                                        {{-- Languages --}}
                                        @foreach($product->languages as $language)
                                            <li><a href="#">{{ $language->name }}</a></li>
                                        @endforeach

                                        {{-- Features --}}
                                        @foreach($product->features as $feature)
                                            <li><a href="#">{{ $feature->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
        <div class="transparent-grid">
            <div class="transparent-grid__container">
                <div class="transparent-grid__row">
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- insight-blog end -->
    <!-- collection start -->
    <section class="collection-area" style="background-image:url('assets/img/collection/bg.png');">
        <div class="container container-menu">
            <div class="row">
                <div class="col-lg-12">
                    <div class="collection-header">
                        <h4 class="home-intro__overheading underlined-heading underlined-heading--animate">
                            <span class="underlined-heading__wrapper">
                                <span class="underlined-heading__content">
                                    Content Collection
                                </span>
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="row pt-40">
                <div class="col-lg-12">
                    <div class="tabs_collect-content" id="tabs_collection">
                        <ul>
                            <li><a href="#tabs-1">Mobile App Development</a></li>
                            <li><a href="#tabs-2">Web App Development</a></li>
                            <li><a href="#tabs-5">outsourcing</a></li>
                            <li><a href="#tabs-3">Product Development</a></li>
                            <li><a href="#tabs-4">Software Modernization</a></li>
                        </ul>
                        <!-- tabs single -->
                        <div id="tabs-1" class="tabs-description">
                            <div class="tabs_slide-content-all">
                                <div class="tabs_sliders owl-carousel owl-theme">
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/in7.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Mediplant Mobile App</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">mobile</a></li>
                                                    <li><a href="#">laravel</a></li>
                                                    <li><a href="#">c#</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/in.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Mobile App Development</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tabs single -->
                        <div id="tabs-2" class="tabs-description">
                            <div class="tabs_slide-content-all">
                                <div class="tabs_sliders owl-carousel owl-theme">
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/tabs/1.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>web development roadmap</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">react js</a></li>
                                                    <li><a href="#">type script</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/tabs/2.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Mobile App Development</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tabs single -->
                        <div id="tabs-3" class="tabs-description">
                           <div class="tabs_slide-content-all">
                                <div class="tabs_sliders owl-carousel owl-theme">
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/tabs/1.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Mobile App Development</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">sqa expart</a></li>
                                                    <li><a href="#">it manager</a></li>
                                                    <li><a href="#">development</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/in.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Most Beautiuful themes</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">it sector</a></li>
                                                    <li><a href="#">Java</a></li>
                                                    <li><a href="#">programing</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tabs single -->
                        <div id="tabs-4" class="tabs-description">
                           <div class="tabs_slide-content-all">
                                <div class="tabs_sliders owl-carousel owl-theme">
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/in4.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Foodie app Development</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">software</a></li>
                                                    <li><a href="#">app</a></li>
                                                    <li><a href="#">mobile</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/in2.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Full responsive development</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">backend</a></li>
                                                    <li><a href="#">frontend</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tabs single -->
                        <div id="tabs-5" class="tabs-description">
                           <div class="tabs_slide-content-all">
                                <div class="tabs_sliders owl-carousel owl-theme">
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/tabs/1.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Mobile App Development</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                    <li><a href="#">it challange</a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabs_items">
                                        <div class="tabs_image">
                                            <img src="{{ asset('assets/assets/img/insight/tabs/2.jpg') }}" alt="tabs">
                                        </div>
                                        <div class="tabs_text">
                                            <div class="tabs_title">
                                                <h4>Best Software 2024</h4>
                                            </div>
                                            <div class="tabs_button">
                                                <ul>
                                                    <li><a href="#">docker</a></li>
                                                    <li><a href="#">github</a></li>
                                                    <li><a href="#">gitlab </a></li>
                                                </ul>
                                            </div>
                                            <div class="tabs_descrip">
                                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Iste illum ipsum aspernatur rerum consectetur ea illo modi maxime quisquam blanditiis nulla debitis itaque, odio! Soluta aut incidunt aperiam praesentium optio.</p>
                                            </div>
                                            <div class="more_now">
                                                <a href="#">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="transparent-grid">
            <div class="transparent-grid__container">
                <div class="transparent-grid__row">
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                </div>
            </div>
        </div>
    </section>
    <!--collection end -->
    <!-- office membar -->
    <section class="our_office-boss">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="membar-head">
                        <h4>Check out our interesting projects with our members</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="experts-chefs-slider">
                      <div class="tab-content text-center">
                        <div id="chef-1" class="tab-pane fade active in">
                          <div class="image-before hidden-sm hidden-xs">
                            <h2>I love <span>to</span><span>Made</span></h2>
                          </div>
                          <div class="image-content"><img src="{{ asset('assets/assets/img/membar/ceo.png') }}" alt="chef photo">
                            <h3 class="author-name">Nurulhuda Liton</h3>
                            <h5 class="author-designation">For Founders & CEOs</h5>
                          </div>
                          <div class="image-after hidden-sm hidden-xs">
                            <h2>React-<span>and</span><span>Vue js</span></h2>
                          </div>
                        </div>
                        <div id="chef-2" class="tab-pane fade">
                          <div class="image-before hidden-sm hidden-xs">
                            <h2>I love <span>to</span><span>Cook</span></h2>
                          </div>
                          <div class="image-content"><img src="{{ asset('assets/assets/img/membar/md.png') }}" alt="chef photo">
                            <h3 class="author-name">Rakib Smith</h3>
                            <h5 class="author-designation">Head of Technology</h5>
                          </div>
                          <div class="image-after hidden-sm hidden-xs">
                           <h2>Python<span>and</span><span>App</span></h2>
                          </div>
                        </div>
                        <div id="chef-3" class="tab-pane fade">
                          <div class="image-before hidden-sm hidden-xs">
                            <h2>I love <span>to</span><span>Made</span></h2>
                          </div>
                          <div class="image-content"><img src="{{ asset('assets/assets/img/membar/founder.png') }}" alt="chef photo">
                            <h3 class="author-name">Zenifer Smith</h3>
                            <h5 class="author-designation">Head of Business Development</h5>
                          </div>
                          <div class="image-after hidden-sm hidden-xs">
                            <h2>Node-<span>and</span><span>React</span></h2>
                          </div>
                        </div>
                      </div><!--/.carousel-inner-->
                    </div><!--/.carousel-->
                </div>
                <div class="membar-nav">
                    <ul class="experts-chefs-nav">
                        <li class="active"><a href="#chef-1" data-toggle="tab" class="nav-image" aria-expanded="true"><img src="{{ asset('assets/assets/img/membar/ceo.png') }}" alt="chef photo"></a></li>
                        <li class=""><a href="#chef-2" data-toggle="tab" class="nav-image" aria-expanded="false"><img src="{{ asset('assets/assets/img/membar/md.png') }}" alt="chef photo"></a></li>
                        <li class=""><a href="#chef-3" data-toggle="tab" class="nav-image" aria-expanded="false"><img src="{{ asset('assets/assets/img/membar/founder.png') }}" alt="chef photo"></a></li>
                    </ul>
                </div>
            </div>
        </div>
       <div class="transparent-grid">
            <div class="transparent-grid__container">
                <div class="transparent-grid__row">
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                </div>
            </div>
        </div>
    </section>
@endsection 