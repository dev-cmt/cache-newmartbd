<?php $__env->startSection('title'); ?>
    Home
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <div id="home_slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li data-target="#home_slider" data-slide-to="<?php echo e($key); ?>" <?php if($key==0): ?> class="active" <?php endif; ?>></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
        <div class="carousel-inner">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item <?php echo e($key==0 ? "active":""); ?>">
                    <img src="<?php echo e($item->image_url ? $item->image_url : asset('frontEnd/images/no_image.png')); ?>" class="d-block w-100"
                         alt="<?php echo e($item->title ?? ''); ?>">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    

    <section>
        <div class="hot-deals">
            <div class="container-fluid">
                <div class="row title">
                    <div class="col-md-6 col-6">
                        <h4 class="my-2">Featured Products</h4>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="view-all-btn text-right mt-1">
                            <a href="<?php echo e(route('all.hot.deals')); ?>">View All <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="hot-deals-inner-wrapper">
                            <div class="owl-carousel mb-3">
                                <?php $__currentLoopData = $hot_deal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $percentage = $item->price > 0 ? round(100 - (($item->sale_price / $item->price) * 100)) : 0;
                                    ?>
                                    <div class="main-product-inner-wrapper text-center">
                                        <a href="<?php echo e(route('product.details',[$item->slug,$item->id])); ?>">
                                            <img src="<?php echo e($item->image_url ?? asset('frontEnd/images/no_image.png')); ?>"
                                                 alt="<?php echo e($item->name); ?>">
                                        </a>
                                        <?php if($item->sale_price != 0): ?>
                                            <p class="mb-0" style="text-decoration: line-through;color: #b8b8b8"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                            <p class="font-weight-bold mb-0" style="color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->sale_price); ?></p>
                                        <?php else: ?>
                                            <p class="font-weight-bold mb-0" style="margin-top: 24px;color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                        <?php endif; ?>
                                        <p class="mb-0 prod_name"><a href="<?php echo e(route('product.details',[$item->slug,$item->id])); ?>"><?php echo e($item->name); ?></a></p>
                                        <form action="<?php echo e(route('add.cart',$item->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="qty" value="1">
                                            <input type="submit" class="btn btn-sm w-100 mb-2 order_now_btn" name="order_now" value="অর্ডার করুন">
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="main-products-section">
            <div class="container-fluid">
                <div class="row title">
                    <div class="col-md-6 col-6">
                        <h4 class="my-2">All Products</h4>
                    </div>
                </div>
                <div class="row m-0">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 col-6 main-product">
                            <div class="main-product-inner-wrapper text-center">
                                <a href="<?php echo e(route('product.details',[$item->slug,$item->id])); ?>">
                                    <img src="<?php echo e($item->image_url ?? asset('frontEnd/images/no_image.png')); ?>" alt="<?php echo e($item->name); ?>">
                                </a>
                                <?php if($item->sale_price != 0): ?>
                                    <p class="mb-0" style="text-decoration: line-through;color: #b8b8b8"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                    <p class="font-weight-bold mb-0" style="color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->sale_price); ?></p>
                                <?php else: ?>
                                    <p class="font-weight-bold mb-0" style="margin-top: 24px;color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                <?php endif; ?>
                                <p class="mb-0 prod_name"><a href="<?php echo e(route('product.details',[$item->slug,$item->id])); ?>"><?php echo e($item->name); ?></a></p>
                                <form action="<?php echo e(route('add.cart',$item->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="qty" value="1">
                                    <input type="submit" class="btn btn-sm w-100 mb-2 order_now_btn" name="order_now" value="অর্ডার করুন">
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="row mt-md-4 mt-2">
                    <div class="col-12">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                margin: 15,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        margin: 10,
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });

            $('.owl-nav').remove();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\cache-newmartbd\resources\views/index.blade.php ENDPATH**/ ?>