  <!-- Who We Are -->
  <div class="container-fluid lweare paddingleftright topbottom" id="intro">
      <div class="row">
          <div class="col-lg-6  mt-5 mt-lg-0 smallscreen ipedscreen">
              <div class="appear-animation bottomhome" data-appear-animation="fadeInRightShorter"
                  data-appear-animation-delay="0">
                  @if ($title)
                      <span
                          class="badge bg-gradient-light-primary-rgba-20 text-secondary rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4"><span
                              class="d-inline-flex py-1 px-2"> {!! BaseHelper::clean($title) !!}</span></span>
                  @endif
              </div>
              @if ($description)
                  <div class="appear-animation" data-appear-animation="fadeInUpShorter"
                      data-appear-animation-delay="200">
                      <h1 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-2 textsize"
                          style="font-weight: 500 !important;">{!! BaseHelper::clean($description) !!}</h1>
                  </div>
              @endif
              @if ($description2)
                  <p class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400"
                      style="    margin: 0 0 0px;">
                      {!! BaseHelper::clean($description2) !!}
                  </p>
              @endif

              <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
                  <div class="d-flex align-items-center pt-2 pb-4 lbsection">
                      @if ($description5)
                          <p class="d-inline-block mb-0 font-weight-bold line-height-1"><mark
                                  class="text-dark mark mark-pos-2 mark-height-50 mark-color bg-color-before-primary-rgba-30 font-secondary text-15 mark-height-30 n-ls-5 p-0">{!! BaseHelper::clean($description5) !!}</mark>
                          </p>
                      @endif
                      @if ($description6)
                          <span
                              class="custom-font-tertiary text-6 text-dark n-ls-1 fst-italic ps-2">{!! BaseHelper::clean($description6) !!}</span>
                      @endif
                  </div>
              </div>

          </div>

          <div class="col-lg-6 mb-5 mb-lg-0 bigscreen smallsection1">
              <div class="appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="400">
                  <div>

                      <div>
                          @if (!empty($icon1))
                              <img class="img-fluid border-radius-2 lbweare smallhomeheight"
                                  src="{{ RvMedia::getImageUrl(BaseHelper::clean($icon1)) }}" alt="generic-14">
                          @endif
                      </div>


                  </div>
              </div>
          </div>
      </div>
  </div>
