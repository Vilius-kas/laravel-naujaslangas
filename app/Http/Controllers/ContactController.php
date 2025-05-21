<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller
{
public function index()
{
$contacts = Contact::all();
return view('contacts.index', compact('contacts'));
}
public function create()
{
return view('contacts.create');
}
public function store(Request $request)
{
$request->validate([
'name' => 'required|string',
'phone' => 'required|string',
'email' => 'required|string',
]);
Contact::create($request->only('name', 'phone', 'email'));
return redirect()->route('contacts.index')->with('success', 'Contact
added successfully!');
}
public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }

    public function restore($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->restore();

        return redirect()->route('contacts.index')->with('success', 'Contact restored!');
    }

   public function trashed()
    {
    $deletedContacts = Contact::onlyTrashed()->get();
    return view('contacts.trashed', compact('deletedContacts'));
    }


    public function forceDelete($id)
    {
    $contact = Contact::withTrashed()->findOrFail($id);
    $contact->forceDelete();

    return redirect()->route('contacts.trashed')->with('success', 'Contact permanently deleted!');
    }


}