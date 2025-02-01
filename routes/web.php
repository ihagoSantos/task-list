<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

// Models
use App\Models\Task;
use Illuminate\Http\Request;

Route::get("/", function () {
    return redirect()->route("tasks.index");
});
Route::get('/tasks', function () {
    // return view('welcome');
    return view('index', [
        // "name" => "<b>Ihago</b>" // html is automatic escaped for laravel
        // "name" => "Ihago" // html is automatic escaped for laravel
        'tasks' => Task::latest()->get()
    ]);
})->name("tasks.index");

// Return directly to create view
Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{id}', function ($id){

    // $task = collect($tasks)->firstWhere('id', $id);
    // if (!$task) {
    //     abort(Response::HTTP_NOT_FOUND);
    // }

    // return view("show", [
    //     "task" => $task
    // ]);
    return view('show', [
        'task' => Task::findOrFail($id)
    ]);

})->name("tasks.show");

Route::post('/tasks', function (Request $request) {

    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
    ]); // if any error will be thrown, it will be catched by laravel and return back to the previous page with the variable $errors

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()
        ->route('tasks.show', [ 'id' => $task->id ])
        ->with('success', 'Task created successfully!') //create a session variable called success
    ;

})->name('tasks.store');

// Route::get("/hallo", function () {
//     // return redirect("/hello"); // redirect to "/hello" url
//     return redirect()->route("hello"); // redirect to route with name "hello"
// });

// Route::get("/hello", function () {
//     return "Hello!";
// })->name("hello");

// Route::get("/greet/{name}", function ($name) {
//     return "Hello ". $name . "!";
// });


// fallback route if no other router is being matched with the request
Route::fallback(function () {
    return "Route Not Found";
});
