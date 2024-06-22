<?php


use App\Models\Video;

test('given back readable video duration', function () {
    $video= Video::factory()->create(['duration_in_mins' => 10]);

    expect($video->getReadableDuration())->toEqual('10min');
});
