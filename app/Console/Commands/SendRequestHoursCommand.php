<?php

namespace App\Console\Commands;

use App\Mail\HoursRequest;
use App\Models\AdditionalHour;
use App\Models\AdditionalHourContact;
use App\Models\AdditionalHourStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
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

        $status_sended = AdditionalHourStatus::whereCode('request_sended')->first();

        $day = Carbon::now()->day;

        $additional_hour_contacts = AdditionalHourContact::whereSendAt($day)->default()->with([
            'user' => function($query) {
                return $query->with(['additionalHours' => function($query) {
                    $query->whereHas('status', function($query) {
                        $query->whereCode('requested');
                    });
                }]);
            }
        ])->get();

        foreach($additional_hour_contacts as $additional_hour_contact) {

            $user = $additional_hour_contact->user;

            if($user && $user->additionalHours->count() > 0) {

                $this->sendSummaryUserEmail($additional_hour_contact, $user, $user->additionalHours, $status_sended);
            
            }


        }

        return Command::SUCCESS;
    }


    /**
     * Send the summary mail to the contact user
     *
     * @param AdditionalHourContact $contact
     * @param User $user
     * @param Collection $additional_hours
     * @param AdditionalHourStatus $status_sended
     * @return boolean
     */
    protected function sendSummaryUserEmail(AdditionalHourContact $contact, User $user, Collection $additional_hours, AdditionalHourStatus $status_sended) : bool {

        Mail::send(new HoursRequest($user, $additional_hours, $contact));

        AdditionalHour::whereIn('id', $additional_hours->pluck('id')->toArray())->update(['status_id' => $status_sended->id]);

        return true;

    }
}
