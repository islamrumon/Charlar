@extends('layouts.master')
@section('title') @translate(Push Notification) @endsection
@section('main-content')
    <div class="card ">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Push Notification)</h2>
            </div>
            <div class="float-right">

            </div>
        </div>

        <div class="card-body">
            <form action="{{route('google.push.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <strong>@translate(For get right data and outpur setup firebase push notifications  properly)</strong>

                <div class="form-group">
                    <label>@translate(Push Notification Active) <span class="text-danger">*</span></label>
                    <select class="form-control select" name="push_notify_active">
                        <option value="No"  {{ getSystemSetting('push_notify_active') == 'No' ? 'selected' : null }}>No</option>
                        <option value="Yes" {{ getSystemSetting('push_notify_active') == 'Yes' ? 'selected' : null }}>Yes</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>@translate(Vpid Key) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('vapidKey') }}" type="text"  name="vapidKey" required>
                </div>

                <div class="form-group">
                    <label>@translate(Server Key) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('serverKey') }}" type="text"  name="serverKey" required>
                </div>


                <div class="form-group">
                    <label>@translate(Upload custome firebase-messaging-swp.js file) <span class="text-danger">*</span></label>
                    <strong>@translate(Follow the) firebase-messaging-swp.js @translate(sample in down), @translate(and assign the proper value) , @translate(If you face any problem contact to support)</strong>
                    <input class="form-control-file"  type="file"  name="firebase_messaging_swp" >
                </div>

                <a href="{{ asset('firebase-messaging-swp.js') }}" class="nav-link">firebase-messaging-swp.js link</a>

                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
    </div>

    <div class="card">
          <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Copy this script), @translate(and create a js file and past the code and update this new created script), @translate(if you face any problem contact us) </h2>
            </div>
            <div class="float-right">

            </div>
          </div>
          <div class="card-body">
      <pre>
<!--Start -->

        importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
        importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');


            firebase.initializeApp({
                apiKey: "{{ env('apiKey') }}",
                authDomain: "{{ env('authDomain') }}",
                projectId: "{{ env('projectId') }}",
                storageBucket: "{{ env('storageBucket') }}",
                messagingSenderId: "{{ env('messagingSenderId') }}",
                databaseURL: "{{ env('databaseURL') }}",
                appId: "{{ env('appId') }}",
                measurementId: "{{ env('measurementId') }}"
            });
            const messaging = firebase.messaging();
            messaging.setBackgroundMessageHandler(function(payload) {
            console.log(
                "[firebase-messaging-sw.js] Received background message ",
                payload,
            );
        });


<!--End -->
      </pre>
          </div>
    </div>
@endsection


