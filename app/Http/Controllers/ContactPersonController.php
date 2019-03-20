<?php

namespace App\Http\Controllers;

use App\ContactPerson;
use App\Http\Requests\ContactPersonRequest;
use Illuminate\Http\Request;

class ContactPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactPersonRequest $request)
    {
        $data = [
            'creator_id' => $request->user()->id,
            'title' => $request->title,
            'company_id' => $request->company_id,
            'name' => $request->name,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'address_1' => $request->address_1,
            'primary_contact' => $request->primary_contact,
            'city' => $request->city,
            'country' => $request->country,
        ];

        $contact = ContactPerson::create($data);

        toast("Contact Person $request->name added", 'success', 'top-right');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function show(ContactPerson $contactPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactPerson $contactPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function update(ContactPersonRequest $request, ContactPerson $contactPerson)
    {
        $data = [
            'creator_id' => $request->user()->id,
            'title' => $request->title,
            'company_id' => $request->company_id,
            'name' => $request->name,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'address_1' => $request->address_1,
            'primary_contact' => $request->primary_contact,
            'city' => $request->city,
            'country' => $request->country,
        ];

        $contactPerson->update($data);
        toast("Contact Person $request->name updated", 'success', 'top-right');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactPerson  $contactPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactPerson $contactPerson)
    {
        //
    }
}
