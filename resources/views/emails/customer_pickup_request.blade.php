@include('emails.components.header')
<div class="content">
    <p>Hello {{$name}}!</p>
    <p>We are excited to inform you that your pickup request has been received successfully.</p>
    <p>If you have any questions or need further assistance, feel free to contact us.</p>
    <p>Thank you for using our application!</p>
    <a href="#" class="btn" style="color: white">Visit Site</a>
</div>
@include('emails.components.footer')        
