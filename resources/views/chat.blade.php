@extends('layouts.app')
@section('content')
 <div class="container">
    <h1>Chat Box</h1>
    <div class="row">
        <div class="col-md-8">
         <div class="row">   
           <div class="col-md-12">  
            <!-- below code will pass 3 props (messages,from_user,to_user) to the message component  -->
            <message-component :messages="messages" :from_user="{{ Auth::user()->id }}" :to_user="to_user_id" />    
           </div>
         </div>
         <div class="row mt-2">   
           <!-- below would pass 2 props (user,to_user) to the form component and chatmessage event would retrive message details emited from the form component -->
         <form-component v-on:chatmessage="addmessage" :user="{{ Auth::user()->id }}" :to_user="to_user_id" />
        </div>
        </div>
        <!-- below would emit the selected user from the user list from user component -->
        <user-component v-on:selectuser="selectcurrentuser" />
    </div>
</div>   
@endsection