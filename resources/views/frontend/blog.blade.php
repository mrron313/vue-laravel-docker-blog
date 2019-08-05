@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <router-view></router-view>
</div>
@endsection

<script>
    window.auth_user = {!! json_encode($auth_user); !!};
</script>


<script
src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase.js"></script>

<script>

    $(document).ready(function(){

        var config = {
            apiKey: "AIzaSyBBCIU0GGrYeXGqVVc3o9tRcHwttL9zQKE",
            authDomain: "ron-test-8259b.firebaseapp.com",
            databaseURL: "https://ron-test-8259b.firebaseio.com",
            projectId: "ron-test-8259b",
            storageBucket: "ron-test-8259b.appspot.com",
            messagingSenderId: "780107221889",
            appId: "1:780107221889:web:006dd8ec664dcd65"
        };

        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification permission granted.");
                
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token)

                $.ajax({
                    url: '{{ route("api.user.devicetoken.save") }}',
                    type: 'POST',
                    data: {
                        id: window.auth_user.id,
                        user_device_token: token
                    },
                    dataType: 'JSON',
                    success: function (response) { 
                        console.log(response)
                    }
                }); 

            })
            .catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });
    
        messaging.onMessage(function(payload) {
            console.log("Message received. ", payload);
            
            noteTitle = payload.notification.title; 
            noteOptions = {
                body: payload.notification.body,
                icon: "typewriter.jpg", 
            };
        
            console.log("title ",noteTitle, " ", payload.notification.body);

            new Notification(noteTitle, noteOptions);
        });

    });

</script>

