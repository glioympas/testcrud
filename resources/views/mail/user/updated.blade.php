@component('mail::message')
# Your profile has been updated

Dear {{ $user->name }}, your profile has been updated successfully.

<!-- Το κουμπί δε θα λειτουργεί επειδή δεν είναι αληθινό domain και πάει στο localhost/home. Σε production θα λειτουργεί όπως πρέπει. -->
@component('mail::button', ['url' => url('/home')]) 
Visit Your Profile 
@endcomponent


@endcomponent
