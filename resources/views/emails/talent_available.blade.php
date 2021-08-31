@component('mail::message')
<img src="{{asset('images/logo-2.png')}}" width="150" alt="logo">
<br>
<br>
<br>
<img src="{{(auth()->user()->avatar) ? asset('storage/content/avatar/' . auth()->user()->avatar) : asset('images/avatar.png')}}" width="100" style="margin-right:10px;border-radius:10px;" alt="avatar">
<b>{{auth()->user()->name}}</b> is available now.

@component('mail::button', ['target' => 'blank', 'url' => route('talent.profile', ['username' => auth()->user()->username])])
Open profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
