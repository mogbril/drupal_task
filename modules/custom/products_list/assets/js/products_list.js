
(function ($, Drupal) 
{
    'use strict';

    $(window).on("load", function () {

        $('.order-now').click(function () {
            var productTitle = $(this).attr('data-title'),
                    productId = $(this).attr('data-nid');
            $('.modal-title').html(productTitle);
            $('input#nid').val(productId);
            $('.modal .alert').hide()
            $('#productModal').modal('show');
        });



        $('.execute-order').click(function () {

            var product_nid = $('input#nid').val(),
                    quantity = $('input#quantity').val(),
                    title = $('.modal-title').text(),
                    url = '/ajax/execute_order';

            $.ajax({
                type: "GET",
                url: url,
                data: 'product_nid=' + product_nid+ '&quantity=' + quantity + '&title=' + title,
                dataType: 'html',
                async: true,
                beforeSend: function () {
                     $('.modal .alert').show()
                    $('.modal .alert').html("Processing order. Please wait....");
                },
                complete: function (data) {
                    $('.modal .alert').html("Order hase been done successfully!");
                }
            });
        });
    });


})(window.jQuery, window._, window.Drupal, window.drupalSettings);


