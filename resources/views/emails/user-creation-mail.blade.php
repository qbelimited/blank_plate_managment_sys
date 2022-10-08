@component('mail::message')


  <h4>{{ $details['title'] }},</h4>


  <p> Please find your account information below :</p>
  <p>{{ $details['body'] }}</p>

  @component('mail::button', ['url' => $details['url']])
    Click to get Started
  @endcomponent

  Best regards,<br>Company Name Here
  {{-- {{config(app.name)}} --}}
@endcomponent
