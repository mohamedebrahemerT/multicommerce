
@component('mail::message')
# Introduction

The body of your message.

thanks our customers {{$data['user']->name }}
your code {{$data['code'] }}



your  mail is  {{$data['user']->email }}

@component('mail::button', ['url' =>$data['url'].'/Email_verfiy_user/'.$data['token'] ])
 click here to  verfiy your Email
@endcomponent


       

 
 
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
