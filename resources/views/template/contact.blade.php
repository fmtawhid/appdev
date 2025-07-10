@extends('layouts.master')
@section('content')
    <!-- page-header start-->
  	<section class="all_page-header" style="background-image: url('assets/img/header_bg.jpg');">
  		<div class="conatiner container-menu">
  			<div class="row">
  				<div class="col-lg-12">
  					<div class="all_page-content">
  						<div class="all_page-text">
  							<h2>hire <span>us</span></h2>
  							<p>Create the world of your dreams</p>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</section>
    <!-- page-header end-->
    <!-- contact form start-->
    <div class="contact_form-page">
    	<div class="container container-menu">
    		<div class="row">
    			<div class="contact-form">
    				<form id="contact-form" method="POST" action="https://blackberrybd.com/creative-soft/mystudio/mail.php">
    					<div class="contact_form-row">
    						<div class="contact_form-single">
    							<label for="id_name" class="form_label"> Your name <span class="label_start">*</span></label>
    							<div class="form-input__input">
    								<span class="boxed-input  ">
                                        <span class="boxed-input__wrapper">          
                                            <input type="text" name="name" class="boxed-input__input input" autocomplete="off" required="" id="id_name">
                                            <span class="boxed-input__box">
                                                <span class="boxed-input__side boxed-input__side--rear"></span>
                                                <span class="boxed-input__side boxed-input__side--bottom"></span>
                                                <span class="boxed-input__side boxed-input__side--top"></span>
                                                <span class="boxed-input__side boxed-input__side--front"></span>
                                            </span>
                                            <span class="boxed-input__errors"> 
                                            </span>
                                        </span>
                                        
                                    </span>
    							</div>
    						</div>
    					</div>
                        <div class="contact_form-row">
                            <div class="contact_form-single">
                                <label for="id_email" class="form_label"> Email <span class="label_start">*</span></label>
                                <div class="form-input__input">
                                    <span class="boxed-input  ">
                                        <span class="boxed-input__wrapper">          
                                            <input type="text" name="email" class="boxed-input__input input" autocomplete="off" required="" id="id_email">
                                            <span class="boxed-input__box">
                                                <span class="boxed-input__side boxed-input__side--rear"></span>
                                                <span class="boxed-input__side boxed-input__side--bottom"></span>
                                                <span class="boxed-input__side boxed-input__side--top"></span>
                                                <span class="boxed-input__side boxed-input__side--front"></span>
                                            </span>
                                            <span class="boxed-input__errors"> 
                                            </span>
                                        </span>
                                        
                                    </span>
                                </div>
                            </div>
                            <div class="contact_form-single">
                                <label for="id_phn" class="form_label"> Phone <span class="label_start">*</span></label>
                                <div class="form-input__input">
                                    <span class="boxed-input  ">
                                        <span class="boxed-input__wrapper">          
                                            <input type="text" name="phone" class="boxed-input__input input" autocomplete="off" required="" id="id_phn">
                                            <span class="boxed-input__box">
                                                <span class="boxed-input__side boxed-input__side--rear"></span>
                                                <span class="boxed-input__side boxed-input__side--bottom"></span>
                                                <span class="boxed-input__side boxed-input__side--top"></span>
                                                <span class="boxed-input__side boxed-input__side--front"></span>
                                            </span>
                                            <span class="boxed-input__errors"> 
                                            </span>
                                        </span>
                                        
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="contact_form-row">
                            <div class="contact_form-single">
                                <label for="id_sms" class="form_label"> Contact us for any questions you may have <span class="label_start">*</span></label>
                                <div class="form-input__input">
                                    <span class="boxed-input boxed-input__textarea">
                                        <span class="boxed-input__wrapper">          
                                            <textarea name="message" class="boxed-input__input input input_textarea" rows="10" cols="40" autocomplete="off" required="" id="id_sms"></textarea>
                                            <span class="boxed-input__box">
                                                <span class="boxed-input__side boxed-input__side--rear"></span>
                                                <span class="boxed-input__side boxed-input__side--bottom"></span>
                                                <span class="boxed-input__side boxed-input__side--top"></span>
                                                <span class="boxed-input__side boxed-input__side--front"></span>
                                            </span>
                                            <span class="boxed-input__errors"> 
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="contact_form-row">
                            <div class="overly_subbtn contact_button">
                                <button type="submit" class="main_button">
                                    <span class="button__label">Send Message</span>
                                </button>
                            </div>
                        </div>
    				</form>
                    <div class="ajax-response"></div>
    			</div>
    		</div>
    	</div>
        <div class="transparent-grid">
            <div class="transparent-grid__container">
                <div class="transparent-grid__row">
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                    <div class="transparent-grid__column"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact form end-->

    <!-- contact map start-->
    <div class="contact_map-area">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="contact_map-full">
                        <div class="contact-footer__map-dots">
                            <p class="contact-footer__map-dot map-dot map-dot--static" style="top: 35.1%; left: 51.9%;">
                                <span class="map-dot__info">
                                    <span class="map-dot__content">
                                        <span class="map-dot__header">Creative-soft AUS</span>
                                        <span class="map-dot__address">
                                            Małachowskiego 10<br>
                                            61-129 Poznań<br>
                                            Poland
                                        </span>
                                    </span>
                                </span>
                            </p>
                            <p class="contact-footer__map-dot map-dot map-dot--static map-dot--left-side map-dot--department" style="top: 40.5%; left: 28.1%;">
                                <span class="map-dot__info">
                                    <span class="map-dot__content">
                                        <span class="map-dot__header">Creative-soft BAZ</span>
                                        <span class="map-dot__address">
                                            3537 36th Street<br>
                                            Astoria, NY 11106<br>
                                            United States
                                        </span>
                                    </span>
                                </span>
                            </p>
                            <p class="contact-footer__map-dot map-dot map-dot--static map-dot--top-side map-dot--department" style="top: 35%; left: 47%;">
                                <span class="map-dot__info">
                                    <span class="map-dot__content">
                                        <span class="map-dot__header">Creative-soft UK</span>
                                        <span class="map-dot__address">
                                            13 Harbury Rd<br>
                                            Bristol UK BS9 4PN<br>
                                            United Kingdom
                                        </span>
                                    </span>
                                </span>
                            </p>
                            <p class="contact-footer__map-dot map-dot map-dot--static map-dot--down-side map-dot--department" style="top: 35%; left: 51%;">
                                <span class="map-dot__info">
                                    <span class="map-dot__content">
                                        <span class="map-dot__header">Creative-soft USA</span>
                                        <span class="map-dot__address">
                                            Schinkestraße 9<br>
                                            Berlin 12047<br>
                                            Germany
                                        </span>
                                    </span>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact map end-->

    <!-- contact footer start-->
    <section class="contact_footer-address">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_content-text">
                        <h4>Creativesoft</h4>
                        <h5>We have expansion in several countries</h5>
                        <p>{2270 Fieldcrest Road,New York,Creativesoft}</p>
                        <h5>61 Marcham Road,GU35 5UD,Bordon</h5>
                        <p>Share capital of PLN 1300.000 | KRS number 0000002 | Tax No. NIP: 25384374641  </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact footer end-->
    <!-- contact department  start-->
    <section class="contact-department">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="department-single">
                        <div class="img">
                            <img src="assets/img/contact/m1.png" alt="deparment">
                        </div>
                        <div class="department-content">
                            <h5>Digital Marketer</h5>
                            <p>We are always looking for  engineers</p>
                            <span><a class="email" href="#">example@gmail.com</a></span>
                            <span>tel: <a class="phone" href="#"> +4565465742</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="department-single department-single2">
                        <div class="img">
                            <img src="assets/img/contact/m2.png" alt="deparment">
                        </div>
                        <div class="department-content">
                            <h5>Press and media</h5>
                            <p>Let's talk about your software now</p>
                            <span><a class="email" href="#">example@gmail.com</a></span>
                            <span>tel: <a class="phone" href="#"> +4565465745</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="department-single">
                        <div class="img">
                            <img src="assets/img/contact/m3.png" alt="deparment">
                        </div>
                        <div class="department-content">
                            <h5>Project inquiries</h5>
                            <p>Thank you very much for being with us</p>
                            <span><a class="email" href="#">example@gmail.com</a></span>
                            <span>tel: <a class="phone" href="#"> +4565465747</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact department  start-->
    
@endsection