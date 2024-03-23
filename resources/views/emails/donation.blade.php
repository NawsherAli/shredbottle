@include('emails.components.header')
<div class="content">
    <p>Hello {{$name}}!</p>
    <p>{{$msg}}</p>
    <h3>Donation Details</h3>
    <table border cellspacing="0" cellpadding="4" width="100%">
    	<tr>
    		<th>Donor</th>
    		<th>Amount</th>
    		<th>No of Items</th>
        </tr>
    	<tr>
    		<td>{{$donor_user}}</td>
    		<td>{{$amount}}</td>
    		<td>{{$items}}</td>
         </tr>
    </table>
    <p>If you have any questions or need further assistance, feel free to contact us.</p>
    <p>Thank you for using our application!</p>
    <p>For more details!</p>
    <a href="#" class="btn" style="color: white">Visit Site</a>
</div>
@include('emails.components.footer')        
