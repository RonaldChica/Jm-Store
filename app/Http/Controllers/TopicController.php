<?php

namespace App\Http\Controllers;

use App\Events\Topic\TopicCreatedEvent;
use App\Events\Topic\TopicRemovedEvent;
use App\Events\Topic\TopicUpdatedEvent;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('topics/index', [
            'data' => Topic::orderBy('name')->paginate(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::findOrFail($id);

        return Inertia::render('topics/edit', [
            'data' => $topic
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        $topic = new Topic;
        $topic->name = $request->input('name');
        $topic->save();

        TopicCreatedEvent::dispatch($topic);

        return Redirect::route('topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::with(['questions', 'questions.user'])->find($id);

        return Inertia::render('topics/show', [
            'data' => $topic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TopicRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->name = $request->input('name');
        $topic->save();

        TopicUpdatedEvent::dispatch($topic);

        return Redirect::route('topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);

        TopicRemovedEvent::dispatch($topic);

        $topic->delete();

        return Redirect::route('topics.index');
    }
}
