@extends('layouts.contact')
@section('content')
<div class="container">
<h2>Contact List</h2>

<a href="{{ route('contacts.trashed') }}">Peržiūrėti ištrintus kontaktus</a>
<br><br>

@if(session('success'))
<div style="color: green">{{ session('success') }}</div>
@endif
<ul>
        @foreach($contacts as $contact)
            <li>
                {{ $contact->name }} - {{ $contact->phone }} - {{ $contact->email }}

                @auth
                    <!-- DELETE forma -->
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;" onsubmit="return confirm('Ar tikrai nori ištrinti?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red;">Delete</button>
                    </form>
                @endauth
            </li>
        @endforeach
    </ul>
@auth
<a href="{{ route('contacts.create') }}">Add New Contact</a>
@endauth
</div>
@endsection