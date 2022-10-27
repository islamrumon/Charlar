@extends('layouts.master')
@section('title')
    @translate(Queue jobs Status)
@endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection
@section('main-content')
@php
  $data = App\Http\Controllers\Dashboard\QueueTrackerController::queuecount();
@endphp
    <div class="card ">
        <div class="card-body">
            <div class="container-fluid default-dash">
                <div class="row">

                    <div class="col-xl-4 col-md-6 dash-xl-50">
                        <div class="card profile-greeting">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="greeting-user">
                                            <h1>@translate(Failed queue jobs)</h1>
                                            <h2 class="">{{$data[0]}}</h2>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 dash-xl-50">
                        <div class="card profile-greeting">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="greeting-user">
                                            <h1>@translate(Proccessed queue jobs)</h1>
                                            <h2 class="">{{$data[1]}}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-4 col-md-6 dash-xl-50">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="greeting-user">
                                           <a href="{{route('queue.work')}}" class="btn btn-primary">@translate(Start the queue)</a>
                                           <a href="{{route('queue.retry')}}" class="btn btn-warning">@translate(Start the Failed queue)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-title">
                    @translate(Follow this Instruction for setup the queue job in your cpanel)
                </div>
                <h2 id="add-a-cron-job">Add a cron job</h2>
                <p>To create a cron job, perform the following steps:</p>
                <ol>
                    <li>
                        <p>Select the interval at which you wish to run the cron job from the appropriate menus, or enter
                            the values in the text boxes.</p>
                        <ul>
                            <li>
                                <p><em>Common Settings</em> — Select a commonly-used interval. The system will configure the
                                    appropriate settings in the <em>Minute</em>, <em>Hour</em>, <em>Day</em>,
                                    <em>Month</em>,
                                    and <em>Weekday</em> text boxes for you.</p>
                            </li>
                            <li>
                                <p><em>Minute</em> — The number of minutes between each time the cron job runs, or the
                                    minute of each hour on which you wish to run the cron job.</p>
                            </li>
                            <li>
                                <p><em>Hour</em> — The number of hours between each time the cron job runs, or the hour of
                                    each day on which you wish to run the cron job.</p>
                            </li>
                            <li>
                                <p><em>Day</em> — The number of days between each time the cron job runs, or the day of the
                                    month on which you wish to run the cron job.</p>
                            </li>
                            <li>
                                <p><em>Month</em> — The number of months between each time the cron job runs, or the month
                                    of the year in which you wish to run the cron job.</p>
                            </li>
                            <li>
                                <p><em>Weekday</em> — The days of the week on which you wish to run the cron job.</p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>In the <em>Command</em> text box, enter the command that you wish the system to run.
                        <div class="callout callout-warning">
                            <div class="callout-heading">Important:</div>
                            <div class="callout-content">
                                <ul>
                                    <li>
                                        <p>You <strong>must</strong> specify settings for the <em>Minute</em>,
                                            <em>Hour</em>,
                                            <em>Day</em>,
                                            <em>Month</em>, <em>Weekday</em>, and <em>Command</em> text boxes.
                                        </p>
                                    </li>
                                    <li>
                                        <p>Exercise <strong>extreme</strong> caution when you use the <code>rm</code>
                                            command in
                                            a cron job.
                                            If you do <strong>not</strong> declare the correct options, you may delete your
                                            home
                                            directory&rsquo;s
                                            data.</p>
                                    </li>
                                    <li>
                                        <p>If your cron job runs a custom script, the script requires the execute
                                            permission.
                                            For more
                                            information, read Red Hat&rsquo;s <a
                                                href="https://www.redhat.com/sysadmin/introduction-chmod"
                                                target="_blank">Linux
                                                Permissions</a> documentation.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="callout callout-info">
                            <div class="callout-heading">Note:</div>
                            <div class="callout-content">
                                <p>Specify the absolute path to the command that you wish to run. For example, if you wish
                                    to
                                    run the <code>php artisan queue:work</code>
                                    file in your home directory, enter the following command for start the Queue:
                                <div class="highlight">
                                    <pre class="pre-code"><code
                            class="language-bash" data-lang="bash">/usr/local/bin/php /home/hosting-username/project-folder/artisan queue:work  >> /dev/null 2>&1</code></pre>
                                </div>
                                </p>
                            </div>

                            <div class="callout-content">
                                <p>If you want to run failed queu For example, if you wish to
                                    run the <code>php artisan queue:retry all</code>
                                    file in your home directory, enter the following command for start the Queue:
                                <div class="highlight">
                                    <pre class="pre-code"><code
                            class="language-bash" data-lang="bash">/usr/local/bin/php /home/hosting-username/project-folder/artisan queue:retry all  >> /dev/null 2>&1</code></pre>
                                </div>
                                </p>
                            </div>
                        </div>
                        </p>
                    </li>
                </ol>
            </div>
        </div>
    @endsection
