<?php

namespace App\Http\Controllers;

use App\Models\AdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdImageController extends Controller
{
    public function index($ad_id)
    {

        $images = AdImage::where('ad_id', $ad_id)->get();
        return response()->json(['status' => 200, 'images' => $images]);
    }

    public function store(Request $request, $ad_id)
    {
        // $images = $request->file('image');
        // $imageName='';
        // foreach($images as $image){
        //     $new_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $new_name);
        //     $imageName = $new_name;
        //     $image = new AdImage();
        //     $image->ad_id = $ad_id;
        //     $image->image_path = $imageName;
        //     $image->save();
        // }
        // if($imageName){
        //     return response()->json(['status' => 201, 'message' => 'Image uploaded successfully']);
        // }else {
        //     return response()->json(['status' => 404, 'message' => 'Image not found']);
        // }
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|max:2048', // Validate image files
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()]);
        }

        foreach ($request->file('images') as $image) {
            // Generate a unique file name for each image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Save the image in the public/images directory
            $image->storeAs('public/images', $imageName);

            // Create a new AdImage instance and save the image path to the database
            $adImage = new AdImage();
            $adImage->ad_id = $ad_id;
            $adImage->image_path = 'images/' . $imageName;
            $adImage->save();
        }
        // Check if any images were uploaded successfully
        if ($request->hasFile('images') && $adImage) {
            return response()->json(['status' => 201, 'message' => 'Images uploaded successfully']);
        } else {
            return response()->json(['status' => 404, 'message' => 'No images uploaded']);
        }
    }

    public function show($ad_id, $image_id)
    {
        $image = AdImage::where('ad_id', $ad_id)->find($image_id);
        if ($image) {
            return response()->json(['status' => 200, 'image' => $image]);
        } else {
            return response()->json(['status' => 404, 'message' => 'Image not found']);
        }
    }

    public function update(Request $request, $ad_id, $image_id)
    {
        
        // $image = AdImage::where('ad_id', $ad_id)->find($image_id);
        // if ($image) {
        //     $image->update($request->all());
        //     return response()->json(['status' => 200, 'message' => 'Image updated successfully']);
        // } else {
        //     return response()->json(['status' => 404, 'message' => 'Image not found']);
        // }
    }

    public function destroy($ad_id, $image_id)
    {
        $image = AdImage::where('ad_id', $ad_id)->find($image_id);
        if ($image) {
            $image->delete();
            return response()->json(['status' => 200, 'message' => 'Image deleted successfully']);
        } else {
            return response()->json(['status' => 404, 'message' => 'Image not found']);
        }
    }
}
