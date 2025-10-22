@extends('layouts.user_type.auth-app')
@section('content')
<style type="text/css"></style>
<div class="page-body">
   <!-- Container-fluid starts-->
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h4>Energeios PDF </h4>
               </div>
               <div class="card-body">
                  <div class="row justify-content-center mypdf">
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>English PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Arabic PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_arabic.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Bangla PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_bangla.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Chinese PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_chinese.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Dutch PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_dutch.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Filipino PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_filipino.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>French PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_french.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>German PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_german.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>

                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Hindi PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_hindi.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>

                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Indonesian PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_indonesian.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Kannada PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_kannada.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Persian PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_persian.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Portuguese PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_portuguese.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Russian PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_russian.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Spanish PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_spanish.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Swahili PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_swahili.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Tamil PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_tamil.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Thai PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_thai.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Turkish PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_turkish.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Urdu PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_urdu.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                     <div class="col-md-2 col-6 text-center">
                        <div>
                           <img src="{{ asset('images/pdf.png')}}" class="img-fluid" width="100">
                           <p>Vietnamese PDF</p>
                           <a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}" class="btn bg-primary text-white mt-2 pads1" target="_blank">View</a>
                           <a href="{{ asset('images/new/pdf/halvingworld_vietnamese.pdf')}}" class="btn bg-primary text-white mt-2 pads1" download>Download</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Container-fluid Ends-->
</div>
@endsection