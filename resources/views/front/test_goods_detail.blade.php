@extends('layouts/nav')

@section('css')
<style>
    .product-Card {
        width: 606px;
        min-height: 500px;
        box-sizing: border-box;
        padding: 48px 48px 40px;
        margin-bottom: 60px;
        background: #fafafa;
    }

    .product-Card .btnfont {
        padding: .375rem .5625rem;
        width: 100%;
        min-height: 1.875rem;
        height: 100%;
        font-size: .8125rem;
        line-height: 1rem;
        color: #757575;
        text-align: center;
        border-radius: .3125rem;
        border: .0625rem solid #eee;
        background-color: #fff;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: opacity, border .2s linear;
    }

    .product-Card .btnfont.active {
        color: #424242;
        border-color: #ff6700;
        transition: opacity, border .2s linear;
    }
</style>
@endsection


@section('content')

<section class="features3 cid-rRF3umTBWU" id="features3-7" style="margin-top:80px">

    <div class="container row">


        <div class="col-6"></div>

        <div class="col-6">
            <div class="product-Card">
                <div class="goods_name">
                <div class="title">產品名稱</div>
                    <div class="sub-title">6GB+64GB, 冰翡翠</div>
                    <div class="price">NT$6,599</div>

                </div>
                <div class="tips">
                    icon雙倍該商品可享受雙倍積分
                </div>
                <div class="goods_capacitys">
                    容量
                    <div class="row">
                        <div class="col-4">
                            <div class="goods_capacity btnfont active" data-capacity="6GB+64GB">
                                6GB+64GB
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="goods_capacity btnfont" data-capacity="6GB+128GB">
                                6GB+128GB
                            </div>
                        </div>
                    </div>
                </div>
                <div class="goods_color">
                    顏色
                    <div class="row">
                        <div class="col-4">
                            <div class="color btnfont active" data-color="紅">
                                紅
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="color btnfont" data-color="黃">
                                黃
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="color btnfont" data-color="綠">
                                綠
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="color btnfont" data-color="紫">
                                紫
                            </div>
                        </div>
                    </div>
                </div>

                <form action="" method="POST">
                    @csrf

                    <div class="goods-qty">
                        數量
                        <a id="minus" href="#">-</a>
                        <span id="value">0</span>
                        <a id="plus" href="#">+</a>
                    </div>
                    <div class="goods-total">
                        <div>
                            <span>Redmi Note 8 Pro</span>
                            <span>冰翡翠</span>
                            <span>6GB+64GB</span> * <span>1</span>
                            NT$6,599
                        </div>
                    </div>
                    {{-- <input type="text" name="goods_name" value="Redmi Note 8 Pro"> --}}
                    <input type="text" name="capacity" id="capacity">
                    <input type="text" name="color" id="color" value="紅">
                    <br>
                    <br>
                    <button>立即購買</button>


                </form>




            </div>

        </div>


    </div>
</section>
@endsection

@section('js')

<script>
    $('.product-Card .color').click(function(){
        //change 長相
        $('.product-Card .color').removeClass('active');
        $(this).addClass('active');

        //把顏色 放入 input的value中
        //get data attr value
        var color = $(this).attr("data-color");

        // change input value
        $('#color').val(color);

    })

    $('.product-Card .goods_capacity').click(function(){
        //change 長相
        $('.product-Card .goods_capacity').removeClass('active');
        $(this).addClass('active');

        //把容量 放入 input的value中

        //get data attr value
        var capacity = $(this).attr("data-capacity")
        // change input value
        $('#capacity').val(capacity);
    })

    $(function(){

        var valueElement = $('#value');
        function incrementValue(e){
            valueElement.text(Math.max(parseInt(valueElement.text()) + e.data.increment, 0));
            return false;
        }

        $('#plus').bind('click', {increment: 1}, incrementValue);

        $('#minus').bind('click', {increment: -1}, incrementValue);

    });
</script>


@endsection
