<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::all();
        return response()->json([
            'status' => true,
            'message' => 'input succes',
            'categories' => $category
        ], 400);
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
        $category = Categories::create([
            'category_name' => $request->category,
            'admin_id' => $request->admin_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'categories' => $category
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::where('id', 'like', $id)->get()->first();
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'categories' => $category
        ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $category = Categories::find($id);
        $category->update([
            'category_name' => $request->category,
            'admin_id' => $request->admin_id,
        ]);

        if ($request->category) {
            $category->category_name = $request->category;
        }
        if ($request->category) {
            $category->admin_id = $request->admin_id;
        }
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'input success',
        ], 400);
    }
}
