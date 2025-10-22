@extends('layouts.user_type.website')
@section('content')

 <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <section class="pt10 pb10 mt80 bg-grey">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center">
                           <h3 class="mb-0">Contact Us </h3>
                        </div>
                     </div>
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row g-4 gx-5">
                        <div class="col-lg-8">
                            <p>Whether you have a question, a suggestion, or just want to say hello, this is the place to do it. Please fill out the form below with your details and message, and we'll get back to you as soon as possible.</p>

                            
                            <form name="contactForm" id="contact_form" class="position-relative z1000" method="post" action="#">
                                <div class="row gx-4">
                                    <div class="col-lg-6 col-md-6 mb10">
                                        <div class="field-set">
                                            <span class="d-label fw-bold">Name</span>
                                            <input type="text" name="Name" id="name" class="form-control" placeholder="Your Name" required>
                                        </div>

                                        <div class="field-set">
                                            <span class="d-label fw-bold">Email</span>
                                            <input type="text" name="Email" id="email" class="form-control" placeholder="Your Email" required>
                                        </div>

                                        <div class="field-set">
                                            <span class="d-label fw-bold">Phone</span>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6">
                                        <div class="field-set mb20">
                                            <span class="d-label fw-bold">Message</span>
                                            <textarea name="message" id="message" class="form-control" placeholder="Your Message" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                    
                                
                                <div class="g-recaptcha" data-sitekey="6LdW03QgAAAAAJko8aINFd1eJUdHlpvT4vNKakj6"></div>
                                <div id='submit' class="mt20">
                                    <input type='submit' id='send_message' value='Send Message' class="btn-main">
                                </div>

                                <div id="success_message" class='success'>
                                    Your message has been sent successfully. Refresh this page if you want to send more messages.
                                </div>
                                <div id="error_message" class='error'>
                                    Sorry there was an error sending your form.
                                </div>
                            </form>

                            </div>

                        <div class="col-lg-4">
                            <h4>Our Office</h4>
                            <div class="img-with-cap mb20">
                                <div class="d-title">Mon - Fri 08.00 - 18.00</div>
                                <div class="d-overlay"></div>
                                <img src="{{ asset('web/images/misc/5.webp')}}" class="img-fullwidth rounded-1" alt="">
                            </div>

                            <div class="spacer-single"></div>

                            <div class="fw-bold text-dark"><i class="icofont-location-pin me-2 id-color-2"></i>Office Location</div>
                            80 George Street, Edinburgh, Scotland, EH2 3BU

                            <div class="spacer-single"></div>

                            <div class="fw-bold text-dark"><i class="icofont-envelope me-2 id-color-2"></i><a href="mailto:support@energeios.io">Send a Message</a></div>
                            support@energeios.io

                            <div class="spacer-single"></div>

                            <div class="fw-bold text-dark"><i class="icofont-brand-whatsapp me-2 id-color"></i>
                            <a href="https://wa.me/447414217868" target="_blank">Chat on WhatsApp</a>
                        </div>
                        +44 7414 217868
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                </div>
            </section>            

        </div>
        <!-- content close -->
        
@endsection
