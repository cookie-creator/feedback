<?php

namespace App\Helpers;

class FeedbackFileHelper
{
    public function __construct()
    {

    }

    /**
     * @param Request $request
     */
    public function storeFile($request)
    {
        $fileNameToStore = '';

        if ($request->hasFile('file')) {
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = $request->file('file')->getClientOriginalExtension();
            // file name  to store
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            // Upload image
            $path = $request->file('file')->storeAs('public/files', $fileNameToStore);
        }

        return $fileNameToStore;
    }
}
