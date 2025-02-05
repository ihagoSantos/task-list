<?php

use App\Http\Requests\TaskRequest;
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
        // 'tasks' => Task::latest()->get() // method get return all data from database
        'tasks' => Task::latest()->paginate(10) // method paginate return data with pagination

    ]);
})->name("tasks.index");

// Return directly to create view
Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task){
    // then the parameter is automatically injected with the model instance, Laravel find the model by the id in the url and throw 404 if not found
    // By default, laravel use the id to identify the data. If you want to use another identifier, the method 'getRouteKeyName' must be implemented on the model
    return view('edit', [
        'task' => $task
    ]);

})->name("tasks.edit");

Route::get('/tasks/{task}', function (Task $task){

    // $task = collect($tasks)->firstWhere('id', $id);
    // if (!$task) {
    //     abort(Response::HTTP_NOT_FOUND);
    // }

    // return view("show", [
    //     "task" => $task
    // ]);
    // return view('show', [
    //     'task' => Task::findOrFail($id)
    // ]);
    return view('show', [
        'task' => $task
    ]);
})->name("tasks.show");

Route::post('/tasks', function (TaskRequest $request) {
    // validation replaced by TaskRequest validation

    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required',
    // ]); // if any error will be thrown, it will be catched by laravel and return back to the previous page with the variable $errors
    $data = $request->validated();

    // replaced by the create method
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task = Task::create($data);

    return redirect()
        ->route('tasks.show', [ 'task' => $task->id ])
        ->with('success', 'Task created successfully!') //create a session variable called success
    ;

})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // validation replaced by TaskRequest validation

    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required',
    // ]); // if any error will be thrown, it will be catched by laravel and return back to the previous page with the variable $errors

    // $data = $request->validated();

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()
        ->route('tasks.show', [ 'task' => $task->id ])
        ->with('success', 'Task updated successfully!') //create a session variable called success
    ;

})->name('tasks.update');

Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();
    return redirect()
        ->route('tasks.index')
        ->with('success', 'Task deleted successfully!'); //create a session variable called success
})->name('tasks.destroy');

Route::put('/tasks/{task}/toogle-complete', function(Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task updated successfully!'); // back() return to the previous page
})->name('tasks.toggle-complete');
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
