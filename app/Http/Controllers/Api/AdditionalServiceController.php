<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = AdditionalService::with('prices')->get();

        return response()->json($services, 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdditionalService  $additionalService
     * @return \Illuminate\Http\Response
     */
    public function show(AdditionalService $additionalService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdditionalService  $additionalService
     * @return \Illuminate\Http\Response
     */
    public function edit(AdditionalService $additionalService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdditionalService  $additionalService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdditionalService $additionalService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdditionalService  $additionalService
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalService $additionalService)
    {
        //
    }
}
