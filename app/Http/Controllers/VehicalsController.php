<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehical;
use App\Models\Inquiry;
use App\Models\FavouriteVehical;
use Illuminate\Support\Facades\Validator;
use Auth;

class VehicalsController extends Controller
{
     /**
     * Vehical List page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->per_page = $request->has('per_page') ? $request->get('per_page') : 10;
        $request->sort_by = $request->has('sort_by') ? $request->get('sort_by') : 'desc';
        $query = Vehical::query();
        $query->when($request->category_id,function($q) use($request){
            $q->where('category_id',$request->category_id);
        })
        ->when($request->brand_id,function($q) use($request){
            $q->where('brand_id',$request->brand_id);
        })
        ->when($request->model_id,function($q) use($request){
            $q->where('model_id',$request->model_id);
        })
        ->when($request->year,function($q) use($request){
            $q->where('year',$request->year);
        })
        ->when($request->color,function($q) use($request){
            $q->where('color',$request->color);
        })
        ->when($request->mileage,function($q) use($request){
            $q->where('mileage',$request->mileage);
        })
        ->when($request->price,function($q) use($request){
            $price = str_replace("₹","",$request->price);
            $q->whereBetween('price',explode("-",$price));
        });
        $vehicals = $query->orderBy('price',$request->sort_by)->paginate($request->per_page);
        $favourite_vehicals = Auth::check() ? Auth::user()->favourite_vehicals()->pluck('vehical_id')->toArray() : [];
        return view('vehicals.index',compact('request','vehicals','favourite_vehicals'));
    }

     /**
     * Vehical Details page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request, $slug)
    {
        $vehical = Vehical::where('slug',$slug)->latest()->first();
        return view('vehicals.show',compact('request','vehical'));
    }

    public function StoreInquiry(Request $request)
	{
    	$rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'phone'=> 'numeric',
        );
        $messages = array(
            'name.required' => 'Please enter your contact name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter valid email address.',
            'phone.numeric' => 'Please enter only digits in phone number.',
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
            //   try {

                $inquiry = new Inquiry;
                $inquiry->vehical_id = $request->get('vehical_id');
                $inquiry->user_id = $request->has('user_id') ? $request->get('user_id') : NULL;
                $inquiry->name = $request->get('name');
                $inquiry->email = $request->get('email');
                $inquiry->phone = $request->get('phone');
                $inquiry->description = $request->get('description');
                $inquiry->save();

                // Mail::send('emails.contact', ['data' => $request->all()], function($message) use($request) {
                //   $message->to(config()->get('settings.email'));
                //   $message->subject('Submission from ' . title_case($request->get('name')));
                // });
                // Mail::send('emails.thank_you', ['data' => $request->all()], function($message) use($request) {
                //   $message->to($request->get('email'));
                //   $message->subject('Thank you for contact us.');
                // });
                return response()->json(['success','Thank you for inquir us. We will get back to you soon.'], 200);
            //   } catch (Exception $e) {
            //       return redirect()->back()
            //                       ->withErrors($validator)
            //                       ->withInput()
            //                       ->with('error', $e->getMessage());
            //   }
    }

    public function FavouriteVehical($id){
        try
        {
            $fav_vehical = FavouriteVehical::where('user_id',Auth::user()->id)->where('vehical_id',$id)->first();
            if($fav_vehical){
                $fav_vehical->delete();
                return response()->json(['success','Vehical removed from favourite list.'], 200);
            } else {
                $fav_vehical = new FavouriteVehical;
                $fav_vehical->user_id=Auth::user()->id;
                $fav_vehical->vehical_id=$id;
                $fav_vehical->save();
                return response()->json(['success','Vehical added from favourite list.'], 200);
            }
        }
        catch(\Exception $e)
        {
            return response()->json(['error',$e->getMessage()],500);
        }
    }
}
