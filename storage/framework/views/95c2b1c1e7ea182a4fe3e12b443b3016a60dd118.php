<?php $__env->startSection('title'); ?>
    Checkout
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backEnd/assets/vendor/select2/css/select2.css')); ?>">
    <style>
        /* Sticky Mobile Submit Button */
        @media (max-width: 767.98px) {
            #conf_order_btn {
                position: fixed;
                bottom: 12px;                  /* Gap from the bottom edge */
                left: 15px;                    /* Left side gap */
                width: calc(100% - 30px) !important; /* Total width minus left + right gap */
                z-index: 9999;
                margin-bottom: 0 !important;
                border-radius: 8px;           /* Rounded corners for floating look */
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php if(\Cart::getContent()->count() > 0): ?>
<?php $__env->startSection('tracking'); ?>
    <script>
        dataLayer.push({ecommerce: null});  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                currency: "BDT",
                value: <?php echo e(session('api_begin_checkout_data')['value'] ?? 0); ?>,
                coupon: "",
                items: <?php echo session('api_begin_checkout_data')['products'] ?? '[]'; ?>

            }
        });
        if (typeof fbq === 'function') {
            var checkoutItems = <?php echo session('api_begin_checkout_data')['products'] ?? '[]'; ?>;
            fbq('track', 'InitiateCheckout', {
                content_ids: checkoutItems.map(function (item) { return item.item_id; }),
                content_type: 'product',
                num_items: checkoutItems.reduce(function (total, item) { return total + (Number(item.quantity) || 0); }, 0),
                value: <?php echo e(session('api_begin_checkout_data')['value'] ?? 0); ?>,
                currency: 'BDT'
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('body'); ?>
    <?php if(\Cart::getContent()->count() > 0): ?>
        <section>
            <div class="cart-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-12 mb-md-0 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="font-weight-bold mb-0">কাস্টমার ইনফরমেশন</h6>
                                </div>
                                <div class="card-body p-2">
                                    <p class="text-center">
                                        অর্ডারটি কনফার্ম করতে আপনার নাম, ঠিকানা, মোবাইল নাম্বার, লিখে
                                        <span class="text-danger font-weight-bold">অর্ডার কনফার্ম করুন</span> বাটনে ক্লিক করুন
                                    </p>
                                    <form action="<?php echo e(route('place.order')); ?>" method="post" id="checkout_form" class="checkout_form">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="shipping_cost" id="shipping_cost">
                                        <div class="form-group">
                                            <label for="customer_name">নাম <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="customer_name" name="customer_name" placeholder="আপনার নাম লিখুন" value="<?php echo e(old('customer_name')); ?>" required>
                                            <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger font-weight-bold"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_name">মোবাইল <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="customer_phone" name="customer_phone" placeholder="আপনার ১১ সংখ্যার মোবাইল নাম্বার লিখুন"
                                                minlength="11" maxlength="11" required value="<?php echo e(old('customer_phone')); ?>">
                                            <?php $__errorArgs = ['customer_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger font-weight-bold"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_name">ঠিকানা <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="customer_address" name="customer_address" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check">
                                                    <input type="radio" name="shipping_method" id="shipping_method<?php echo e($key); ?>" class="form-check-input"
                                                        value="<?php echo e($item->id); ?>" <?php echo e($key==0?"checked":""); ?>>
                                                    <label class="form-check-label font-weight-normal" for="shipping_method<?php echo e($key); ?>"><?php echo e($item->text); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" name="order_note" placeholder="আপনার নোট লিখুন"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success w-100 mb-2" style="height: 50px" id="conf_order_btn">অর্ডার কনফার্ম করুন</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="font-weight-bold mb-0">অর্ডার ইনফরমেশন</h6>
                                </div>
                                <div class="card-body p-2">
                                    <table class="cart_table table table-bordered table-striped text-center mb-0">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Product Name & Image</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php $__currentLoopData = \Cart::getContent(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('cart.item.delete',$item->id)); ?>"><i class="fa fa-trash-o text-danger"></i></a>
                                                </td>
                                                <td class="text-left">
                                                    <?php
                                                        $assoc = $item->associatedModel ?? null;
                                                        $thumbUrl = null;
                                                        if ($assoc && !($assoc instanceof \__PHP_Incomplete_Class)) {
                                                            $thumbUrl = is_object($assoc) ? ($assoc->image ?? ($assoc->get_thumb->file_url ?? null)) : null;
                                                        }
                                                        $itemSlug = is_object($assoc) && !($assoc instanceof \__PHP_Incomplete_Class) ? ($assoc->slug ?? '') : '';
                                                        $itemId   = is_object($assoc) && !($assoc instanceof \__PHP_Incomplete_Class) ? ($assoc->id ?? $item->id) : $item->id;
                                                    ?>
                                                    <?php if($thumbUrl): ?>
                                                        <img width="35" src="<?php echo e($thumbUrl); ?>" alt="">
                                                    <?php endif; ?>
                                                    <a style="font-size: 12px"
                                                    href="<?php echo e(route('product.details', [$itemSlug, $itemId])); ?>"><?php echo e($item->name); ?></a>
                                                </td>
                                                <td><?php echo e($item->price); ?></td>
                                                <td width="15%" class="cart_qty">
                                                    <a href="<?php echo e(route('cart.item.minus',$item->id)); ?>"><i class="fa fa-minus" id="qty_minus"></i></a>
                                                    <input type="text" name="qty" id="qty" min="1" value="<?php echo e($item->quantity); ?>" readonly>
                                                    <a href="<?php echo e(route('cart.item.plus',$item->id)); ?>"><i class="fa fa-plus" id="qty_plus"></i></a>
                                                </td>
                                                <td><?php echo e($item->getPriceSum()); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right pr-2">Net Total</th>
                                            <td><span id="net_total"><?php echo e(\Cart::getTotal()); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right pr-2">Shipping Cost</th>
                                            <td>
                                                <span id="cart_shipping_cost">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right pr-2">Grand Total</th>
                                            <td>
                                                <span id="grand_total"></span>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <a href="<?php echo e(route('home')); ?>" class="btn btn-info btn-sm ">
                                        <i class="fa fa-angle-left"></i> Back To Shopping
                                    </a>
                                    <a href="<?php echo e(route('cart.clear')); ?>" class="btn btn-danger btn-sm float-right">Cart Clear</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="py-md-5">
            <div class="cart-section">
                <div class="container">
                    <div class="row py-md-5">
                        <div class="col-12 text-center">
                            <h1 class="mb-md-4">কোন প্রোডাক্ট নেই</h1>
                            <a href="<?php echo e(route('home')); ?>" class="btn btn-info px-5">প্রোডাক্ট বাছাই করুন</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('backEnd/assets/vendor/select2/js/select2.min.js')); ?>"></script>
    <script>
        $('.select2').select2();
        $(document).ready(function () {

            $('#customer_phone').on('change, blur', function() {
                var phone = $(this).val();
                var name = $('#customer_name').val();
                var address = $('#customer_address').val();
                var shipping_method = $('#shipping_method').val();
                var shipping_cost = $('#shipping_cost').val();
                var data = {
                    phone: phone,
                    name: name,
                    address: address,
                    shipping_method: shipping_method,
                    shipping_cost: shipping_cost
                };
                if (phone.length == 11) {
                    $.ajax({
                        url: '<?php echo e(route('abandoned.cart')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            data: data
                        },
                        success: function(data) {
                            // console.log(data)
                        }
                    });
                }
            });

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '<?php echo e(route('ajax.get.shipp.meth')); ?>',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id: $("input[name='shipping_method']:checked").val()},
                success: function (data) {
                    $("#cart_shipping_cost").text(data);
                    $("#shipping_cost").val(data);
                    calculate();
                }
            });

            $("input[name='shipping_method']").on('click', function () {
                if ($("input[name='shipping_method']:checked").val()) {
                    $.ajax({
                        url: '<?php echo e(route('ajax.get.shipp.meth')); ?>',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, id: $(this).val()},
                        success: function (data) {
                            $("#cart_shipping_cost").text(data);
                            $("#shipping_cost").val(data);
                            calculate();
                        }
                    });
                } else {
                    $("#cart_shipping_cost").text(0);
                    $("#shipping_cost").val(0);
                    calculate();
                }

            });

            function calculate() {
                var net_total = parseFloat($('#net_total').text());
                var cart_shipping_cost = parseFloat($('#cart_shipping_cost').text());
                $('#grand_total').text(net_total + cart_shipping_cost);
            }


            $("#checkout_form").submit(function () {
                $("#conf_order_btn").attr("disabled", true).text('সাবমিট হচ্ছে...');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\cache-newmartbd\resources\views/checkout.blade.php ENDPATH**/ ?>