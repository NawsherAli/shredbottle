@include('emails.components.header')
<div class="content">
    <p>Hello {{$name}}!</p>
    <p>We are excited to inform you that  your claim balance request has been copleted successfully and the amount has been sent on <b>{{$e_transfer_no}}</b> E-Transfer no Number.</p>
    <h3>Transaction Details</h3>
    <table border cellspacing="0" cellpadding="4" width="100%">
    	<tr>
    		<th>Request ID</th>
    		<th>Amount</th>
            <th>Transaction No</th>
            <th>Transaction Date</th>
    		<th>E Transfer No</th>
    	</tr>
    	<tr>
    		<td>{{$request_id}}</td>
    		<td>${{$amount}}</td>
    		<td>{{$transaction_no}}</td>
    		<td>{{$date}}</td>
            <td>{{$e_transfer_no}}</td>
    	</tr>
    </table>
    <p>If you have any questions or need further assistance, feel free to contact us.</p>
    <p>Thank you for using our application!</p>
    <p>For more details!</p>
    <a href="#" class="btn" style="color: white">Visit Site</a>
</div>
@include('emails.components.footer') 