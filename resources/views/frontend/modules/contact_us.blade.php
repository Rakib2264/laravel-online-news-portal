@extends('frontend.layouts.master')
@section('content')

@section('banner')
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="text-content">
                  <h4>Feel free to contact us</h4>
                  <h2>Contact Us</h2>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

@endsection

<section class="contact-us">
    <div class="container">
      <div class="row">

        <div class="col-lg-12">
          <div class="down-contact">
            <div class="row">
              <div class="col-lg-8">
                <div class="sidebar-item contact-form">
                  <div class="sidebar-heading">
                    <h2>Send us a message</h2>
                  </div>
                  <div class="content">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
                    <form id="contact" action="{{route('contact.store')}}" method="post">
                        @csrf
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <fieldset>
                            <input name="name" type="text" id="name" placeholder="Your name">
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <fieldset>
                            <input name="email" type="text" id="email" placeholder="Your email">
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <fieldset>
                            <input name="subject" type="text" id="subject" placeholder="Subject">
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <fieldset>
                              <input name="phone" type="tel" id="phone" placeholder="Phone">
                            </fieldset>
                          </div>
                        <div class="col-lg-12">
                          <fieldset>
                            <textarea name="message" rows="6" id="message" placeholder="Your Message"></textarea>
                          </fieldset>
                        </div>
                        <div class="col-lg-12">
                          <fieldset>
                            <button type="submit" id="form-submit" class="main-button">Send Message</button>
                          </fieldset>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="sidebar-item contact-information">
                  <div class="sidebar-heading">
                    <h2>contact information</h2>
                  </div>
                  <div class="content">
                    <ul>
                      <li>
                        <h5>01729542809</h5>
                        <span>PHONE NUMBER</span>
                      </li>
                      <li>
                        <h5>2264rakibkhan.com</h5>
                        <span>EMAIL ADDRESS</span>
                      </li>
                      <li>
                        <h5>Mirpur-1,
                            <br>242/2</h5>
                        <span>STREET ADDRESS</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div id="map">
            <iframe src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
          </div>
        </div>

      </div>
    </div>
  </section>



@endsection
