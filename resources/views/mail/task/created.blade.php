@component('mail::message')
# New Task

You have been assigned a new task.

<h5>TASK DETAILS</h5>

@component('mail::text', ['text' => $content])

@endcomponent


@component('mail::button', ['url' => $url])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
