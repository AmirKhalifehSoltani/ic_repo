<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatRequest;
use App\Models\Cat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CatsController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param CatRequest $catRequest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            [
                'name' => $request->name
            ],
            [
                'name' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $alert[] = $messages->first('name');
            return response()->json($alert);
        }

        $name = $request->name;
        $cat_data = ['name' => $name];
        $new_cat = Cat::create($cat_data);
        if ($new_cat && $new_cat instanceof Cat) {
            return response()->json(['status_code' => 200, 'message' => 'Category added successfully']);
        }
        return response()->json(['status_code' => 200, 'message' => 'Category did not add successfully']);;
        //        $validated = $catRequest->validated();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;

        $validator = Validator::make(
            [
                'name' => $name
            ],
            [
                'name' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $alert[] = $messages->first('name');
            return response()->json($alert);
        }

        $cat_data = ['name' => $name];
        $catItem = Cat::find($id);
        if ($catItem && $catItem instanceof Cat) {
            $catItem->update($cat_data);
            return response()->json(['status_code' => 200, 'message' => 'Category updated successfully']);
        }
        return response()->json(['status_code' => 200, 'message' => 'Category did not update successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
