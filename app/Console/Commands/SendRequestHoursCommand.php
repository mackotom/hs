<?php

namespace App\Console\Commands;

use App\Mail\HoursRequest;
use App\Models\AdditionalHour;
use App\Models\AdditionalHourStatus;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class SendRequestHoursCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hours:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to request additionals hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $status = AdditionalHourStatus::whereCode('request_sended')->first();

        $query = AdditionalHour::whereHas('status', function(Builder $query) {
            $query->whereCode('requested');
        })->get();


        $grouped = $query->groupBy('user_id');

        foreach($grouped as $user_id => $additional_hours) {
            
            $user = User::select('name', 'email')->whereId($user_id)->first();

            Mail::to(config('mail.to.address'))->cc($user->email)->send(new HoursRequest($user, $additional_hours));

            AdditionalHour::whereIn('id', $additional_hours->pluck('id')->toArray())->update(['status_id' => $status->id]);

        }

        return Command::SUCCESS;
    }
}
