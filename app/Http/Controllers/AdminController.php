<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Student;
use App\Message;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $all_messages = Message::where('user_id',Auth::user()->id)->get();
        $all_students = Student::where('added_by', Auth::user()->id)->get();
        return view('index', ['all_messages' => $all_messages, 'all_students' => $all_students]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $all_students = Student::all();
        
        return view('add', compact('all_students', $all_students));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'bail|required|numeric|digits:10'
        ]);

        //Store the Phone number of the student in the database

        $store_student = new Student;
        $phone_number = $request->phone_number;
        $store_student->phone_number = '+234'.$phone_number;
        $store_student->added_by = Auth::user()->id;
        $store_student->save();
        return redirect()->back()->with('success', 'Student phone number 0'.$phone_number. ' has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param
     * @param \Illuminate\Http\Request  $request
     * Save message to the database and send it to students.
     */
    
    public function send(Request $request)
    {
        
        $request->validate([
            'message' => 'required|min:10|max:191'
        ]);
        
        $new_message  = new Message;
        $new_message->message = $request->get('message');
        $new_message->user_id  = Auth::user()->id;
        
        $new_message->save();
        // if ($new_message->save();) {
        # do the next tablecode...
        // if that next table is successful then redirect else whatever      }

        $message = Message::where('message',$request->get('message'))->select('message')->get()->toArray();
        //return $message;
        $phone_numbers = Student::all()->toArray();
        // dd($phone_numbers);
        // dd($message);

//Messaging REST API
    try {
    // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'AC45a2dad812bb662dc11a77335d38c14a';
        $auth_token = '535569c8159f51d75d36ab91c92ffaf9';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+12057934134";
        
        
        $client = new Client($account_sid, $auth_token);
        if($client->messages->create(
            // Where to send a text message (your cell phone?)
            
        $phone_numbers[0]["phone_number"],
            array(
                'from' => $twilio_number,
                'body' => $message[0]["message"].'. Sent by '. Auth::user()->name
            )
        )){
            // Set message status to 1 if it is sent then redirect back to admin page
            
            $successful_message = new Message;
            $successful_message->message_status = 1;
            $successful_message->save();
            return back()->with('success','Message successfully sent');
        }
            
            
        
        
    }catch (\Exception $e) {
        
        // will return user to previous screen with twilio error
        return back()->withError($e->getMessage())->withInput();
    }

        }
}
