<?php $__env->startSection('title'); ?>
    Searched Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <section>
        <div class="category_breadcrumb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <p>
                            <a href="<?php echo e(route('home')); ?>">Home</a>
                            /
                            Searched For "<?php echo e($query); ?>"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="main-products-section">
            <div class="container-fluid">
                <div class="row m-0">
                    <?php if($data->count() > 0): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2 col-6 main-product">
                                <div class="main-product-inner-wrapper text-center">
                                    <a href="<?php echo e(route('product.details',[$item->slug, $item->id])); ?>">
                                        <img src="<?php echo e($item->image_url ?? asset('frontEnd/images/no_image.png')); ?>" alt="<?php echo e($item->name); ?>">
                                    </a>
                                    <?php if($item->sale_price != 0): ?>
                                        <p class="mb-0" style="text-decoration: line-through;color: #b8b8b8"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                        <p class="font-weight-bold mb-0" style="color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->sale_price); ?></p>
                                    <?php else: ?>
                                        <p class="font-weight-bold mb-0" style="margin-top: 24px;color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                    <?php endif; ?>
                                    <p class="mb-0 prod_name"><a href="<?php echo e(route('product.details',[$item->slug, $item->id])); ?>"><?php echo e($item->name); ?></a></p>
                                    <form action="<?php echo e(route('add.cart', $item->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="qty" value="1">
                                        <input type="submit" class="btn btn-sm w-100 mb-2 order_now_btn" name="order_now" value="অর্ডার করুন">
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-md-5 my-md-5">
                            <h2 class="mb-md-4" style="color: red;font-weight: bold">দুঃখিত কোন পণ্য পাওয়া যায়নি</h2>
                            <a href="<?php echo e(route('home')); ?>" class="btn btn-info px-5">হোম</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-12 mt-3">
                        <?php echo e($data->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\cache-newmartbd\resources\views/searched_products.blade.php ENDPATH**/ ?>