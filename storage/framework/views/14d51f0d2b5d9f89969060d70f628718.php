
<?php $__env->startSection('content'); ?>
    <!-- page-header start-->
  	<section class="video_page-header insight_page-header2">
  		<div class="in_video">
            <video autoplay muted loop>
                  <source src="<?php echo e(asset('assets/assets/img/insight/header.mp4')); ?>" type="video/mp4">
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
                        <form action="<?php echo e(route('products')); ?>" method="GET">
    <div class="search-top_form">
        <!-- Category -->
        <div class="inight_filter-list">
            <select class="form-select" name="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                        <?php echo e($cat->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Language -->
        <div class="inight_filter-list">
            <select class="form-select" name="language" onchange="this.form.submit()">
                <option value="">All Languages</option>
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lang->id); ?>" <?php echo e(request('language') == $lang->id ? 'selected' : ''); ?>>
                        <?php echo e($lang->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Feature -->
        <div class="inight_filter-list">
            <select class="form-select" name="feature" onchange="this.form.submit()">
                <option value="">All Features</option>
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($feature->id); ?>" <?php echo e(request('feature') == $feature->id ? 'selected' : ''); ?>>
                        <?php echo e($feature->title); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Search -->
        <div class="inight_filter-list">
            <input type="text" name="search" placeholder="Search products..." value="<?php echo e(request('search')); ?>" class="form-control" onkeypress="if(event.key === 'Enter'){ this.form.submit(); }">
        </div>

        <!-- Sort -->
        <div class="inight_filter-list">
            <select class="form-select" name="sort" onchange="this.form.submit()">
                <option value="popular" <?php echo e(request('sort') == 'popular' ? 'selected' : ''); ?>>Most Popular</option>
                <option value="recent" <?php echo e(request('sort') == 'recent' ? 'selected' : ''); ?>>Recent</option>
            </select>
        </div>
    </div>
</form>

                    </div>
               </div>
            </div>
            <br>
<div class="row">
    <?php if($products->count() > 0): ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="insight-blog-single">
                    <div class="img">
                        <?php if($product->images->count() > 0): ?>
                            <img src="<?php echo e(asset($product->images->first()->image)); ?>" alt="<?php echo e($product->title); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/assets/img/default.jpg')); ?>" alt="<?php echo e($product->title); ?>">
                        <?php endif; ?>

                        <div class="read_more-now">
                            <div class="icon"><i class="far fa-comment-alt"></i></div>
                            <h4>
                                <a href="<?php echo e(route('product.details', $product->id)); ?>">more</a>
                            </h4>
                        </div>
                    </div>

                    <div class="insight-content">
                        <h3>
                            <a href="<?php echo e(route('product.details', $product->id)); ?>">
                                <?php echo e($product->title); ?>

                            </a>
                        </h3>

                        <p><?php echo e(Str::limit($product->description, 80)); ?></p>

                        <div class="insight-btn">
                            <ul>
                                
                                <!-- <?php if($product->category): ?>
                                    <li>
                                        <a href="<?php echo e(route('products', ['category' => $product->category->id])); ?>">
                                            <?php echo e($product->category->name); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                
                                <?php $__currentLoopData = $product->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('products', ['language' => $language->id])); ?>">
                                            <?php echo e($language->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->

                                
                                <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('products', ['feature' => $feature->id])); ?>">
                                            <?php echo e($feature->title); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <h3 class="text-gray-600">😕 No products found!</h3>
            <p>Try changing your filters or search keyword.</p>
        </div>
    <?php endif; ?>
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
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/template/products.blade.php ENDPATH**/ ?>