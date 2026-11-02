<?php $__env->startSection('title'); ?>
    <?php echo e($data->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('tracking'); ?>
    <?php if(session()->has('api_add_to_cart')): ?>
        <script>
            dataLayer.push({ecommerce: null});
            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    currency: "BDT",
                    value: <?php echo e(session('api_add_to_cart_data')['value'] ?? 0); ?>,
                    items: <?php echo session('api_add_to_cart_data')['products'] ?? '[]'; ?>

                }
            });
            if (typeof fbq === 'function') {
                var addToCartItems = <?php echo session('api_add_to_cart_data')['products'] ?? '[]'; ?>;
                fbq('track', 'AddToCart', {
                    content_ids: addToCartItems.map(function (item) { return item.item_id; }),
                    content_name: addToCartItems.length ? addToCartItems[0].item_name : '',
                    content_type: 'product',
                    value: <?php echo e(session('api_add_to_cart_data')['value'] ?? 0); ?>,
                    currency: 'BDT'
                });
            }
        </script>
    <?php endif; ?>
    <script>
        var viewItemItems = <?php echo session('api_view_item_data')['products'] ?? '[]'; ?>;
        dataLayer.push({ecommerce: null});
        dataLayer.push({
            event: "view_item",
            ecommerce: {
                currency: "BDT",
                value: <?php echo e(session('api_view_item_data')['value'] ?? 0); ?>,
                items: <?php echo session('api_view_item_data')['products'] ?? '[]'; ?>

            }
        });
        if (typeof fbq === 'function') {
            fbq('track', 'ViewContent', {
                content_ids: viewItemItems.map(function (item) { return item.item_id; }),
                content_name: viewItemItems.length ? viewItemItems[0].item_name : '',
                content_type: 'product',
                value: <?php echo e(session('api_view_item_data')['value'] ?? 0); ?>,
                currency: 'BDT'
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <section>
        <div class="category_breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p>
                            <a href="<?php echo e(route('home')); ?>">Home</a>
                            /
                            <a href="javascript:void(0);"><?php echo e($data->name); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="products-details-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-12 mb-md-3 mb-2">
                        <div id="sing_prod_img_slider" class="carousel slide" data-ride="carousel">
                            <?php if($data->gallery_images): ?>
                                <ol class="carousel-indicators">
                                    <li data-target="#sing_prod_img_slider" data-slide-to="0" class="active"></li>
                                    <?php if($data->gallery_images): ?>
                                        <?php $__currentLoopData = $data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-target="#sing_prod_img_slider" data-slide-to="<?php echo e($key=$key+1); ?>"></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ol>
                            <?php endif; ?>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?php echo e($data->image_url ?? asset('frontEnd/images/no_image.png')); ?>" class="d-block w-100"
                                         alt="">
                                </div>
                                <?php if($data->gallery_images): ?>
                                    <?php $__currentLoopData = $data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="carousel-item">
                                            <img src="<?php echo e($photo ? asset($photo) : asset('frontEnd/images/no_image.png')); ?>" class="d-block w-100" alt="">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <?php if($data->gallery_images): ?>
                                <button class="carousel-control-prev" type="button" data-target="#sing_prod_img_slider" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>

                                <button class="carousel-control-next" type="button" data-target="#sing_prod_img_slider" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <h3 class="text-capitalize single_prod_title"><?php echo e($data->name); ?></h3>
                        <h3 class="font-weight-bold single_prod_prices">
                            <?php if($data->sale_price > 0): ?>
                                <span
                                    style="text-decoration: line-through; color: #555;opacity: .5"><?php echo e($web_settings->currency_sign); ?> <?php echo e($data->price); ?></span>
                                <span style="color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($data->sale_price); ?></span>
                            <?php else: ?>
                                <span style="color: #ed362c"><?php echo e($web_settings->currency_sign); ?> <?php echo e($data->price); ?></span>
                            <?php endif; ?>
                        </h3>
                        <p class="sku_text"><span>SKU: </span> <span class="p-0 pr-1"><?php echo e($data->sku); ?></span></p>
                        <h4 class="single_prod_in_stock">স্টক : <?php if($data->stock > 0): ?><span class="text-success">ইন স্টক</span> <?php else: ?> <span
                                class="text-danger">স্টক আউট</span><?php endif; ?></h4>

                        <form action="<?php echo e(route('add.cart',$data->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" id="id" value="<?php echo e($data->id); ?>">
                            <div class="d-flex">
                                <div class="qty-text-div">
                                    <span>পরিমান : </span>
                                </div>
                                <div class="qty_div">
                                    <div class="minus-qty-div">
                                        <i class="fa fa-minus" id="qty_minus"></i>
                                    </div>
                                    <div class="qty-div">
                                        <input type="text" name="qty" id="qty" min="1" value="<?php echo e($qty ?? 1); ?>" readonly>
                                    </div>
                                    <div class="plus-qty-div">
                                        <i class="fa fa-plus" id="qty_plus"></i>
                                    </div>
                                </div>
                            </div>

                            <?php if($data->has_variant == 1): ?>
                                <input type="hidden" name="choice_attributes" id="choice_attributes" class="choice_attributes">
                                <div class="attributes mt-3">
                                    <div class="item">

                                        <?php $__currentLoopData = $data->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $att = (object) $att; ?>
                                            <div class="row mb-2">
                                                <div class="col-md-12 col-12">
                                                    <label class="mb-1"><b><?php echo e($att->attribute_name); ?></b></label><br>
                                                    <input type="hidden" name="attribute_id[]" value="<?php echo e($att->attribute_id); ?>">
                                                    <?php $k = 0; ?>
                                                    <?php $__currentLoopData = $att->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $attr_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $attr_item = (object) $attr_item; $attrName = $attr_item->name ?? ''; ?>
                                                        <input type="radio" id="val_<?php echo e($key); ?><?php echo e($key2); ?>" name="attribute_item_id[<?php echo e($att->attribute_id); ?>][]"
                                                               value="<?php echo e($attrName); ?>"
                                                               class="attr_checkbox" <?php echo e($k==0?'checked':""); ?>>
                                                        <label class="mb-0" for="val_<?php echo e($key); ?><?php echo e($key2); ?>">
                                                            <span><?php echo e($attrName); ?></span>
                                                        </label>
                                                        <?php $k++; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mt-md-4 mt-2">
                                <input type="submit" class="btn px-4 order_now_btn order_now_btn_m" name="order_now" value="অর্ডার করুন">
                            </div>

                            <div class="mt-2">
                                <input type="submit" class="btn px-4 add_cart_btn" name="add_cart" value="কার্ট-এ রাখুন">
                            </div>
                        </form>


                        <div class="mt-md-3 mt-2">
                            <?php if($web_settings->website_phone ?? null): ?>
                                <h4 class="font-weight-bold">
                                    <a class="btn btn-success call-btn" href="tel:<?php echo e($web_settings->website_phone); ?>">
                                        <span>ফোনে অর্ডার করতে ক্লিক করুন</span><br>
                                        <i class="fa fa-phone text-warning"></i>
                                        <?php echo e($web_settings->website_phone); ?>

                                    </a>
                                </h4>
                            <?php endif; ?>

                            <?php if($web_settings->website_phone2 ?? null): ?>
                                <h4 class="font-weight-bold">
                                    <a class="btn btn-success call-btn" href="tel:<?php echo e($web_settings->website_phone2); ?>">
                                        <span>ফোনে অর্ডার করতে ক্লিক করুন</span><br>
                                        <i class="fa fa-phone text-warning"></i>
                                        <?php echo e($web_settings->website_phone2); ?>

                                    </a>
                                </h4>
                            <?php endif; ?>

                            <?php if($web_settings->website_phone3 ?? null): ?>
                                <h4 class="font-weight-bold">
                                    <a class="btn btn-success call-btn" href="tel:<?php echo e($web_settings->website_phone3); ?>">
                                        <span>ফোনে অর্ডার করতে ক্লিক করুন</span><br>
                                        <i class="fa fa-phone text-warning"></i>
                                        <?php echo e($web_settings->website_phone3); ?>

                                    </a>
                                </h4>
                            <?php endif; ?>
                        </div>

                        <?php if($shipping_methods->count() > 0): ?>
                            <div class="col-12 mt-3 delivery_details" style="padding: 0">
                                <table class="table" style="color:#08c !important">
                                    <tbody>
                                    <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="padding-left: 0;border-bottom: 1px solid #ddd;">
                                                <?php echo e($item->text); ?>

                                            </td>
                                            <td style="border-bottom: 1px solid #ddd;">
                                                <b><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->amount); ?></b>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if($web_settings->bkash_merchant_numb ?? null): ?>
                            <h6 class="font-weight-bold text-danger mt-md-3 mt-2">বিকাশ নাম্বার : <?php echo e($web_settings->bkash_merchant_numb); ?></h6>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs nav-tabs-mod">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">পন্যের বিবরণ</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-content-mod">
                            <div class="tab-pane active">
                                <div class="product-description-content">
                                    <div class="text-muted">পন্যের বিবরণ লোড হচ্ছে...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 related-products">
                    <div class="col-md-12">
                        <h4 class="mb-3">রিলেটেড প্রোডাক্ট</h4>
                    </div>
                </div>

                <div class="row m-0">
                    <?php $__currentLoopData = $related_prod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 col-6 main-product">
                            <div class="main-product-inner-wrapper text-center">
                                <a href="<?php echo e(route('product.details',[$item->slug,$item->id])); ?>">
                                    <img src="<?php echo e($item->image_url ?? asset('frontEnd/images/no_image.png')); ?>" alt="<?php echo e($item->name); ?>">
                                </a>
                                <?php if($item->sale_price != 0): ?>
                                    <p class="mb-0" style="text-decoration: line-through;color: #b8b8b8"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
                                    <p class="font-weight-bold mb-0" style="color: #fca204"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->sale_price); ?></p>
                                <?php else: ?>
                                    <p class="font-weight-bold mb-0" style="margin-top: 24px;color: #fca204"><?php echo e($web_settings->currency_sign); ?> <?php echo e($item->price); ?></p>
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


            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        var productVariants = <?php echo json_encode($data->get_product_attributes ?? $data->get_attributes ?? []); ?>;
        var baseProductSku = <?php echo json_encode($data->sku ?? '', 15, 512) ?>;
        var productDescriptionUrl = <?php echo json_encode(rtrim(env('IMS_APP_BASE_URL'), '/') . '/api/v1/app/product-description/' . $data->id, 512) ?>;

        function loadProductDescription() {
            var descriptionContent = $('.product-description-content');

            fetch(productDescriptionUrl, {
                headers: {
                    Accept: 'application/json'
                }
            })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Product description request failed with status ' + response.status);
                    }
                    return response.json();
                })
                .then(function (data) {
                    var description = data && data.success && data.description
                        ? data.description.description
                        : null;

                    if (typeof description !== 'string') {
                        throw new Error('Product description was not included in the API response');
                    }

                    descriptionContent.html(description);
                })
                .catch(function (error) {
                    console.error('Unable to load product description:', error);
                    descriptionContent.html(
                        '<div class="alert alert-danger mb-0">পন্যের বিবরণ লোড করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।</div>'
                    );
                });
        }

        $('#qty_plus').on('click', function () {
            var qty = $('#qty').val();
            qty++;
            $('#qty').val(qty);
        });

        $('#qty_minus').on('click', function () {
            var qty = $('#qty').val();
            qty--;
            if (qty < 1) {
                $('#qty').val(1);
            } else {
                $('#qty').val(qty);
            }

        });

        $(document).ready(function () {
            loadProductDescription();

            var choice_attributes2 = [];
            $(".attr_checkbox:checked").each(function () {
                choice_attributes2.push($(this).val());
            });
            $('#choice_attributes').val(choice_attributes2);
            get_variant();
        });

        //variant
        function get_variant() {
            $('.loader-wrapper').addClass('active');
            $('.loader').addClass('active');

            var choice_attributes = [];
            $(".attr_checkbox:checked").each(function () {
                choice_attributes.push($(this).val());
            });
            var product_id = $('#id').val();
            var quantity = $('#qty').val();

            var CSRF = `<?php echo e(csrf_token()); ?>`;
            $.ajax({
                type: "POST",
                url: `<?php echo e(route('ajax.get.variant')); ?>`,
                data: {_token: CSRF, choice_attributes: choice_attributes, id: product_id, quantity: quantity},
                success: function (data) {
                    //$('.sku-value').text(data.sku);
                    $('.price-value').text(data.price);
                    $('.sub-total-value').text(data.subtotal);
                    $('#choice_attributes').val(data.choice_attributes);
                    $('.loader-wrapper').removeClass('active');
                    $('.loader').removeClass('active');
                }
            });
        }

        $(document).on('click', '.attr_checkbox', function () {
            //alert(3)
            $(this).parent().parent().find('.attribute-name-value').text($(this).val());
            get_variant();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\cache-newmartbd\resources\views/single_product.blade.php ENDPATH**/ ?>