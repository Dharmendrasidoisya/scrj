   {!! dynamic_sidebar('top_footer_sidebar') !!}
  <style>
       @media screen and (max-width: 767px) {
           .footer-box {
               display: flex !important;
               position: fixed;
               left: 0;
               bottom: 0;
               width: 100%;
               background-color: #0f4da2;
               color: white;
               text-align: center;
               z-index: 999999;
               display: grid;
               grid-template-columns: 1fr 1fr;
           }

           .book-app {
               width: 100%;
               padding: 2%;
               float: left;
               line-height: 40px;
               text-align: center;
               max-height: 100px;
           }

           .sticklist {
               display: none !important;
           }
       }
   </style>
   <style>
       .justify-content-center {
           justify-content: center ;
       }
   </style>
  

   <footer id="footer" class="border-0 bg-light pt-0 text-3" style="margin-top:0px!important;">
       <div class="border-bottom border-bottom-color-grey-100">
           <div class="container-fluid">
               <div class="row align-items-center">
                   <div class="col-lg-3 py-4 leftright">
                       @if ($logo = theme_option('logo') ?: theme_option('logo'))
                           <a href="{{ BaseHelper::getHomepageUrl() }}">
                               <img alt="{{ theme_option('site_title') }}" width="250" class="smalllogo mobilelogo "
                                   src="{{ RvMedia::getImageUrl($logo) }}">
                           </a>
                       @endif
                   </div>
                   <div class="col-lg-9 pt-lg-0">
                       <div class="d-flex flex-column flex-lg-row justify-content-lg-end py-4 align-items-lg-center">
                           <div class="pe-4">
                               <div class="feature-box feature-box-secondary align-items-center">
                                   <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                                       <img src="{{ asset('themes/wowy/ads/img/icons/phone-2.svg') }}" width="30"
                                           height="30" alt="phone-2" data-icon
                                           data-plugin-options="{'onlySVG': true, 'extraClass': 'icon-white'}" />

                                   </div>
                                   <div class="feature-box-info ps-2">
                                       <strong class="d-block text-uppercase text-color-secondary p-relative top-2">Call
                                           Us</strong>
                                       @if (theme_option('phone'))
                                           <a href="tel:{{ theme_option('phone') }}"
                                               class="text-decoration-none font-secondary text-5 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2"
                                               style="font-size: 15px!important;    font-weight: 600 !important;">{{ theme_option('phone') }}</a>
                                       @endif
                                   </div>
                               </div>
                           </div>
                           <div class=" pt-4 pt-lg-0 pe-0">
                               <div class="feature-box feature-box-secondary align-items-center">
                                   <div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
                                       <img src="{{ asset('themes/wowy/ads/img/icons/email.svg') }}" width="30"
                                           height="30" alt="" data-icon
                                           data-plugin-options="{'onlySVG': true, 'extraClass': 'icon-white'}" />
                                   </div>
                                   <div class="feature-box-info ps-2">
                                       <strong class="d-block text-uppercase text-color-secondary p-relative top-2">Send
                                           E-mail</strong>
                                       @if (theme_option('contact_email'))
                                           <a href="mailto:{{ theme_option('contact_email') }}"
                                               class="text-decoration-none font-secondary text-5 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2"
                                               style="font-size: 15px!important;font-weight: 600 !important;">{{ theme_option('contact_email') }}</a>
                                       @endif
                                       <br>
                                       @if (theme_option('contact_email2'))
                                           <a href="mailto:{{ theme_option('contact_email2') }}"
                                               class="text-decoration-none font-secondary text-5 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2"
                                               style="font-size: 15px!important;">{{ theme_option('contact_email2') }}</a>
                                       @endif

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="container-fluid pt-5 pb-5  design lcssfooter">
           <div class="row lbfooterboth">
               {!! dynamic_sidebar('footer_sidebar') !!}
           </div>
       </div>
       <div class="footer-copyright bg-transparent">
           <div class="container-fluid">
               <hr>
               <div class="row lcss">
                   <div
                       class="col-lg-8 text-center text-lg-startfooter py-3 lcssfooter order-2 order-lg-1 footermobilebottom">
                       <p class="text-3 mb-0 opacity-6" style="font-size:17px!important;">
                           {!! theme_option('copyright') !!}</p>
                   </div>
                   <div class="col-lg-4  text-lg-end order-1 order-lg-2 mobilepolicy py-3">
                       <a href="https://www.scrjrealestateandsolutions.in/privacy-policy"
                           class="text-color-grey text-color-hover-primary" style="font-size:17px;">Privacy Policy</a>
                      
                   </div>
               </div>

           </div>
       </div>

   </footer>
    

   <script>
       $('#btnclose').click(divFunction);

       function divFunction() {
           $("#memberModal").modal('hide');
       }
   </script>

   <div class="footer-box" style="display: none;" >
       <div class="book-app" style="background: #B8860E;">
           @if (theme_option('phone'))
               <a class="nav_up" href="tel:{{ theme_option('phone') }}"
                   style="color: #FFF; font-size: 16px; font-weight: 600;"><i class="fa fa-phone"
                       style="margin-right: 5px; transform: rotate(90deg);"></i>Call Now</a>
           @endif
       </div>
       <div class="book-app" style="background: #000;" id="req-apnmt2">
           <a class="nav_up click1" href="https://www.scrjrealestateandsolutions.in/enquiry"
               style="color: #FFF; font-size: 16px; font-weight: 600;"><i class="fa fa-envelope"
                   style="margin-right: 5px;"></i>Inquiry Now</a>
       </div>

   </div>
   <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasMain"
       aria-labelledby="offcanvasMain">
       <div class="offcanvas-header">
           <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>
       <div class="offcanvas-body">
           <div class="mb-4 mobilelogo">
               @if ($logo = theme_option('logo') ?: theme_option('logo'))
                   <a href="{{ BaseHelper::getHomepageUrl() }}">
                       <img alt="{{ theme_option('site_title') }}" width="250" class="smalllogo mobilelogo "
                           src="{{ RvMedia::getImageUrl($logo) }}">
                   </a>
               @endif
           </div>
           <nav class="offcanvas-nav w-100" id="offCanvasNav">



               {!! Menu::renderMenuLocation('main-menu', [
                   'view' => 'main-menu',
               ]) !!}



           </nav>
       </div>
   </div>
 
   <!-- Quick view -->
   <div class="modal fade custom-modal" id="quick-view-modal" tabindex="-1"
       aria-labelledby="quick-view-modal-label" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               <div class="modal-body">
                   <div class="half-circle-spinner loading-spinner">
                       <div class="circle circle-1"></div>
                       <div class="circle circle-2"></div>
                   </div>
                   <div class="quick-view-content"></div>
               </div>
           </div>
       </div>
   </div>

   @if (is_plugin_active('ecommerce'))
       <script>
           window.currencies = {!! json_encode(get_currencies_json()) !!};
       </script>
   @endif

   {!! Theme::footer() !!}

   <script>
       window.trans = {
           "Views": "{{ __('Views') }}",
           "Read more": "{{ __('Read more') }}",
           "days": "{{ __('days') }}",
           "hours": "{{ __('hours') }}",
           "mins": "{{ __('mins') }}",
           "sec": "{{ __('sec') }}",
           "No reviews!": "{{ __('No reviews!') }}"
       };
   </script>

   {!! Theme::place('footer') !!}

   @if (session()->has('success_msg') ||
           session()->has('error_msg') ||
           (isset($errors) && $errors->count() > 0) ||
           isset($error_msg))
       <script type="text/javascript">
           window.onload = function() {
               @if (session()->has('success_msg'))
                   window.showAlert('alert-success', '{{ session('success_msg') }}');
               @endif

               @if (session()->has('error_msg'))
                   window.showAlert('alert-danger', '{{ session('error_msg') }}');
               @endif

               @if (isset($error_msg))
                   window.showAlert('alert-danger', '{{ $error_msg }}');
               @endif

               @if (isset($errors))
                   @foreach ($errors->all() as $error)
                       window.showAlert('alert-danger', '{!! BaseHelper::clean($error) !!}');
                   @endforeach
               @endif
           };
       </script>
   @endif

   <div id="scrollUp"><i class="fal fa-long-arrow-up"></i></div>

<script>
    $(document).ready(function () {
        // Show the modal when the page loads
        $("#memberModal").modal('show');

        // Optional: If you want to close modal automatically after 5 seconds
        // setTimeout(function () {
        //     $("#memberModal").modal('hide');
        // }, 5000);
    });
</script>



<script type="text/javascript" src="https://crm.scrjrealestateandsolutions.in/scripts/view/_ExternalPost.js"></script> 

 

   </body>

   </html>
