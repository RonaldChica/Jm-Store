<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\QuestionChannel;
use App\Broadcasting\TopicChannel;
use App\Broadcasting\TopicQuestionChannel;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('topics', TopicChannel::class);
Broadcast::channel('recargas', RecargaChannel::class);
Broadcast::channel('questions', QuestionChannel::class);
Broadcast::channel('topics.{id}.question', TopicQuestionChannel::class);
