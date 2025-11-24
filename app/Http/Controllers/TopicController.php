<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {}

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



        $request->validate([
            'title' => 'required|string|unique:topics,title',
            'description' => 'required',
            'timer' => 'required',
        ]);
        $input = $request->all();
        $input['slug'] = Str::slug($request->title, '-');
        $quiz = Topic::create($input);
        $quiz->save();
        return back()->with('added', 'Topic has been added');
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
        $request->validate([

            'title' => 'required|string',
            'description' => 'required',
            'timer' => 'required',


        ]);

        $topic = Topic::findOrFail($id);
        $topic->title = $request->title;
        $topic->slug = Str::slug($request->title, '-');
        $topic->description = $request->description;
        //$topic->per_q_mark = $request->per_q_mark;
        $topic->timer = $request->timer;

        $topic->save();

        return back()->with('updated', 'Topic updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {}
    public function deleteTopic($id)
    {
        $findquestions = Question::where('topic_id', '=', $id);
        $topic = Topic::where('id', '=', $id);
        $topic->delete();
        if ($findquestions->count() > 0) {
            foreach ($findquestions as $question) {

                if ($question->question_img != null) {
                    // $path = public_path().'/assessment/storage/question_img/'.$question->question_img;
                    $path = public_path() . '/storage/question_img/' . $question->question_img;
                    unlink($path);
                    //File::delete($path);
                }
                $question->delete();
            }
        }

        return back()->with('deleted', 'Topic has been deleted');
    }
    public function deleteperquizsheet($id)
    {
        $findquestions = Question::where('topic_id', '=', $id)->get();

        if ($findquestions->count() > 0) {
            foreach ($findquestions as $question) {

                if ($question->question_img != null) {
                    // $path = public_path().'/assessment/storage/question_img/'.$question->question_img;
                    $path = public_path() . '/storage/question_img/' . $question->question_img;
                    unlink($path);
                    //File::delete($path);
                }
                $question->delete();
            }

            return back()->with('deleted', 'Questions Deleted!');
        } else {
            return back()->with('added', 'No Answer Sheet Found For This Quiz !');
        }
    }
}
