<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehical;
use App\Models\Brand;
use App\Models\VehicalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VehicalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , Vehical $vehicals)
    {
        if($request->ajax())
        {
            $vehicals = $vehicals->orderBy('id','ASC');
            return DataTables::eloquent($vehicals)
                        ->editColumn('category', function ($vehical) {
                            return $vehical->category->name;
                        })
                        ->editColumn('brand', function ($vehical) {
                            return $vehical->brand->name."-".$vehical->vehical_model->name ;
                        })
                        ->editColumn('title', function ($vehical) {
                            $data = $vehical->title;
                            $data .= "<br>Fuel: ".$vehical->fuel;
                            $data .= "<br>Color: ".$vehical->color;
                            $data .= "<br>Mileage: ".$vehical->mileage;
                            return $data;
                        })
                        ->editColumn('price', function ($vehical) {
                            return $vehical->price;
                        })
                        ->editColumn('status', function ($vehical) {
                            $status = $vehical->status ? '<span class="badge badge-success">Sold</span>' : '<span class="badge badge-secondary">UnSold</span>';
                            $status .= ' <div class="btn-group"><button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Change Status</button>' .
                                    '<div class="dropdown-menu dropdown-menu-right">' .
                                        '<a href="javascript:void(0);" class="dropdown-item change_status" data-id="' . $vehical->id . '" data-status="1">Sold</a>' .
                                        '<a href="javascript:void(0);" class="dropdown-item change_status" data-id="' . $vehical->id . '" data-status="0">UnSold</a>' .
                                    '</div> ';
                            return $status;
                        })
                       ->addColumn('action', function (Vehical $vehical) {
                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a class="dropdown-item" href="'.route('admin.vehical.galleries.index',$vehical->id).'"><i class="dw dw-edit2"></i> Gallery</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.vehicals.edit',$vehical->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.vehicals.destroy',$vehical->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->rawColumns(["title", "status", "action"])
                        ->make(true);
        }
        else {
            return view()->make('admin.vehicals.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.vehicals.add',compact('request'));

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
            'category_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'title' => 'required',
            'year' => 'required',
            'fuel' => 'required',
            'color' => 'required',
            'mileage' => 'required',
            'price' => 'required'


            );
        $messages = [
            'category_id.required' => 'Please select brand.',
            'brand_id.required' => 'Please select brand.',
            'model_id.required' => 'Please select model.',
            'year.required' => 'Please select year.',
            'fuel.required' => 'Please select fuel type.',
            'title.required' => 'Please enter title.',
            'color.required' => 'Please enter color.',
            'mileage.required' => 'Please enter mileage.',
            'price.required' => 'Please enter price.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $vehical=New Vehical();
                $vehical->category_id=$request->get('category_id');
                $vehical->brand_id=$request->get('brand_id');
                $vehical->model_id=$request->get('model_id');
                $vehical->year=$request->get('year');
                $vehical->title=$request->get('title');
                $vehical->fuel=$request->get('fuel');
                $vehical->color=$request->get('color');
                $vehical->mileage=$request->get('mileage');
                $vehical->price=$request->get('price');
                $vehical->description=$request->get('description');
                $vehical->save();
                return response()->json(['success','Vehical created successfully.'], 200);
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
    public function show(Vehical $vehical)
    {
        return view()->make('admin.vehicals.show',compact('vehical'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehical = Vehical::find($id);
        return view()->make('admin.vehicals.edit',compact('vehical'));

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
            'category_id' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'title' => 'required',
            'year' => 'required',
            'fuel' => 'required',
            'color' => 'required',
            'mileage' => 'required',
            'price' => 'required'


            );
        $messages = [
            'category_id.required' => 'Please select brand.',
            'brand_id.required' => 'Please select brand.',
            'model_id.required' => 'Please select model.',
            'year.required' => 'Please select year.',
            'fuel.required' => 'Please select fuel type.',
            'title.required' => 'Please enter title.',
            'color.required' => 'Please enter color.',
            'mileage.required' => 'Please enter mileage.',
            'price.required' => 'Please enter price.'
            ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails())
                {
                    return response()->json($validator->getMessageBag()->toArray(), 422);
                }
                try{
                    $vehical = Vehical::find($id);
                    $vehical->category_id=$request->get('category_id');
                    $vehical->brand_id=$request->get('brand_id');
                    $vehical->model_id=$request->get('model_id');
                    $vehical->year=$request->get('year');
                    $vehical->title=$request->get('title');
                    $vehical->fuel=$request->get('fuel');
                    $vehical->color=$request->get('color');
                    $vehical->mileage=$request->get('mileage');
                    $vehical->price=$request->get('price');
                    $vehical->description=$request->get('description');
                    $vehical->save();
                    return response()->json(['success','Vehical updated successfully.'], 200);
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
            $vehical = Vehical::find($id);
            $vehical->delete();
            return response()->json(['success','Vehical deleted successfully'], 200);
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
            $vehical = Vehical::find($request->id);
            $vehical->status = $request->get('status');
            $vehical->save();
            return response()->json(['success','Vehical Status updated successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Fetch the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $option = '<option value="">Select</option>';
        if ($request->has('id') && $request->has('type')) {
            $data = [];
            if ($request->type == "brand") {
                $data = Brand::where('category_id', $request->id)->pluck('name', 'id')->toArray();
            } elseif ($request->type == "model") {
                $data = VehicalModel::where('brand_id', $request->id)->pluck('name', 'id')->toArray();
            }

            foreach ($data as $key => $value) {
                $option .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        return $option;
    }


}
