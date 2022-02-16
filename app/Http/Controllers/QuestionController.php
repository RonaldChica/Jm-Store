<?php

namespace App\Http\Controllers;

use App\Events\Question\QuestionAddedEvent;
use App\Events\Question\QuestionReadedEvent;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $topicId = $request->input('topicId');
        $topic = Topic::findOrFail($topicId);

        $question = new Question;
        $question->question = $request->input('question');
        $question->topic()->associate($topic);

        $isAnonymous = $request->has('anonymous') ? $request->input('anonymous') : false;

        if (!$isAnonymous) {
            $user = $request->user();
            $question->user()->associate($user);
        }

        $question->save();

        QuestionAddedEvent::dispatch($question);

        return Redirect::route('topics.show', $topic->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\QuestionRequest  $request
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
        $question = Question::findOrFail($id);
        $question->readed = true;
        $question->save();

        $topic = $question->topic;

        QuestionReadedEvent::dispatch($question);

        return Redirect::route('topics.show', $topic->id);
    }
}
