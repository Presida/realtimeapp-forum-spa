<?php

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::fallback(function() {
    return response()->json([
        'message' => 'Page Not Found.'
    ], 404);
});
