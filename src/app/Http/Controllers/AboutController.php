<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveStream;

class AboutController extends Controller
{
    public function index()
    {
        // Fetch live streams from your database or any other source
        $liveStreams = LiveStream::all(); // Example query to fetch live streams

        // Pass the $liveStreams variable to the view
        return view('aboutUs', compact('liveStreams'));
    }
}
