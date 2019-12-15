@component('mail::message')

Daily report:

{{ $users_count }} new users have signed up in the last 24h.
<br>
{{ $posts_count }} new posts have been created in the last 24h.


Thanks,<br>
Blogg team
@endcomponent
