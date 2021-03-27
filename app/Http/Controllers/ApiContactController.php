<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use Response;
use Validator;

class ApiContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::all(); //use contact model and get all the records you must signify the model because thats the how you retreive data from the database, thats what the model does. 
        return response()->json($contact);
        //you have a route targeting this index method. This is how your gonna retrieve the data from the database now you have a record there. We made a record in the database using postman api.

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
    public function store(Request $request) //request this data from the database
    {

$rules = [
'name' => 'required',
'address'=>'required',
'phone'=>'required|min:10|numeric'

];
//if i try filling out the data without inputing a name it will say name,address, and phone is required.
$validator = Validator::make($request->all(),$rules);
// you defined validator on the top of this file. Your declaring the variable here.

if($validator->fails()) {
    return response()->json($validator->errors(),400);
}

        $contact = new Contact(); //contact model
        $contact->name = request('name');
        $contact->address = request('address');
        $contact->phone = request('phone');
        $contact->save();//saves to database
        return response()->json($contact); //returns it in json format



// name,adress, and phone is in your database. And your storing it in the store method for your api.
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if(!$contact){
            return response()->json([
        'message'=>'data not found'
        ],404);
    }
    return response()->json($contact);

        //pulls 1 data from the database by the id
        //if we cant retrieve that single piece of data(id) it will say 404 data not found
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id); //were going find the id using the model 
        if(!$contact){ //if there is no contact
            return response()->json([ //return json response
        'message'=>'data not found' //not found
        ],404);
    }
        $contact->name = request('name'); //once we find the id were going to update the name,address, and phone that belongs to that id
        $contact->address = request('address');
        $contact->phone = request('phone');
        $contact->save(); //save it to database
        return response()->json($contact); //returns it in json format

// this is to update the information in the database

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id); 
        if(!$contact){ //if there is no contact
            return response()->json([ //return json response
        'message'=>'data not found' //not found
        ],404);
    }
        $contact->delete();
        return response()->json($contact);
    }
}
