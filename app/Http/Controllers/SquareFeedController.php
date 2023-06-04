<?php

namespace App\Http\Controllers;

use App\Models\SquareFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class SquareFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $squarefeed = squarefeed::with('admin')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show all squarefeed',
            'squarefeed' => $squarefeed
        ]);
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
        $rules = array(
            'image' => ['required', File::types(['jpg', 'jpeg', 'png', 'gif'])->max(12 * 1024)]
        );

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $squarefeed = SquareFeed::create([
                'img_path' => Storage::putFile('squarefeed', $request->file('image')),
                'admin_id' => auth('admin')->user()->id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'input success',
                'squarefeed' => $squarefeed
            ]);
        }
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
        $rules = array(
            'image' => ['required', File::types(['jpg', 'jpeg', 'png', 'gif'])->max(12 * 1024)]
        );

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->messages()->first()
            ]);
        } else {
            $squarefeed = SquareFeed::find($id);
            if ($squarefeed->img_path && Storage::exists($squarefeed->img_path)) {
                Storage::delete($squarefeed->img_path);
            }
            $squarefeed->img_path = Storage::putFile('squarefeed', $request->file('image'));
            $squarefeed->save();
            return response()->json([
                'status' => true,
                'message' => 'squarefeed has updated'
            ]);
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
        $squarefeed = SquareFeed::find($id);
        // $delete = Storage::delete($squarefeed->img_path);
        $squarefeed->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ]);
    }
}
