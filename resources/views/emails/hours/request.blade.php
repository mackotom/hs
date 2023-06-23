<x-mail::message>
# {{ __('mail.hello') }} {{ $contact->firstname }},

{{ trans_choice('mail.requestHours.info', $numberHours, ['numberHours' => $numberHours]) }}.

<x-mail::table>
| {{__('mail.requestHours.table.headers.reason')}} | {{__('mail.requestHours.table.headers.number')}} | {{__('mail.requestHours.table.headers.date')}} |
| ------ | :---------------: | :----: |
@foreach($additional_hours as $additional_hour)
| {{ $additional_hour->reason }} | {{ $additional_hour->hours }} | {{ $additional_hour->date }} |
@endforeach
</x-mail::table>


{{ __('mail.thanks') }},<br>
{{ $username }}
</x-mail::message>
