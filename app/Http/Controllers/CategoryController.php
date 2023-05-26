<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Categories;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
>>>>>>> 387bd9be6ad77b09ea9387ec27230b6f6beccf00

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $category = Categories::all();
        return response()->json([
            'status' => true,
            'message' => 'input succes',
            'categories' => $category
        ], 400);
=======
        $cateogry = Category::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all Category',
            'category' => $cateogry
        ]);
>>>>>>> 387bd9be6ad77b09ea9387ec27230b6f6beccf00
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
        $category = Category::create([
            'category_name' => $request->category_name,
            'admin_id' => auth('admin')->user()->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category has added',
            'category' => $category
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD
        $category = Categories::where('id', 'like', $id)->get()->first();
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'categories' => $category
        ], 400);
=======
        //
>>>>>>> 387bd9be6ad77b09ea9387ec27230b6f6beccf00
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
        $cateogry = Category::find($id);
        //$cateogry = Category::update(); //Salah
        // $cateogry->update([
        //     'category_name' => $request->category,
        //     'admin_id' => $request->admin_id,
        // ]);

        if($request->category){
            $cateogry->category_name = $request->category;
        }
        if($request->category){
            $cateogry->admin_id = $request->category;
        }
        $cateogry->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        Categories::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'input success',
        ], 400);
=======
        
>>>>>>> 387bd9be6ad77b09ea9387ec27230b6f6beccf00
    }
}
