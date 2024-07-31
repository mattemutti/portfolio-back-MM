<x-mail::message>
    # Introduction

    Inviato da: {{ $lead->name }}

    Email: {{ $lead->email }}

    Messaggio: {{ $lead->message }}

    {{-- <x-mail::button url="">
        Button Text
    </x-mail::button> --}}

</x-mail::message>
