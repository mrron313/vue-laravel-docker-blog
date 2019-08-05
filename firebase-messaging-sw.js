/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
	apiKey: "AIzaSyBBCIU0GGrYeXGqVVc3o9tRcHwttL9zQKE",
	authDomain: "ron-test-8259b.firebaseapp.com",
	databaseURL: "https://ron-test-8259b.firebaseio.com",
	projectId: "ron-test-8259b",
	storageBucket: "ron-test-8259b.appspot.com",
	messagingSenderId: "780107221889"
});


const messaging = firebase.messaging();

