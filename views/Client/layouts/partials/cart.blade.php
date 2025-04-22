<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        @foreach ($_SESSION['listCart'] as $item)
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="{{ file_url($item['img_thumbnail']) }}" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">{{ $item['name'] }}</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity"> <strong>{{ $item['quantity'] }}x</strong></span>
                                        <span class="cart-price">
                                            ${{ $item['is_sale'] == 1 ? $item['price_sale'] : $item['price'] }}</span>
                                    </p>
                                </div>
                                <a href="/delete/cartProduct/{{ $item['id'] }}" class="minicart-remove"><i
                                        class="pe-7s-close"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="minicart-pricing-box" style="display: {{ empty($_SESSION['listCart']) ? 'none' : '' }}">
                    <ul>
                        <li>
                            <span>sub-total</span>
                            <span><strong>{{ $_SESSION['total'] }}</strong></span>
                        </li>
                        <li>
                            <span>VAT (2%)</span>
                            <span><strong>${{ $_SESSION['vat'] }}</strong></span>
                        </li>
                        <li class="total">
                            <span>total</span>
                            <span><strong> ${{ $_SESSION['total'] + $_SESSION['vat'] }}</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="/formCheckOut"><i class="fa fa-shopping-cart"></i> Buy</a>
                </div>
            </div>
        </div>
    </div>
</div>
