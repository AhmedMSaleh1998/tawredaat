<?php

namespace App\Console\Commands;

use App\Mail\Subscription15DaytMail;
use App\Mail\SubscriptionAlertMail;
use App\Models\Company;
use App\Models\CompanySubscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Day15Exp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exp15';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $companies = Company::whereIn('id', CompanySubscription::with('company')->where('end_date','=',\Carbon\Carbon::now()->addDays(15)->format('Y-m-d'))->pluck('company_id'))->get();
        foreach ($companies as $company) {
            Mail::to($company->pri_contact_email)->send(new Subscription15DaytMail($company->name));
        }

    }
}