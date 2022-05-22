<?php

namespace App\Helpers;

use App\Models\Feedback;

class FeedbackFileHelper
{
    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @return string fileName
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

    /**
     * @param Feedback $feedback
     * @return string pathTofile
     */
    public function getFilePathToAttach(Feedback $feedback)
    {
        return 'public/files/' . $feedback->file;
    }

    /**
     * @param Feedback $feedback
     * @return string urlToFile
     */
    public function getFileUrl(Feedback $feedback)
    {
        return config('app.url') . 'storage/files/' . $feedback->file;
    }
}
