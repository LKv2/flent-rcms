@switch($type)
    @case('CarteGrise')
        @if (pathinfo(asset('storage/' . $car->cartegrise), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $car->cartegrise) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $car->cartegrise) }}" alt="" srcset="">
        @endif
    @break

    @case('Control')
        @if (pathinfo(asset('storage/' . $car->control), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $car->control) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $car->control) }}" alt="" srcset="">
        @endif
    @break

    @case('Autorisation')
        @if (pathinfo(asset('storage/' . $car->autorisation), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $car->autorisation) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $car->autorisation) }}" alt="" srcset="">
        @endif
    @break

    @case('Vignette')
        @if (pathinfo(asset('storage/' . $car->vignette), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $car->vignette) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $car->vignette) }}" alt="" srcset="">
        @endif
    @break

    @case('Issurance')
        @if (pathinfo(asset('storage/' . $car->issurance), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $car->issurance) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $car->issurance) }}" alt="" srcset="">
        @endif
    @break

    @case('Joint')
        @if (pathinfo(asset('storage/' . $car->joint), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $car->joint) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $car->joint) }}" alt="" srcset="">
        @endif
    @break

    @case('CIN')
        @if (pathinfo(asset('storage/' . $client->file_input_C), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $client->file_input_C) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $client->file_input_C) }}" alt="" srcset="">
        @endif
    @break

    @case('Permis')
        @if (pathinfo(asset('storage/' . $client->file_input_P), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $client->file_input_P) }}" type="application/pdf" width="100%" height="500">
        @else
            <img src="{{ asset('storage/' . $client->file_input_P) }}" alt="" srcset="">
        @endif
    @break

    @case('Passport')
        @if (pathinfo(asset('storage/' . $client->file_input_Pass), PATHINFO_EXTENSION) == 'pdf')
            <embed src="{{ asset('storage/' . $client->file_input_Pass) }}" type="application/pdf" width="100%"
                height="500">
        @else
            <img src="{{ asset('storage/' . $client->file_input_Pass) }}" alt="" srcset="">
        @endif
    @break

@endswitch
