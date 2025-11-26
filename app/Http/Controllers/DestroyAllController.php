<?php

namespace App\Http\Controllers;

use App\Mail\ExamEmail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DestroyAllController extends Controller
{
    public function AllUsersDestroy()
    {
        User::where('role', '!=', 'A')->getQuery()->delete();
        // User::where('role', '!=', 'A')->truncate();
        return back()->with('deleted', 'All Student Has Been Deleted');
    }

    public function AllAnswersDestroy()
    {
        Answer::truncate();
        return back()->with('deleted', 'All Answer Sheets Has Been Deleted');
    }

    public function retryUserExam(User $user)
    {
        $user?->result()?->delete();
        $user?->essay()?->delete();

        $user->update(['status' => 'retry']);

        $user?->exam()?->update([
            'started_at' => null,
            'end_at' => null,
            'sent_by' => Auth::user()?->name,
            'violation' => 0,
        ]);

        Mail::to($user)->send(new ExamEmail($user));

        return back()->with('updated', 'User exam has been reset. The user can now retake the exam.');
    }
}
