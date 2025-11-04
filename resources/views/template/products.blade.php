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
            <br>
<div class="row">
    @if($products->count() > 0)
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6">
                <div class="insight-blog-single">
                    <div class="img">
                        @if($product->images->count() > 0)
                            <img src="{{ asset($product->images->first()->image) }}" alt="{{ $product->title }}">
                        @else
                            <img src="{{ asset('assets/assets/img/default.jpg') }}" alt="{{ $product->title }}">
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
                                <!-- @if($product->category)
                                    <li>
                                        <a href="{{ route('products', ['category' => $product->category->id]) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </li>
                                @endif

                                {{-- Languages --}}
                                @foreach($product->languages as $language)
                                    <li>
                                        <a href="{{ route('products', ['language' => $language->id]) }}">
                                            {{ $language->name }}
                                        </a>
                                    </li>
                                @endforeach -->

                                {{-- Features --}}
                                @foreach($product->features as $feature)
                                    <li>
                                        <a href="{{ route('products', ['feature' => $feature->id]) }}">
                                            {{ $feature->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center py-5">
            <h3 class="text-gray-600">😕 No products found!</h3>
            <p>Try changing your filters or search keyword.</p>
        </div>
    @endif
</div>

            <br><br>
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

    <div class="h-25"></div>
@endsection 