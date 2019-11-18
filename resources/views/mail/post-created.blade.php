@component('mail::message')

hello {{ $user->name }},

Your post <b>{{ $post->title }}</b> has been published

@component('mail::button', ['url' => env('APP_URL')."/posts/$post->id" ])
check your post
@endcomponent

Thanks,<br>
Blogg team
@endcomponent
