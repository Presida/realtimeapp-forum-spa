<?php

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');

Route::fallback(function() {
    return response()->json([
        'message' => 'Page Not Found.'
    ], 404);
});
