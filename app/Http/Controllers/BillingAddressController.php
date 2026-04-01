<?php

namespace App\Http\Controllers;

use App\Models\BillingAddress;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class BillingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $billingAddress = $user->billingAddress;
        return view('frontend.billing_address', compact('billingAddress'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
           
            'country' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
        ]);

        $user = Auth::user();
        $billingAddress = new BillingAddress($request->all());
        $billingAddress->user_id = $user->id;
        $billingAddress->save();

        return redirect()->route('billing-address.create')->with('success', 'Billing address saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BillingAddress $billingAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillingAddress $billingAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillingAddress $billingAddress)
    {
        //
        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
            'zip' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
        ]);

        $billingAddress->update($request->all());

        return redirect()->route('billing-address.create')->with('success', 'Billing address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillingAddress $billingAddress)
    {
        //
    }
}
