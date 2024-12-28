<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , VehicalModel $vehical_models)
    {
        if($request->ajax())
        {
            $vehical_models = $vehical_models->orderBy('id','ASC');
            return DataTables::eloquent($vehical_models)
                        ->editColumn('brand', function ($vehical_model) {
                            return $vehical_model->brand->name;
                        })
                        ->editColumn('name', function ($vehical_model) {
                            return $vehical_model->name;
                        })
                        ->editColumn('status', function ($vehical_model) {
                            return $vehical_model->status ? "Active" : "InActive";
                        })

                       ->addColumn('action', function (VehicalModel $vehical_model) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.models.edit',$vehical_model->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.models.destroy',$vehical_model->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.vehical_models.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.vehical_models.add',compact('request'));

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
            'brand_id' => 'required',
            'name' => 'required',
            'status' => 'required'

            );
        $messages = [
            'brand_id.required' => 'Please enter brand id.',
            'name.required' => 'Please enter vehical_model name.',
            'status.required' => 'Please enter status.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $vehical_model=New VehicalModel();
                $vehical_model->brand_id=$request->get('brand_id');
                $vehical_model->name=$request->get('name');
                $vehical_model->status=$request->get('status');
                $vehical_model->save();
                return response()->json(['success','Vehical_model created successfully.'], 200);
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
    public function show(VehicalModel $vehical_model)
    {
        return view()->make('admin.vehical_models.show',compact('vehical_model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehical_model = VehicalModel::find($id);
        return view()->make('admin.vehical_models.edit',compact('vehical_model'));

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
            'brand_id' => 'required',
            'name' => 'required',
            'status' => 'required'
            );
            $messages = [
                'brand_id.required' => 'Please enter brand id.',
                'name.required' => 'Please enter vehical_model name.',
                'status.required' => 'Please enter status.'
            ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if ($validator->fails())
                {
                    return response()->json($validator->getMessageBag()->toArray(), 422);
                }
                try{
                    $vehical_model = VehicalModel::find($id);
                    $vehical_model->brand_id=$request->get('brand_id');
                    $vehical_model->name=$request->get('name');
                    $vehical_model->status=$request->get('status');
                  $vehical_model->save();
                    return response()->json(['success','Vehical_model created successfully.'], 200);
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
            $vehical_model = VehicalModel::find($id);
            $vehical_model->delete();
            return response()->json(['success','Model deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
