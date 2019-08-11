<p>Dear {{ $name }}</p>
<br>
Thank you for the registration. Your account has been create with: <br>
<strong>User Name: {{ $email }}</strong><br>
<strong>Password: ******** </strong>
<br>
<br>
Please click the link below or copy paste in browser's url to activate your account: <br>
<a href="{{ route('activate',[$user_id, $act_token]) }}">
    {{ route('activate',[$user_id, $act_token]) }}
</a>
<br>
<br>
Regards,<br>
System, Nayabazar.com
