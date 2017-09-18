(($) ->

  productItemsMatchHeight = () -> #Контроль высоты для элементов продуктов
    $("h2.woocommerce-loop-product__title").matchHeight()


  $(document).ready ->
    productItemsMatchHeight()

) jQuery