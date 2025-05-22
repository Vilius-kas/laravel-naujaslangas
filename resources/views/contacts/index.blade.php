@extends('layouts.contact')

@section('content')
<div class="container">
    <h2>Kontaktų sąrašas</h2>

    <a href="{{ route('contacts.trashed') }}">🗑️ Peržiūrėti ištrintus kontaktus</a>

    @auth
        <div style="margin-top: 10px;">
            <a href="{{ route('contacts.pdf') }}" target="_blank">📄 Atsisiųsti PDF</a>
        </div>
    @endauth

    <br>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($contacts as $contact)
            <li style="margin-bottom: 5px;">
                <strong>{{ $contact->name }}</strong> – {{ $contact->phone }} – {{ $contact->email }}

                @auth
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;" onsubmit="return confirm('Ar tikrai nori ištrinti?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red;">Ištrinti</button>
                    </form>
                @endauth
            </li>
        @endforeach
    </ul>

    @auth
        <div style="margin-top: 10px;">
            <a href="{{ route('contacts.create') }}">➕ Pridėti naują kontaktą</a>
        </div>
    @endauth
</div>
@endsection
