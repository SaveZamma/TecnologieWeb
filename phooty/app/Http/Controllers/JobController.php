<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
  public function index()
  {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', ['jobs' => $jobs]);
  }

  public function create()
  {
    return view('jobs.create');
  }

  public function store()
  {
//...validation
    request()->validate([
      'title' => ['required', 'min:3'],
      'salary' => ['required']
    ]);

    Job::create([
      'title' => request('title'),
      'salary' => request('salary'),
      'employer_id' => 1
    ]);

    return redirect('/jobs');
  }

  public function show(Job $job)
  {
    return view('jobs.show', ['job' => $job]);
  }

  public function edit(Job $job)
  {
    return view('jobs.edit', ['job' => $job]);
  }

  public function update(Job $job)
  {
// authorize

    // validate
    request()->validate([
      'title' => ['required', 'min:3'],
      'salary' => ['required']
    ]);

    // update the job
//  $job = Job::findOrFail($id); // to not manually fetch the job from the DB but let the framework working instead, see Laravel Route Model Binding
    $job->title = request('title');
    $job->salary = request('salary');
    $job->save();

    // persist
    // the same as above
//  $job->update([
//    'title' => request('title'),
//    'salary' => request('salary')
//  ]);
    // redirect to the job page
    return redirect('/jobs/' . $job->id);
  }

  public function destroy(Job $job)
  {
// authorize
    // delete the job
//  $job = Job::findOrFail($id);
    $job->delete();
    // redirect
    return redirect('/jobs');
  }
}
