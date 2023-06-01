<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = Review::all();
        return response()->json([
            'status' => true,
            'message' => 'Show all review',
            'review' => $review
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
        $review = Review::create([
            'user_id' => $request->user_id,
            'partner_id' => $request->partner_id,
            'rating' => $request->rating,
            'description' => $request->description
        ]);
        return response()->json([
            'status' => true,
            'message' => 'input success',
            'review' => $review
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
        $review = Review::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Show review success',
            'review' => $review
        ]);
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
        $review = Review::find($id);
        $review->update([
            'user_id' => $request->user_id,
            'partner_id' => $request->partner_id,
            'rating' => $request->rating,
            'description' => $request->description
        ]);
        return response()->json([
            'status' => true,
            'message' => 'review has updated',
            'review' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ]);
    }
}
