<?php

namespace App\Repositories;

use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class FeedbackRepository
{
    public function __construct()
    {

    }

    public function getFeedbacks()
    {
        return Feedback::orderBy('created_at', 'desc')
            ->paginate($perPage = 50, $columns = ['*'], $pageName = 'feedbacks');
    }

    /**
     * @param  int  $idUser
     * @return Collecting
     */
    public function getUserFeedbacks($idUser)
    {
        return Feedback::where('user_id',$idUser)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param  int  $idUser
     * @param  int  $idFeedback
     * @return App\Models\Feedback
     */
    public function getUserFeedback($idUser, $idFeedback)
    {
        return Feedback::where('id',$idFeedback)
            ->where('user_id',$idUser)
            ->firstOrFail();
    }

    /**
     * @param  int  $idUser
     * @return App\Models\Feedback
     */
    public function getLastUserFeedback($idUser)
    {
        return Feedback::where('user_id',$idUser)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * @param  int  $idUser
     * @param  array  $data
     */
    public function store($idUser, $data)
    {
        try {

            DB::beginTransaction();

            $feedback = new Feedback();
            $feedback->name = $data['name'];
            $feedback->email = $data['email'];
            $feedback->subject = $data['subject'];
            $feedback->feedback = $data['feedback'];
            $feedback->file = $data['fileName'];

            $feedback->user_id = $idUser;
            $feedback->save();

            DB::commit();

            return $feedback;

        } catch (\Exception $e) {

            \Log::debug('rollback');

            DB::rollBack();
        }
        return false;
    }

    /**
     * @param  int  $idFeedback
     */
    public function switchToAnswered($idFeedback)
    {
        return Feedback::where('id',$idFeedback)
            ->update(['answered' => 1]);
    }
}
