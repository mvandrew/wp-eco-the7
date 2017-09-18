(($) ->

  productItemsMatchHeight = () -> # Match height for the product elements
    $("h2.woocommerce-loop-product__title").matchHeight()


  $(document).ready ->
    productItemsMatchHeight()

) jQuery