<?php

namespace App\Services;

use App\Jobs\SendEmailFeedback;
use App\Models\Feedback;
use App\Repositories\FeedbackRepository;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class FeedbackService
{
    private FeedbackRepository $feedbackRepo;

    public function __construct(FeedbackRepository $feedbackRepo)
    {
        $this->feedbackRepo = $feedbackRepo;
    }

    /**
     * @param  Feedback  $feedback
     */
    public function sendEmailFeedback($feedback)
    {
        SendEmailFeedback::dispatch($feedback);
    }

    /**
     * @param  Feedback  $feedback
     * @return object
     */
    public function isClientCanSendFeedback($idClient)
    {
        $feedback = $this->feedbackRepo->getLastUserFeedback($idClient);

        if (!$feedback) {
            return (object)[
                "canSend" => true,
                "wait" => 0
            ];
        }

        $interval = CarbonInterval::seconds(Carbon::now()->DiffInSeconds($feedback->created_at))
            ->subHours(24)->cascade()->forHumans();

        return (object)[
            "canSend" => (Carbon::now()->floatDiffInHours($feedback->created_at) >= 0),
            "wait" => $interval
        ];
    }
}
