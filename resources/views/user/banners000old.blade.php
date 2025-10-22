@extends('layouts.user_type.auth-app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/photoswipe.css')}}">
<div class="page-body">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <h4>Energeios Banners </h4>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-3 text-center">
                        <a href="{{ asset('images/new/banners/4june24.jpeg')}}" download target="_blank">
                        <img src="{{ asset('images/new/banners/4june24.jpeg')}}" class="img-fluid">
                        </a>
                        <a href="{{ asset('images/new/banners/4june24.jpeg')}}" class="btn bg-primary text-white mt-2 adjust" data-bs-toggle="modal" data-original-title="" data-bs-target="#exampleModal">View</a>
                        <a href="{{ asset('images/new/banners/4june24.jpeg')}}" class="btn bg-primary text-white mt-2 adjust" download>Download</a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Energeios Banners</h5>
                                    <button class="btn-close py-0 me" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="modal-toggle-wrapper">
                                       <div class="modal-img"> 
                                          <img src="{{ asset('images/new/banners/4june24.jpeg')}}" alt="online-shopping">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-body" style="display:none;">
   <!-- Container-fluid starts-->
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h4>Energeios Banners </h4>
               </div>
               <div class="gallery my-gallery card-body row" itemscope="" data-pswp-uid="1">
                  <figure class="col-xl-3 col-md-4 col-6 text-center" itemprop="associatedMedia" itemscope="">
                     <a href="{{ asset('images/new/banners/4june24.jpeg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{ asset('images/new/banners/4june24.jpeg')}}" itemprop="thumbnail" alt="Image description"></a>
                     <figcaption itemprop="caption description">04 June 24 Banner</figcaption>
                  </figure>
                  <figure class="col-xl-3 col-md-4 col-6 text-center" itemprop="associatedMedia" itemscope="">
                     <a href="{{ asset('images/new/banners/5june24.jpeg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{ asset('images/new/banners/5june24.jpeg')}}" itemprop="thumbnail" alt="Image description"></a>
                     <figcaption itemprop="caption description">05 June 24 Banner</figcaption>
                  </figure>
                  <figure class="col-xl-3 col-md-4 col-6 text-center" itemprop="associatedMedia" itemscope="">
                     <a href="{{ asset('images/new/banners/6june24.jpeg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{ asset('images/new/banners/6june24.jpeg')}}" itemprop="thumbnail" alt="Image description"></a>
                     <figcaption itemprop="caption description">06 June 24 Banner</figcaption>
                  </figure>
                  <figure class="col-xl-3 col-md-4 col-6 text-center" itemprop="associatedMedia" itemscope="">
                     <a href="{{ asset('images/new/banners/7june24.jpeg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{ asset('images/new/banners/7june24.jpeg')}}" itemprop="thumbnail" alt="Image description"></a>
                     <figcaption itemprop="caption description">07 June 24 Banner</figcaption>
                  </figure>
                  <figure class="col-xl-3 col-md-4 col-6 text-center" itemprop="associatedMedia" itemscope="">
                     <a href="{{ asset('images/new/banners/8june24.jpeg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{ asset('images/new/banners/8june24.jpeg')}}" itemprop="thumbnail" alt="Image description"></a>
                     <figcaption itemprop="caption description">08 June 24 Banner</figcaption>
                  </figure>
               </div>
               <!-- Root element of PhotoSwipe. Must have class pswp.-->
               <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true" style="">
                  <div class="pswp__bg" style=""></div>
                  <div class="pswp__scroll-wrap">
                     <div class="pswp__container" style="transform: translate3d(0px, 0px, 0px);">
                        <div class="pswp__item" style="display: block; transform: translate3d(-1453px, 0px, 0px);">
                           <div class="pswp__zoom-wrap" style="transform: translate3d(187px, 44px, 0px) scale(1);"><img class="pswp__img" src="../assets/images/big-lightgallry/012.jpg" style="opacity: 1; width: 500px; height: 500px;"></div>
                        </div>
                        <div class="pswp__item" style="transform: translate3d(0px, 0px, 0px);">
                           <div class="pswp__zoom-wrap" style="transform: translate3d(303px, 183px, 0px) scale(0.235929);"><img class="pswp__img pswp__img--placeholder" src="../assets/images/lightgallry/01.jpg" style="width: 500px; height: 500px; display: none;"><img class="pswp__img" src="../assets/images/big-lightgallry/01.jpg" style="display: block; width: 500px; height: 500px;"></div>
                        </div>
                        <div class="pswp__item" style="display: block; transform: translate3d(1453px, 0px, 0px);">
                           <div class="pswp__zoom-wrap" style="transform: translate3d(187px, 44px, 0px) scale(1);"><img class="pswp__img" src="../assets/images/big-lightgallry/02.jpg" style="opacity: 1; width: 500px; height: 500px;"></div>
                        </div>
                     </div>
                     <div class="pswp__ui pswp__ui--fit pswp__ui--hidden">
                        <div class="pswp__top-bar">
                           <div class="pswp__counter">1 / 12</div>
                           <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                           <button class="pswp__button pswp__button--share" title="Share"></button>
                           <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                           <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                           <div class="pswp__preloader">
                              <div class="pswp__preloader__icn">
                                 <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                           <div class="pswp__share-tooltip"></div>
                        </div>
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        <div class="pswp__caption">
                           <div class="pswp__caption__center">Image caption  1</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <a href="{{ asset('images/new/banners/4june24.jpeg')}}" class="btn bg-primary text-white mt-2 pads adjust" download>Download</a>
   <a href="{{ asset('images/new/banners/5june24.jpeg')}}" class="btn bg-primary text-white mt-2 pads adjust1" download>Download</a>
   <a href="{{ asset('images/new/banners/6june24.jpeg')}}" class="btn bg-primary text-white mt-2 pads adjust2" download>Download</a>
   <a href="{{ asset('images/new/banners/7june24.jpeg')}}" class="btn bg-primary text-white mt-2 pads adjust3" download>Download</a>
   <a href="{{ asset('images/new/banners/8june24.jpeg')}}" class="btn bg-primary text-white mt-2 pads adjust4" download>Download</a>
   <!-- Container-fluid Ends-->
</div>
<script src="{{asset('js/photoswipe.min.js')}}"></script>
<script src="{{asset('js/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('js/photoswipe.js')}}"></script>
@endsection