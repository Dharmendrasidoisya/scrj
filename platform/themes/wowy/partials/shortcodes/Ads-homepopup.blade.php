
<style>
@media only screen and (max-width: 600px) {
  textarea {
    min-height: 96px!important;
    resize: vertical;
}
	.justify-content-center{
	justify-content: flex-start!important;
	}
	}
    textarea {
    min-height: 200px;
    resize: vertical;
}
	.justify-content-center{
	justify-content: center;
	}
</style>

<section class="enquiry-modal d-flex justify-content-center" style="padding:0px;">
    <div class="modal fade inquirynone" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable h-100 d-flex flex-column justify-content-center" role="document">
            <div class="row no-gutters">
                <div class="col-md-6 d-lg-flex d-md-flex d-sm-none" style="padding: 0;">
                    <div class="modal-body p-5 img d-flex mobilenone"
                        style="background-image: url('{{ asset('themes/wowy/ads/images/home/popuphome.jpg') }}'); background-position: left; background-repeat: no-repeat;">
                    </div>
                </div>
                <div class="col-md-6 d-flex" style="padding: 0;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button id="btnclose" type="button" style="float: right;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center" id="memberModalLabel">Get <span>In Touch</span></h4>
                        </div>
                        <div class="modal-body">
                            <!-- Contact Form -->
							
							 <form class="form contact-form  form" method="post" name="form">
                        <input name="vind" type="hidden" id="vind" value="44917" ifkey="vind" />
                        <input name="ctype" type="hidden" id="ctype" value="I1114" ifkey="ctype" />
                        <input name="pname" type="hidden" id="pname" value="scrj" ifkey="pname" />
                   
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input name="name" id="name" placeholder="{{ __('Name') }}" style="background: #B8860E;"
                                        type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input type="email" name="mail" id="mail" style="background: #B8860E;"
                                        placeholder="{{ __('Email') }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input name="subj" id="subj" placeholder="{{ __('Phone') }}" style="background: #B8860E;"
                                        type="text">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input name="location" id="location" placeholder="{{ __('Location') }}" style="background: #B8860E;"
                                        type="text">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 mb-20">
                                <div class="textarea-style">
                                    <textarea name="message" id="message" placeholder="Message" style="background: #f9f7f1;"></textarea> 
                                </div>
                            </div>

                         

                            <div class="col-lg-12 col-md-12">
                                <button type="button" name="submit" onclick="PostData(this.form)"
                                   class="submit submit-auto-width">
                                    <span>   {{ __('Submit') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
							
							
                            
                        </div>
                    </div>
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

    <script>
    document.getElementById('btnclose').addEventListener('click', function () {
        $('#memberModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
</script>