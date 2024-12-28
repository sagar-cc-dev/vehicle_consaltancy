<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Brand $brands)
    {
        if($request->ajax())
        {
            $brands = $brands->orderBy('id','ASC');
            return DataTables::eloquent($brands)
                        ->editColumn('category', function ($brand) {
                            return $brand->category->name;
                        })
                        ->editColumn('name', function ($brand) {
                            return $brand->name;
                        })
                        ->editColumn('status', function ($brand) {
                            return $brand->status ? "Active" : "InActive";
                        })
                        ->addColumn('action', function (brand $brand) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.brands.edit',$brand->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.brands.destroy',$brand->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.brands.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.brands.add',compact('request'));
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
        'name' => 'required',
        'category_id' => 'required',
        'status' => 'required'
        );
    $messages = [
        'name.required' => 'Please enter brand name.',
        'category_id.required' => 'Please enter category id.',
        'status' => 'Please enter status.',
        ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        return response()->json($validator->getMessageBag()->toArray(), 422);
    }

    try
    {
        $brand = new Brand;
        $brand->category_id=$request->get('category_id');
        $brand->name=$request->get('name');
        $brand->status=$request->get('status');
        $brand->save();
        return response()->json(['success','Brand updated successfully.'], 200);
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
    public function show(Brand $brand)
    {
        return view()->make('admin.brands.show',compact('brand'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view()->make('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        {
            $rules = array(
                'name' => 'required',
                'category_id' => 'required',
                'status' => 'required'
                );
            $messages = [
                'name.required' => 'Please enter brand name.',
                'category_id.required' => 'Please enter category id.',
                'status' => 'Please enter status.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try
            {
                $brand->name=$request->get('name');
                $brand->category_id=$request->get('category_id');
                $brand->status=$request->get('status');
                $brand->save();
                return response()->json(['success','Brand updated successfully.'], 200);
            }
            catch(\Exception $e)
            {
                return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try
        {
            $brand->delete();
            return response()->json(['success','Brand deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}

