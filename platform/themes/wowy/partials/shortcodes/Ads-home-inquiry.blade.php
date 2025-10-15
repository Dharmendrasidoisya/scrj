	<!-- Free Quote -->
	<div class="container-fluid pt-5">
		<div class="row align-items-center pt-4 pb-5 pt-lg-5">
			<div class="col-lg-7 mb-5 mb-lg-0 ">
				<div class="appear-animation" data-appear-animation="fadeInRightShorter"
					data-appear-animation-delay="0">
					<span
						class="badge bg-gradient-light-primary-rgba-20 text-secondary rounded-pill text-uppercase font-weight-semibold text-2-5 px-3 py-2 px-4 mb-4"><span
							class="d-inline-flex py-1 px-2">Free Quote</span></span>
				</div>
				<div class="appear-animation" data-appear-animation="fadeInUpShorter"
					data-appear-animation-delay="200">
					<h2 class="text-9 text-lg-12 font-weight-semibold line-height-1 mb-4">Get a Free Quote
						Calculation</h2>
				</div>
				<div class="appear-animation" data-appear-animation="fadeInUpShorter"
					data-appear-animation-delay="400">
					<p>We understand that every business is unique, and so are its financial requirements.
						That’s why we offer a free, no-obligation quote calculation to help you understand how
						much you can save by partnering with us.</p>
				</div>
				<div class="appear-animation" data-appear-animation="fadeInUpShorter"
					data-appear-animation-delay="600">
					<div class="d-flex align-items-center py-3">
						<span
							class="badge bg-light text-dark border custom-font-secondary border-all-light box-shadow-8 n-ls-05 rounded-pill text-uppercase font-weight-semibold text-2 px-3 py-2 px-1 me-1"><span
								class="d-inline-flex py-1 px-2">Quick Reply</span></span>
						<p class="mb-0 text-dark ps-2 ms-1 text-3-5">Usually in 24 hours in working days.</p>
					</div>
				</div>
				<div class="appear-animation" data-appear-animation="fadeInUpShorter"
					data-appear-animation-delay="800">
					
					<div class="d-flex flex-column flex-xl-row py-4 align-items-xl-center">
						<div class="pe-4">
							<div class="feature-box feature-box-secondary align-items-center">
								<div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
									<img src="themes/wowy/ads/img/icons/phone-2.svg" width="30" height="30" alt="phone-2" data-icon
										data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}" />
								</div>
								<div class="feature-box-info ps-2">
									<strong
										class="d-block text-uppercase text-color-secondary p-relative top-2">Call
										Us</strong>
                                        @if (theme_option('phone'))
									<a href="tel:{{ theme_option('phone') }}"
										class="text-decoration-none font-secondary text-5 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2">
										{{ theme_option('phone') }}</a>
                                        @endif
								</div>
							</div>
						</div>
						<div class="pe-4 pt-4 pt-xl-0">
							<div class="feature-box feature-box-secondary align-items-center">
								<div class="feature-box-icon feature-box-icon-lg p-static box-shadow-7">
									<img src="themes/wowy/ads/img/icons/email.svg" width="30" height="30" alt="email" data-icon
										data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light'}" />
								</div>
								<div class="feature-box-info ps-2">
									<strong
										class="d-block text-uppercase text-color-secondary p-relative top-2">Send
							E-mail</strong>
                                        @if (theme_option('contact_email'))
									<a href="mailto:{{ theme_option('contact_email') }}"
										class="text-decoration-none font-secondary text-5 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap p-relative bottom-2">{{ theme_option('contact_email') }}</a>
                                        @endif
								</div>
							</div>
						</div>
					</div>
			
				</div>
				<div class="appear-animation" data-appear-animation="fadeInUpShorter"
					data-appear-animation-delay="1000">
					<p class="text-2-5 pt-3">*Submitting your information, you consent to the terms of this <a
							href="#"
							class="text-decoration-underline text-color-secondary text-color-hover-primary">Privacy
							Notice.</a></p>
				</div>
			</div>

			<div class="col-lg-5 p-relative">

				<form  action="" method="post">
					@csrf
					{{-- <div class="contact-form-success alert alert-success d-none mt-4">
						<strong>Success!</strong> Your message has been sent to us.
					</div>

					<div class="contact-form-error alert alert-danger d-none mt-4">
						<strong>Error!</strong> There was an error sending your message.
						<span class="mail-error-message text-1 d-block"></span>
					</div> --}}

					<div class="row">
						<div class="form-group col-lg-6">
							<label class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Your
								Name *</label>
							<input type="text"  placeholder="Enter Your Name" class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2" name="name" required>
								@error('name')
								<span style="color:red;">{{$message}}</span>
								@enderror
							  <span class="error-message" id="captcha-error"></span> 
						</div>
						<div class="form-group col-lg-6">
							<label
								class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Email
								Address</label>
							<input type="email" placeholder="Enter Your E-mail Address" class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2" name="email" required>
								@error('email')
								<span style="color:red;">{{$message}}</span>
								@enderror
							  <span class="error-message" id="captcha-error"></span> 
						</div>
					</div>
					<div class="row">
						<div class="form-group col-lg-6">
							<label
								class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Phone
								Number</label>
							<input type="text" placeholder="Your Phone Number" class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2" name="phone_display" id="phone" type="tel" required>
							<input type="hidden" id="full_phone" name="phone">
								@error('phone')
								<span style="color:red;">{{$message}}</span>
								@enderror
							  <span class="error-message" id="captcha-error"></span>
						</div>
						<div class="form-group col-lg-6">
							<label
								class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Country</label>
							<input type="text" placeholder="Enter Your Country" class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2" name="location" required>
								@error('location')
								<span style="color:red;">{{$message}}</span>
								@enderror
							  <span class="error-message" id="captcha-error"></span> 
						</div>
					</div>

					<div class="row">
						<div class="form-group col">
							<label
								class="form-label font-weight-bold text-uppercase text-dark mb-1 text-2">Message</label>
							<textarea maxlength="5000" placeholder="Enter Message" rows="8" class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2" name="mes" required></textarea>
								@error('mes')
								<span style="color:red;">{{$message}}</span>
								@enderror
							  <span class="error-message" id="captcha-error"></span>
						</div>
					</div>
					{{-- <div class="col-lg-12">
						<label
						class="form-label font-weight-bold text-uppercase text-dark mb-1 text-4">Validation Code : <?php echo $mycaptcha;?></label>
				
				  <input id="captcha" class="form-control text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2" type="text" name="captcha" placeholder=" Enter Validation Code *"   required>
				  <input id="kcaptcha"  type="hidden" name="kcaptcha"  value="<?php echo $mycaptcha; ?>" >
				  
				  @error('captcha')
			  <span style="color:red;">{{$message}}</span>
			  @enderror
			<span class="error-message" id="captcha-error"></span> <br/>
					</div> --}}

					<div class="row">
						<div class="form-group col">
							<button name="submit" type="submit" value="Submit"
								class="btn btn-rounded btn-dark box-shadow-7 font-weight-medium btn-swap-1"
								data-clone-element="1">
								<span>Submit <i
										class="fa-solid fa-arrow-right ms-2 p-relative left-10"></i></span>
							</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>