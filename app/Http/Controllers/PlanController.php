<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('backend.plans.index',[
            'plan'=>Plan::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
           
            $request->validate([
                'name'=>'required|max:100',
               
                'duration'=>'required',
                'price'=>'required',
            ]);

            Plan::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'duration'=>$request->duration,
                'price'=>$request->price,
            ]);

            return redirect()->route('plans.index')->with('success','Plan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
        return view('backend.plans.edit',[
            'plan'=>$plan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'duration'=>'required',
            'price'=>'required',
        ]);

        $plan->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'duration'=>$request->duration,
            'price'=>$request->price,
        ]);

        return redirect()->route('plans.index')->with('success','Plan updated successfully');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
        $plan->delete();
        return redirect()->route('plans.index')->with('success','Plan deleted successfully');
    }

    //make active
    public function makeActive($id){
        $plan=Plan::findOrFail($id);
        $plan->update([
            'status'=>1,
        ]);
        return redirect()->route('plans.index')->with('success','Plan activated successfully');
    }

    //make inactive
    public function makeInactive($id){
        $plan=Plan::findOrFail($id);
        $plan->update([
            'status'=>0,
        ]);
        return redirect()->route('plans.index')->with('success','Plan deactivated successfully');
    }
}
