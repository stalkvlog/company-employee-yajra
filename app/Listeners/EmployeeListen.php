<?php

namespace App\Listeners;

use App\Events\EmployeeEvent;
use App\Mail\CompanyEmployeeStatus;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmployeeListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmployeeEvent $event)
    {
        $emps = Employee::get();
        foreach ($emps as $emp) {
            if($emp->email == $event->employee['email']) 
            {
                Mail::to($emp->email)
                ->send(new CompanyEmployeeStatus($event->employee));
            }
        }
    }
}
