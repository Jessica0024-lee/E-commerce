<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveStream; // Corrected namespace declaration

class LiveStreamController extends Controller
{
    public function save(Request $request)
    {
        // Retrieve form data
        $live_name = $request->input('name');
        $desc = $request->input('desc');
        $embed_link = $request->input('embed_link');

        // Validate form data (you can use Laravel's validation features)

        // Save data to the database
        $liveStream = new LiveStream();
        $liveStream->name = $live_name;
        $liveStream->embed_link = $embed_link;
        $liveStream->description = $desc;
        $liveStream->save();

        return "Live streaming data saved successfully.";
    }
}
