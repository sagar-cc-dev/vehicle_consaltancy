<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, detail $details )
    {
        if($request->ajax())
        {
            $details = $details->where('role','customer')->orderBy('id','ASC');
            return DataTables::eloquent($details)
                        ->editColumn('mfg_year', function ($detail) {
                            return $detail->mfg_year;
                        })
                        ->editColumn('fuel_type', function ($detail) {
                            return $detail->fuel_type;
                        })
                        ->editColumn('color', function ($detail) {
                            return $detail->color;
                        })
                        ->editColumn('price', function ($detail) {
                            return $detail->price;
                        })
                        ->editColumn('description', function ($detail) {
                            return $detail->description;
                        })
                        ->editColumn('status', function ($detail) {
                            return $detail->status;
                        })
                        ->addColumn('action', function (detail $detail) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.details.edit',$detail->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.details.destroy',$detail->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.details.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.details.add',compact('request'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'mfg_year' => 'required',
            'fuel_type' => 'required',
            'color' => 'required',
            'price' => 'required',
            'description' => 'required'
            );
        $messages = [
            'mfg_year.required' => 'Please enter mfg year.',
            'fuel_type.required' => 'Please enter fuel type.',
            'color.required' => 'Please enter color.',
            'price.required' => 'Please enter price.',
            'description.required' => 'Please enter description.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try{
            $detail=New detail();
            $detail->mfg_year=$request->get('mfg_year');
            $detail->fuel_type=$request->get('fuel_type');
            $detail->color=$request->get('color');
            $detail->price=$request->get('price');
            $detail->description=$request->get('description');
            $detail->save();
            return response()->json(['success','Vehical_detail created successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(detail $detail)
    {
        return view()->make('admin.details.show',compact('detail'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(detail $detail)
    {
        return view()->make('admin.details.edit',compact('detail'));

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
            'mfg_year' => 'required',
            'fuel_type' => 'required',
            'color' => 'required',
            'price' => 'required',
            'description' => 'required'
            );
        $messages = [
            'mfg_year.required' => 'Please enter mfg year.',
            'fuel_type.required' => 'Please enter fuel type.',
            'color.required' => 'Please enter color.',
            'price.required' => 'Please enter price.',
            'description.required' => 'Please enter description.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try
        {
            $detail = detail::find($id);
            $detail->mfg_year=$request->get('mfg_year');
            $detail->fuel_type=$request->get('fuel_type');
            $detail->color=$request->get('color');
            $detail->price=$request->get('price');
            $detail->description=$request->get('description');
            $detail->save();
            return response()->json(['success','vehical_detail updated successfully.'], 200);
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
            $detail = detail::find($id);
            $detail->delete();
            return response()->json(['success','Detail deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
