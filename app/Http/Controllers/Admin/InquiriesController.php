<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Inquiry $inquiry)
    {
        if($request->ajax())
        {
            $inquiry = $inquiry->orderBy('id','ASC');
            return Datatables::eloquent($inquiry)
                        ->addColumn('type', function ($inquiry){
                            return $inquiry->vehical_id ? "Vehical" : "Normal";
                        })
                        ->editColumn('vehical', function ($inquiry){
                            return $inquiry->vehical ? $inquiry->vehical->title : '-';
                        })
                        ->editColumn('name', function ($inquiry) {
                            return $inquiry->name;
                        })
                        ->editColumn('email', function ($inquiry) {
                            return $inquiry->email;
                        })
                        ->editColumn('phone', function ($inquiry) {
                            return $inquiry->phone;
                        })
                        ->editColumn('status', function ($inquiry){
                            $status = $inquiry->status ? '<span class="badge badge-success">Answered</span>' : '<span class="badge badge-secondary">Pending</span>';
                            $status .= ' <div class="btn-group"><button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Change Status</button>' .
                                    '<div class="dropdown-menu dropdown-menu-right">' .
                                        '<a href="javascript:void(0);" class="dropdown-item change_status" data-id="' . $inquiry->id . '" data-status="1">Answered</a>' .
                                        '<a href="javascript:void(0);" class="dropdown-item change_status" data-id="' . $inquiry->id . '" data-status="0">Pending</a>' .
                                    '</div> ';
                            return $status;
                        })
                        ->editColumn('created', function ($inquiry){
                            return Carbon::parse($inquiry->created_at)->format('Y-m-d H:i:s');
                        })
                        ->addColumn('action', function (Inquiry $inquiry) {
                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.inquiries.destroy',$inquiry->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;
                        })
                        ->rawColumns(["title", "status", "action"])
                        ->make(true);
        }
        else {
            return view()->make('admin.inquiries.index');
        }
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
    public function store(Request $request)
    {
        //
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
    public function edit(Inquiry $inquiry)
    {
        return view()->make('admin.inquiries.edit',compact('inquiry'));
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
        $rules = array(
            'status' => 'required',

            );
        $messages = [
            'status.required' => 'please give status.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try{
            $inquiry=Inquiry::find($id);
            $inquiry->status=$request->get('status');
            $inquiry->save();
            return response()->json(['success','inquiry update successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $inquiry = Inquiry::find($id);
            $inquiry->delete();
            return response()->json(['success','inquiry deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        try
        {
            $inquiry = Inquiry::find($request->id);
            $inquiry->status = $request->get('status');
            $inquiry->save();
            return response()->json(['success','Inquiry Status updated successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
