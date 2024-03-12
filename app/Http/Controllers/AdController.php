<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdRequest;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Fetch all ads
        $ads = Ad::with('images')->get();
        // dd($ads);
        if ($ads->count() > 0) {
            $data = [
                'status' => 200,
                'ads' => $ads
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No ads found'
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdRequest $request)
    {
        // Validate request data
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'description' => 'required',
        //     'price' => 'required|numeric',
        //     'negotiable' => 'boolean',
        //     'location' => 'required',
        //     'category_id' => 'required |exists:categories,id',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 422,
        //         'errors' => $validator->messages(),
        //     ], 422);
        // } else {
            // $ad = Ad::create($request->all());
            $ad = Ad::create($request -> validated());

            if ($ad) {
                return response()->json([
                    'status' => 200,
                    'message' => 'ad created successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong',
                ], 500);
            }
        }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Return a single ad
        
        $ad = Ad::find($id);
        if ($ad) {
            return response()->json([
                'status' => 200,
                'message' => $ad,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ad not found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ad = Ad::find($id);
        if ($ad) {
            return response()->json([
                'status' => 200,
                'message' => $ad,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ad not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdRequest $request, int $id)
    {
        $ad = Ad::find($id);
        if ($ad) {
                $ad->update($request -> validated());
                return response()->json([
                    'status' => 200,
                    'message' => 'ad updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such an ad found',
                ], 404);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        // Delete the ad
        $ad = Ad::find($id);
        if ($ad) {
            $ad->delete();
            return response()->json([
                'status' => 200,
                'message' => 'ad deleted successfully',
            ], 200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'No such an ad found',
            ]);
        }
    }
}
