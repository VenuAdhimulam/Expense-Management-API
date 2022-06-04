<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseManagement;
use App\Http\Resources\ExpenseManagementCollection;
use App\Http\Resources\ExpenseManagementRes;

class ExpenseManagementController extends Controller
{
    //View index page
    public function index()
    {
        return view('index');
    }

    //Fetch all expenses
    public function fetch()
    {
        try
        {
            $data = ExpenseManagement::orderBy('id', 'DESC')->get();
            return response()->json($data);
           
        }
        catch(Exception $e)
        {
            Log::error($e);
        }
    }

    //save an expense
    public function store(Request $request)
    {
        try {
            //validation
            $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|numeric|gt:0',
                'description' => 'required|max:500',
            ]);

            $name = $request->get('name');
            $price = $request->get('price');
            $description = $request->get('description');

            ExpenseManagement::create([
                'name'   =>  $name,
                'price'  =>  $price,
                'description' => $description
            ]);

            return response()->json([
                'name'   =>  $name,
                'price'  =>  $price,
                'description' => $description
            ]);
        }
        catch(Exception $e)
        {
            Log::error($e);
        }
    }

    // fetch an expense by Id
    public function show($id)
    {
        try {
            return new ExpenseManagementRes(ExpenseManagement::findOrFail($id));
        } catch (Exception $e) {
            Log::error($e);        
        }
    }

    //Update an expense
    public function update(Request $request, $id)
    {
        try{
            //validation
            $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|numeric|gt:0',
                'description' => 'required|max:500',
            ]);

            $name = $request->get('name');
            $price = $request->get('price');
            $description = $request->get('description');

            ExpenseManagement::where('id', $id)->update([
                'name'   =>  $name,
                'price' =>  $price,
                'description' => $description
            ]);

            return response()->json([
                'name'   =>  $name,
                'price' =>  $price,
                'description' => $description
            ]);

        }catch(Exception $e){
            Log::error($e);
        }
    }

    // Delete an expense
    public function destroy($id)
    {
        try
        {
            $data = ExpenseManagement::find($id);
            $data->delete();
            return "Deleted Successfully!";
        }
        catch(Exception $e)
        {
            Log::error($e);
        }
    }
}
