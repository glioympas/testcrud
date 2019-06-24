@component('mail::message')
# New Customer

We would like to inform you that customer {{ $customer->name }} created. <br>
Customer's email: {{ $customer->email }}

Best Regards,<br>
Testing CRUD app

@endcomponent
