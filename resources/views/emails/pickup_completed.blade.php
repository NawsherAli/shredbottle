@include('emails.components.header')
<div class="content">
    <p>Hello {{$name}}!</p>
    <p>{{$msg}}</p>
    <h3>Pickup Details</h3>
    <table border cellspacing="0" cellpadding="4" width="100%">
    	<tr>
    		<!-- <th>ID</th> -->
    		<th>Total Items</th>
    		<th>Amount</th>
    		<th>Payment Option</th>
            @if($payment_option == 'Donate')
            <th>Organization</th>
            @endif
    	</tr>
    	<tr>
    		<!-- <td>123</td> -->
    		<td>{{$items}}</td>
    		<td>{{$amount}}</td>
            <td>{{$payment_option}}</td>
            @if($payment_option == 'Donate')
    		<td>{{$organization}}</td>
            @endif
    	</tr>
    </table>
    <p>If you have any questions or need further assistance, feel free to contact us.</p>
    <p>Thank you for using our application!</p>
    <p>For more details!</p>
    <a href="#" class="btn" style="color: white">Visit Site</a>
</div>
@include('emails.components.footer')        
