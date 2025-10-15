<section class=" mobiletop">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-10 m-auto topcontact">
                <div class="contact-from-area  padding-20-row-col wow tmFadeInUp animated" style="visibility: visible;">
                    <h3 class="mb-10 text-center">{{ __('Drop Us a Line') }}</h3>
                    <p class="text-muted mb-30 text-center font-sm">{{ __('Contact Us For Any Questions') }}</p>

                    
                    <form class="form contact-form pe-lg-5 form" method="post" name="form">
                        <input name="vind" type="hidden" id="vind" value="44917" ifkey="vind" />
                        <input name="ctype" type="hidden" id="ctype" value="I1114" ifkey="ctype" />
                        <input name="pname" type="hidden" id="pname" value="scrj" ifkey="pname" />
                   
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input name="name" id="name" placeholder="{{ __('Name') }}"
                                        type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input type="email" name="mail" id="mail"
                                        placeholder="{{ __('Email') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input name="subj" id="subj" placeholder="{{ __('Phone') }}"
                                        type="text">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input name="location" id="location" placeholder="{{ __('Location') }}"
                                        type="text">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="textarea-style">
                                    <textarea name="message" id="message" placeholder="Message"></textarea> 
                                </div>
                            </div>

                         

                            <div class="col-lg-12 col-md-12">
                                <button type="button" name="submit" onclick="PostData(this.form)"
                                   class="submit submit-auto-width mt-30">
                                    <span>   {{ __('Submit') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
	
success: function (data) {
    var vstatus = data;
    if (vstatus == "2" || vstatus == "4") {
        window.location.href = '/thankyou.html';
    } else {
        alert("Something went wrong. Please try again.");
    }
},
</script>
<style>
    .topcontact {

        margin-top: 125px !important;
    }

    @media only screen and (max-width: 600px) {
        .topcontact {

            margin-top: 30px !important;
        }
        .mobiletop {
        margin-top: 0px !important;
    }
    }
</style>