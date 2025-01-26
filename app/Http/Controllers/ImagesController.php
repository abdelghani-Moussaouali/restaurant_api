<?php

namespace App\Http\Controllers;

use App\Models\images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  'image_link' => 'required|mimes:jpeg,jfif,png,jpg,gif,svg|max:2048',
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
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, images $images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(images $images)
    {
        //
    }
}
