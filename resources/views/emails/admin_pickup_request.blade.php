@include('emails.components.header')
<div class="content">
    <p>Hello {{$name}}!</p>
    <p>We are excited to inform you that a new pickup request has been received successfully.</p>
</div>
@include('emails.components.footer')  