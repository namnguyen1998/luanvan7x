<div class="col-lg-3" id="total-quantity">
    <div class="header__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="{{URL::to('list-cart')}}">
                <i class="fa fa-shopping-bag">
                @if(Session::get('Cart')!=null)
                    <span id="total-quantity-show">{{Session::get('Cart')->totalQuantity}}</span>
                @else
                    <span id="total-quantity-show">0</span>
                @endif
                </i>
                </a>
            </li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
</div>