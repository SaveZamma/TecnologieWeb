<h2>{{ $job->title }}</h2>

<p>Congrats your job has just been sent to the recycle bin :)</p>

<p>
  <a href="{{ url('/jobs/' . $job->id) }}">View Your Job Listing</a>
</p>
