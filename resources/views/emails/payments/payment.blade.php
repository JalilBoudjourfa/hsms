{{-- blade-formatter-disable --}}
{{-- ! indentation breaks the markdown style --}}

@component('mail::message')
# {{ config("app.CLIENT_NAME") }}

## Notice de paiement

Votre enfant a été selectionné pour rejoindre notre école. Veuillez procéder au paiement des frais de scolarité pour confirmer l'inscription.
{{-- Veuillez vous présenter à l'établissement pour éffectuer le payment. --}}

@component('mail::panel')
{{ $student->user->name }}
@endcomponent

## Détails de l'inscription

@component('mail::table')
| Etablissement                  |    Année scolaire     |            Cycle            |                  Classe |
| ------------------------------ | :-------------------: | :-------------------------: | ----------------------: |
| {{ $est_y->establishment_id }} | {{ $est_y->year_id }} | {{ $class_type->cycle_id }} | {{ $class_type->name }} |
@endcomponent

Merci,<br>
{{ config("app.CLIENT_NAME") }}.
@endcomponent
