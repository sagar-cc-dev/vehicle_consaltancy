<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehical;
use App\Models\Feedback;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function updateProfile(Request $request){
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|numeric|min:10'
            );
        $messages = [
            'first_name.required' => 'Please enter first name.',
            'last_name.required' => 'Please enter last name.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Please enter valid email address.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return redirect()->back()->with($validator->getMessageBag()->toArray(), 422);
        }
        try
        {
            $user = User::find(Auth::user()->id);
            $user->first_name=$request->get('first_name');
            $user->last_name=$request->get('last_name');
            $user->phone=$request->get('phone');
            $user->email=$request->get('email');
            if($request->has('password') && $request->get('password') != ""){
                $request->password = Hash::make($request->password);
            }
            $user->save();
            return redirect()->back()->with('success','Profile updated successfully.');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function FavouriteList(){
        $vehicals = Vehical::whereIn('id',Auth::user()->favourite_vehicals()->pluck('vehical_id')->toArray())->get();
        return view('favourite_list',compact('vehicals'));
    }

    public function StoreFeedback(Request $request)
	{
    	$rules = array(
            'rating' => 'required',
        );
        $messages = array(
            'rating.required' => 'Please select rate.',
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
            //   try {

                $feedback = new Feedback;
                $feedback->user_id = $request->has('user_id') ? $request->get('user_id') : NULL;
                $feedback->rating = $request->get('rating');
                $feedback->description = $request->get('description');
                $feedback->save();

                // Mail::send('emails.contact', ['data' => $request->all()], function($message) use($request) {
                //   $message->to(config()->get('settings.email'));
                //   $message->subject('Submission from ' . title_case($request->get('name')));
                // });
                // Mail::send('emails.thank_you', ['data' => $request->all()], function($message) use($request) {
                //   $message->to($request->get('email'));
                //   $message->subject('Thank you for contact us.');
                // });
                return response()->json(['success','Thank you valuable feedback.'], 200);
            //   } catch (Exception $e) {
            //       return redirect()->back()
            //                       ->withErrors($validator)
            //                       ->withInput()
            //                       ->with('error', $e->getMessage());
            //   }
    }
}
