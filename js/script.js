(function($) {
  var productItemsMatchHeight;
  productItemsMatchHeight = function() {
    return $("h2.woocommerce-loop-product__title").matchHeight();
  };
  return $(document).ready(function() {
    return productItemsMatchHeight();
  });
})(jQuery);
