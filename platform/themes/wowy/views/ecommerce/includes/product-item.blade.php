
<style>
    .product-cart-wrap{
        margin-right: 15px;
    }
    .main{
        padding-right: 3rem !important; 
        padding-left: 3rem !important;
    }
</style>

 @if ($product)

 <div class="box-shadow-7 border-radius-2 overflow-hidden">
    <span class="thumb-info thumb-info-no-overlay thumb-info-show-hidden-content-hover">
        <span class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content border-radius-0 rounded-top">
            <a href="{{ $product->url }}" title="PVC Machining Center">
                <img src="{{ RvMedia::getImageUrl($product->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}" loading="lazy" class="img-fluid" alt="{{ $product->name }}">
            </a>
        </span>											
        <span class="thumb-info-content">
            <span class="thumb-info-content-inner bg-light p-4">
                <h4 class="text-5 mb-2">{{ $product->name }}</h4>
                 
                <span class="thumb-info-content-inner-hidden p-absolute d-block w-100 py-3">
                    
                    <a href="{{ $product->url }}" class="text-color-secondary text-color-hover-primary font-weight-semibold text-decoration-underline">{{__('View Details')}}</a>
                    <a href="{{ $product->url }}" class="btn btn-light btn-rounded box-shadow-7 btn-xl border-0 text-3 p-0 btn-with-arrow-solid p-absolute right-0 transform3dx-n100 bottom-7"><span class="p-static bg-transparent transform-none"><i class="fa-solid fa-arrow-right text-dark"></i></span></a>
                </span>
            </span>
        </span>
    </span>
</div>

@endif 
