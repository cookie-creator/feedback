<?php

namespace App\Http\Controllers\Client;

use App\Helpers\FeedbackFileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Repositories\FeedbackRepository;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FeedbackService $service)
    {
        $feedback = $service->isClientCanSendFeedback(auth()->user()->id);

        return view('layouts.client.dashboard', compact(['feedback']));
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
    public function store(StoreFeedbackRequest $request,
                          FeedbackRepository $repo,
                          FeedbackService $service,
                          FeedbackFileHelper $fileHelper)
    {
        $data = $request->validated();

        $data['fileName'] = $fileHelper->storeFile($request);

        $feedback = $repo->store(auth()->user()->id, $data);

        $service->sendEmailFeedback($feedback);

        return redirect()->back()->with('message', 'Your feedback was sent');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
