@include('emails.components.header')
<div class="content">
    <p>Hello {{$name}}!</p>
    <p>We are excited to inform you that  a new claim balance request has been received.</p>
    <h3>Request Details</h3>
    <table border cellspacing="0" cellpadding="4" width="100%">
    	<tr>
    		<th>Request ID</th>
    		<th>User </th>
    		<th>Contact</th>
    		<th>E Transfer No</th>
    	</tr>
    	<tr>
    		<td>{{$request_id}}</td>
    		<td>{{$user_name}}</td>
    		<td>{{$contact}}</td>
    		<td>{{$e_transfer_no}}</td>
    	</tr>
    </table>
</div>
@include('emails.components.footer') 