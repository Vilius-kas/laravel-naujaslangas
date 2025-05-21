@extends('layouts.contact')

@section('content')
<div class="container">
    <h1>Ištrinti kontaktai</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($deletedContacts->isEmpty())
        <p>Nėra ištrintų kontaktų.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Vardas</th>
                    <th>El. paštas</th>
                    <th>Telefonas</th>
                    <th>Ištrintas</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedContacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->deleted_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">Atkurti</button>
                            </form>

                            <form action="{{ route('contacts.forceDelete', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Ar tikrai pašalinti visam laikui?')">Ištrinti visam laikui</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ route('contacts.index') }}">← Grįžti į kontaktus</a>
</div>
@endsection
