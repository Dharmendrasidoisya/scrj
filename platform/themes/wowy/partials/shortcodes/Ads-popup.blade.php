<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <style>
        .modal-body input,
        .modal-body textarea {
            margin-bottom: 10px;
        }

        .sbn-btn {
            background-color: #000;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .sbn-btn:hover {
            background-color: #218838;
        }

        .modal-header h4 span {
            color: #000;
        }

        .close {
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
            color: #000;
            margin-left: 315px;
        }
    </style>
    <style>
        @media only screen and (max-width: 600px) {
            #memberModal {
                margin-top: 50% !important;
            }

            .lds {
                margin-left: 75px !important;
            }

            .ldd {
                float: right;
            }

            .float1 {
                left: 88% !important;
            }

            .lbldes {
                display: none !important;
            }

            .iconwhatsup {
                display: block !important;
            }

            #popup {
                background-image: none;
            }

            .xs-h-300px {
                height: 161px !important;
            }
        }

        .form-control,
        .form-select,
        input,
        select,
        textarea {
            padding: 4px 8px;
            margin-bottom: 15px;
            /* background: #000; */
            border: 1px solid #000 !important;
        }

        @media screen and (max-width: 1920px) {
            .quick-call-button {
                display: block !important;
            }
        }

        @media screen and (min-width: 1024px) {
            .call-now-button .call-text {
                display: none !important;
            }

            .quick-call-button {
                top: 50%;
            }
        }

        @media screen and (max-width: 1024px) and (min-width: 680px) {
            .call-now-button .call-text {
                display: initial;
            }

            .quick-call-button {
                top: 50%;
            }
        }

        @media screen and (max-width: 680px) {
            .call-now-button .call-text {
                display: initial;
            }

            .quick-call-button {
                top: 76%;
            }
        }

        .quick-call-button {
            left: 2%;
            background: #1a1919;
        }

        .call-now-button a .quick-alo-ph-img-circle,
        .call-now-button a .quick-alo-phone-img-circle {
            background-color: #2b6bbf;
        }

        .modal-header {
            display: block !important;
        }

        .modal .modal-dialog {
            height: auto !important;
        }

        #memberModal {
            margin-top: 10%;
        }

        .form-control {
            border: 1px solid #000;
            color: #fff !important;
        }

        .form-control:focus {
            color: #000 !important;
        }

        @media (max-width: 992px) {
            .menu-text {
                display: inline;
            }
        }

        .logo-img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 991.98px) {
            .logo-img {
                width: 110px;
            }
        }

        @media (min-width: 992px) {
            .logo-img {
                width: 140px;
            }
        }

        #auto-slider {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }

        .slider-content {
            display: flex;
            transition: transform 0.1s linear;
        }

        .location-card-three {
            flex: 0 0 auto;
            min-width: 268px;
            margin-right: 20px;
            margin-left: 20px;
        }

        .block-feature-twelve .wrapper .location-card-three {
            margin: 30px 45px 0 !important;
        }

        @media screen and (min-device-width: 1100px) and (max-device-width: 1366px) {
            .location-card-three .image-bg {
                width: 195px !important;
                height: 195px !important;
            }
        }

        @media screen and (min-device-width: 1367px) and (max-device-width: 1440px) {
            .location-card-three .image-bg {
                width: 195px !important;
                height: 195px !important;
            }
        }

        @media screen and (min-device-width: 1440px) and (max-device-width: 1600px) {
            .location-card-three .image-bg {
                width: 195px !important;
                height: 195px !important;
            }
        }

        @media screen and (max-device-width: 600px) {
            #popup {
                background-image: none !important;
            }
        }

        #popup {
            background-image: url(storage/maximize-efficiency.jpg);
            background-position: left;
            background-size: 100% 100%;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 750px !important;
                margin-right: auto;
                margin-left: auto;
            }
        }

        .no-gutters {
            /* margin-right: auto; */
            margin-left: 30%;
            max-width: 750px;
        }

        @media screen and (max-device-width: 600px) {
            .no-gutters {
                /* margin-right: auto; */
                margin-left: 0%;
                max-width: 750px;
            }

            .lmobile {
                margin-top: -113px !important;
            }
        }
    </style>
</head>

<body>

    {{-- <h2>Popup Form</h2>
<p>Click on the button at the bottom of this page to open the login form.</p>
<p>Note that the button and the form is fixed - they will always be positioned to the bottom of the browser window.</p> --}}
    {{-- <section class="enquiry-modal d-flex justify-content-center" style="padding:0px;">
        <div class="modal fade show" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel"
            aria-hidden="true" style="opacity:1; display:block;">
            <div class="modal-dialog modal-dialog-scrollable h-100 d-flex flex-column justify-content-center  lmobile"
                role="document">
                <div class="row no-gutters">
                    <div class="col-md-6 d-lg-flex d-md-flex d-sm-none" style="padding: 0;">
                        <div class="modal-body p-5 img d-flex" id="popup">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex" style="padding: 0;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button id="btnclose" type="button" class="close">X</button>
                                <h4  id="memberModalLabel">Get <span>In Touch</span></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" name="form" id="form">
                           

                                    <input type="text" name="name" id="name" placeholder="Name"
                                        class="form-control" required>
                                    <input type="email" name="mail" id="mail" placeholder="Email"
                                        class="form-control" required>
                                    <input type="text" name="subj" id="subj" placeholder="Phone"
                                        class="form-control" required>
                                    <input type="text" name="location" id="location" placeholder="Location"
                                        class="form-control">
                                    <textarea name="message" id="message" placeholder="Message" class="form-control"></textarea>

                                    <button type="button" name="submit" class="float-right sbn-btn btn-six"
                                        onclick="PostData(this.form)"> 
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <input name="vind" type="hidden" id="vind" value="57236" ifkey="vind">
                                <input name="ctype" type="hidden" id="ctype" value="I1237" ifkey="ctype">
                                <input name="pname" type="hidden" id="pname" value="RSC Group Dholera" ifkey="pname"> --}}
    <!-- jQuery and Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

    <script>
        // Close modal when close button is clicked
        document.getElementById('btnclose').addEventListener('click', function() {
            document.getElementById('memberModal').style.display = 'none';
        });
    </script>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .open-button {
            z-index: 999;
    background-color: #000;
    color: white;
    padding: 10px 17px;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    position: fixed;
    bottom: 23px;
    right: 28px;
    /* width: 280px; */
    border-radius: 16px;
        }

        /* Chat popup */
        .chat-popup,
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 1px solid #ccc;
            background-color: white;
            z-index: 1000;
            width: 320px;
            height: 500px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Message area */
        .chat-container {
            padding: 10px;
            height: 350px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        /* Message styling */
        .message {
            padding: 10px;
            margin: 5px;
            border-radius: 10px;
            max-width: 80%;
            font-size: 14px;
        }

        .message.user {
            background-color: #000;
            color: white;
            margin-left: auto;
            text-align: right;
        }

        .message.bot {
            background-color: #e5e5ea;
            color: black;
            margin-right: auto;
            text-align: left;
        }

        /* Input area */
        .input-area {
            padding: 10px;
            background-color: #f1f1f1;
            border-top: 1px solid #ccc;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .input-area input[type="text"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        .send-btn {
            background-color: #000;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        /* Form popup */
        .form-popup {
            padding: 20px;
        }

        .form-popup h2 {
            margin-top: 0;
        }

        .form-popup input[type="text"],
        .form-popup input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-popup button {
            /* background-color: #04AA6D; */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            /* width: 100%; */
        }

        .form-popup button:hover {
            background-color: #45a049;
        }

        .close-btn {
            position: absolute;
            top: 18px;
            right: 10px;
            background-color: #000;
            /* Red color for visibility */
            color: #fff;
            padding: 8px 12px !important;
            border: none;
            border-radius: 10px !important;
            /* Circular button */
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .close-btn:hover {
            background-color: #000;
            transform: scale(1.1);
            /* Slightly enlarge on hover */
        }

        h2 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 30px;
            margin: 0px 0px 0px 2px;
        }

        button[type=submit]:hover {
            background-color: var(--color-primary) !important;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #000 !important;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #000 !important;
            opacity: 0.9;
            /* Slight opacity effect on hover */
        }

        button[type=submit]:hover {
            background-color: #000 !important;
        }

        .form-popup button:hover {
            background-color: #000;
        }
        .chat-header {
    display: flex;
    align-items: center;
    background-color: #000; /* Black background */
    color: #fff; /* White text */
    padding: 12px 16px;
    font-size: 16px;
    font-weight: bold;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.back-arrow {
    margin-right: 8px;
    cursor: pointer;
    font-size: 18px;
}

.chat-title {
    font-size: 16px;
    font-weight: bold;
}
.form-header {
    display: flex;
    align-items: center;
    background-color: #000; /* Black background */
    color: #fff; /* White text */
    padding: 12px 16px;
    font-size: 16px;
    font-weight: bold;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.back-arrow {
    margin-right: 8px;
    cursor: pointer;
    font-size: 18px;
}

.form-title {
    font-size: 16px;
    font-weight: bold;
}

.form-popup {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.form-subtitle {
    color: #333;
    font-size: 14px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.submit-btn {
    background-color: #000;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    width: 100%;
    cursor: pointer;
    font-size: 16px;
}

    </style>
</head>

<body>

    {{-- <h2>Popup Form</h2>
<p>Click on the button at the bottom of this page to open the login form.</p>
<p>Note that the button and the form is fixed - they will always be positioned to the bottom of the browser window.</p> --}}


    <!-- Open Button -->
    <button class="open-button" onclick="openChat()"> <i class='fas fa-comment-dots'></i> Chat</button>

    <!-- Chat Popup -->
    <div class="chat-popup" id="chatPopup">
        <div class="chat-header">
            <span class="back-arrow" onclick="closeChat()">←</span>
            <span class="chat-title">Chat</span>
        </div>
        <div class="chat-container" id="chatContainer">
            <div class="message bot">Hello! How can I help you today?</div>
        </div>
        <div class="input-area">
            <input type="text" id="chatInput" placeholder="Type a message...">
            <button class="send-btn" onclick="sendMessage()">Send</button>
        </div>
    </div>
    

    <!-- Form Popup -->
    <div class="form-popup" id="formPopup">
        <div class="form-header">
            <span class="back-arrow" onclick="closeForm()">←</span>
            <span class="form-title">Chat</span>
        </div>
        <h2 class="form-subtitle text-center fw-bold mb-3" style="font-size: 2rem; color: #333; letter-spacing: 1px;">
            <span style="display: inline-block; padding-bottom: 0px;
            padding-top: 15px;">
                Let's Get Started
            </span>
        </h2>
        <p class="text-center text-muted mb-4" style="font-size: 1.1rem; line-height: 1.6; max-width: 600px; margin: 0 auto;">
            Please provide your information so we can reply to you if you leave the chat.
        </p>
        
        
        <form id="userForm" onsubmit="submitForm(event)">
            <div class="form-group">
                <input type="text" id="Name" name="name" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="text" id="phonenumber" name="phone" placeholder="Phone Number" required>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <script>
        let chatTimeout;

        // Open Chat Function
        function openChat() {
            document.getElementById("chatPopup").style.display = "block";
        }

        // Close Chat Function
        function closeChat() {
            document.getElementById("chatPopup").style.display = "none";

            // 5 second pachi chat popup automatic open thay
            clearTimeout(chatTimeout);
            chatTimeout = setTimeout(() => {
                openChat();
            }, 5000);
        }

        function closeForm() {
            document.getElementById("formPopup").style.display = "none";
        }

        function sendMessage() {
            const input = document.getElementById("chatInput");
            const message = input.value.trim();

            if (message !== "") {
                addUserMessage(message);
                input.value = "";

                // Open form after message send
                setTimeout(() => {
                    openForm();
                }, 500);
            }
        }

        function addUserMessage(text) {
            const userMessage = document.createElement("div");
            userMessage.classList.add("message", "user");
            userMessage.innerText = text;
            document.getElementById("chatContainer").appendChild(userMessage);

            scrollToBottom();
        }

        function openForm() {
            document.getElementById("formPopup").style.display = "block";
        }

        function submitForm(event) {
    event.preventDefault();

    const name = document.getElementById("Name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phonenumber").value;

    if (name && email && phone) {
        $.ajax({
            url: "{{ route('public.send.contact1') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}', // CSRF token for Laravel
                name: name,
                email: email,
                phone: phone
            },
            beforeSend: function () {
                $(".submit-btn").prop("disabled", true).text("Submitting...");
            },
            success: function (response) {
                if (response.success) {
                    window.location.href = "/thankyou.html"; 
                }
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseJSON.message);
            },
            complete: function () {
                $(".submit-btn").prop("disabled", false).text("Submit");
            }
        });
    }
}



        function addBotMessage(text) {
            const botMessage = document.createElement("div");
            botMessage.classList.add("message", "bot");
            botMessage.innerText = text;
            document.getElementById("chatContainer").appendChild(botMessage);

            scrollToBottom();
        }

        function scrollToBottom() {
            const chatContainer = document.getElementById("chatContainer");
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // **5 second pachi auto open karva mate**
        window.onload = () => {
            chatTimeout = setTimeout(() => {
                openChat();
            }, 500000000);
        };
    </script>




</body>

</html>
