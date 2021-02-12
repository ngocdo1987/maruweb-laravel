<?php
namespace App\Services;

use App\Models\User;
use App\Models\Payment;
use App\Models\Event;
use App\Models\PayJpCard;
use App\Models\PayJpCustomer;
use App\Models\PayJpPlan;
use App\Models\PayJpSubscription;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Services\MailService;
use App\Services\ReplyMailService;
use App\Services\RecurringService;

class UserService extends AbstractEloquentService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function searchAdvanced($request, $paginate = 0)
    {
        $data = $request->all();

        $users = DB::table('users')
                    ->leftJoin('payments', 'users.id', '=', 'payments.user_id')
                    ->where(function ($query) use ($data) {
                        // User type
                        if (isset($data['search_user_type']) && $data['search_user_type'] != '') {
                            $query->where('users.user_type', $data['search_user_type']);
                        }

                        // Representative name
                        if (isset($data['search_representative_name']) && $data['search_representative_name'] != '') {
                            $query->where('users.name', 'like', '%'.$data['search_representative_name'].'%');
                        }

                        // Corporate name / Company name
                        if (isset($data['search_corporation_name']) && $data['search_corporation_name'] != '') {
                            $corpName = $data['search_corporation_name'];

                            $query->where(function ($q) use ($corpName) {
                                $q->where('users.corporation_name', 'like', '%'.$corpName.'%')
                                    ->orWhere('users.company_name', 'like', '%'.$corpName.'%');
                            });
                        }

                        // Transfer holder
                        if (isset($data['search_transfer_holder']) && $data['search_transfer_holder'] != '') {
                            $query->where('payments.transfer_holder', 'like', '%'.$data['search_transfer_holder'].'%');
                        }

                        // Status
                        if (isset($data['search_status']) && $data['search_status'] != '') {
                            $query->where('users.status', $data['search_status']);
                        }
                        
                        if (isset($data['search_payment_confirmation_button']) && $data['search_payment_confirmation_button'] == 1) {
                            $query->where('payments.payment_method', 1)
                                ->where('payments.status', 0);
                        }

                        // Display on list
                        if (isset($data['search_display_on_list']) && $data['search_display_on_list'] != '') {
                            $query->where('users.display_on_list', $data['search_display_on_list']);
                        }
                    })
                    ->select(
                        'users.*',
                        'payments.id as payment_id',
                        'payments.transfer_holder',
                        'payments.payment_method',
                        'payments.status as payment_status',
                        'payments.updated_at as payment_updated_at',
                        'payments.created_at as payment_created_at'
                    )
                    ->orderBy('users.id', 'DESC')
                    ->orderBy('payments.id', 'DESC');

        
        if ($paginate === 1) {
            return $users->paginate(config('constants.user.per_page'));
        } else {
            return $users->get();
        }
    }

    // Prepare data for create and edit user form
    public function prepareUserFormData($request)
    {
        return [
            //in_array($request->user_type, [0, 1, 2, 3]) ? $request->user_type : 0,
            config('constants.user.industry'),
            config('constants.user.industry_corporation'),
            config('constants.user.payment_method'),
            config('constants.user.client'),
            config('constants.general.prefecture'),
            config('constants.user.gender'),
            config('constants.user.choose_mailing_address'),
            config('constants.payment.status'),
            config('constants.event.event_type'),
            config('constants.user.user_type'),
            config('constants.user.display_on_list')
        ];
    }

    // Store new user
    public function storeUser($request)
    {
        $data = $request->all();

        // Normally, when admin update user
        if (isset($data['user_type']) && in_array($data['user_type'], [0, 1, 2, 3])) {
            switch ($data['user_type']) {
                case 0:
                case 1:
                case 3:
                    $data['name'] = $data['association_notification_representative_fname'].' '.$data['association_notification_representative_lname'];
                    $data['email'] = $data['representative_email'];
                    break;
                case 2:
                    $data['name'] = $data['fname'].' '.$data['lname'];
                    //$data['email'] = $data['company_email'];
                    break;
                default:
    
                    break;
            }
            $data['refining_building_rating'] = $data['refining_building_rating_year'].'-'.$data['refining_building_rating_month'];
    
            $email_delivery_address = [];
            for ($i = 1; $i <= 10; $i++) {
                if (isset($data['delivery_address_'.$i]) && $data['delivery_address_'.$i] != '') {
                    $email_delivery_address['delivery_address_'.$i] = $data['delivery_address_'.$i];
                } else {
                    $email_delivery_address['delivery_address_'.$i] = '';
                }
            }
            $data['email_delivery_address'] = json_encode($email_delivery_address);

            // Set default pass
            $data['password'] = "";
        }

        $user = User::create($data);

        return $user->id;
    }

    // Update existing user
    public function updateUser($request)
    {
        $data = $request->all();

        $sendEmailFlag = 0;
        $changePasswordFlag = 0;

        $user = User::findOrFail($data['id']);

        // Normally, when admin update user
        if (isset($data['user_type']) && in_array($data['user_type'], [0, 1, 2, 3])) {
            switch ($data['user_type']) {
                case 0:
                case 1:
                case 3:
                    $data['name'] = $data['association_notification_representative_fname'].' '.$data['association_notification_representative_lname'];
                    $data['email'] = $data['representative_email'];
                    break;
                case 2:
                    $data['name'] = $data['fname'].' '.$data['lname'];
                    //$data['email'] = $data['company_email'];
                    break;
                default:
    
                    break;
            }
            $data['refining_building_rating'] = $data['refining_building_rating_year'].'-'.$data['refining_building_rating_month'];
    
            $email_delivery_address = [];
            for ($i = 1; $i <= 10; $i++) {
                if (isset($data['delivery_address_'.$i]) && $data['delivery_address_'.$i] != '') {
                    $email_delivery_address['delivery_address_'.$i] = $data['delivery_address_'.$i];
                } else {
                    $email_delivery_address['delivery_address_'.$i] = '';
                }
            }
            $data['email_delivery_address'] = json_encode($email_delivery_address);

            if ($data['password'] != "" && $data['password'] != null) {
                $changePasswordRemember = $data['password'];
                $data['password'] = bcrypt($data['password']);
                $changePasswordFlag = 1;
            } else {
                // Unset password
                unset($data['password']);
            }

            if (!isset($data['email_magazine'])) {
                $data['email_magazine'] = 0;
            }
        }

        // When update status
        if (isset($data['action']) && $data['action'] == 'update-status') {
            // Enable and update password!!!
            if ($data['status'] == 1) {
                if ($user->first_active_status == 0) {
                    // Generate password if it's empty
                    if ($data['password'] == '') {
                        $generateSecurePassword = $this->generateSecurePassword();
                        $data['password'] = $generateSecurePassword;
                    } else {
                        $generateSecurePassword = $data['password'];
                    }

                    $data['password'] = bcrypt($data['password']);
                }

                $sendEmailFlag = 1;
            }

            // Disable and reset password to empty
            if ($data['status'] == 0) {
                // Set default pass
                // $data['password'] = "";
            }
        }

        
        $user->update($data);

        //Log::info("Send email flag: ".$sendEmailFlag);
        //Log::info("generateSecurePassword: ".(isset($generateSecurePassword) ? $generateSecurePassword : "Not isset!"));
        //Log::info("Change password flag: ".$changePasswordFlag);

        // Check change password flag & send email
        if ($changePasswordFlag == 1) {
            //Log::info($changePasswordRemember);

            $mailService = new MailService();
            $mailService->whenAdminChangeUserPassword($user, $changePasswordRemember);
        }

        // Check flag and send email
        if ($sendEmailFlag == 1) {
            if (isset($generateSecurePassword) && $user->first_active_status == 0) {
                //Log::info($generateSecurePassword);

                $mailService = new MailService();
                $mailService->whenAdminAcceptUserMembership($user, $generateSecurePassword);

                // Update first active status
                $this->updateFirstActiveStatus($user->id);
            }
        }

        return $user->id;
    }

    // Destroy user
    public function destroyUser($id)
    {
        $user = User::where('id', $id)->first();
        
        // Unsubscribe user
        $this->unsubscribe($id);

        // *** Send mails before unsubscribe!!!
        $mailService = new MailService();
        $mailService->whenUnsubscribe($user);
    }

    // Store event
    public function storeEvent($request)
    {
        $data = $request->all();

        $event = Event::create($data);

        return $event;
    }

    // Destroy event
    public function destroyEvent($id)
    {
        Event::destroy($id);
    }
    
    public function storeUseFront($request)
    {
        $data = $request->all();
        if ($data['user_type'] == 2) {
            $data['name'] = $data['fname'].' '.$data['lname'];
        } else {
            $data['name'] = $data['association_notification_representative_fname'].' '.$data['association_notification_representative_lname'];
            $data['email'] = $data['representative_email'];
        }
        $data['password'] = "";
        $user = User::create($data);

        return $user->id;
    }

    // Private function
    private function generateSecurePassword()
    {
        return generateRandomString(2, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ').
                generateRandomString(2, '0123456789').
                generateRandomString(2, 'abcdefghijklmnopqrstuvwxyz').
                generateRandomString(2, '.-_!');
    }

    public function updateSettlementConfirmationDate($userId, $flag = 0)
    {
        $updateData = [
            'settlement_confirmation_date' => date('Y-m-d H:i:s'),
            'settlement_confirmation_flag' => $flag
        ];

        User::where('id', $userId)
                ->update($updateData);
    }

    public function updateLastDepositReportDate($userId)
    {
        return User::where('id', $userId)
                    ->update(['last_deposit_report_date' => date('Y-m-d H:i:s')]);
    }

    public function updateFirstActiveStatus($userId)
    {
        return User::where('id', $userId)
                    ->update(['first_active_status' => 1]);
    }

    public function unsubscribe($userId)
    {
        $recurringService = new RecurringService();

        // Delete all PayJP data
        // 1/ subscriptions
        $subscriptions = PayJpSubscription::where('user_id', $userId)->get();
        if (count($subscriptions) > 0) {
            foreach ($subscriptions as $s) {
                $recurringService->deleteSubscription($s->subscription_id);
            }
        }
        PayJpSubscription::where('user_id', $userId)->delete();

        // 2/ cards
        $cards = PayJpCard::where('user_id', $userId)->get();
        if (count($cards) > 0) {
            foreach ($cards as $c) {
                $recurringService->deleteCardOfCustomer($c->payjp_customer_id, $c->card_id);
            }
        }
        PayJpCard::where('user_id', $userId)->delete();

        // 3/ customers
        $customers = PayJpCustomer::where('user_id', $userId)->get();
        if (count($customers) > 0) {
            foreach ($customers as $c) {
                $recurringService->deleteCustomer($c->customer_id);
            }
        }
        PayJpCustomer::where('user_id', $userId)->delete();

        // 4/ plans
        $plans = PayJpPlan::where('user_id', $userId)->get();
        if (count($plans) > 0) {
            foreach ($plans as $p) {
                $recurringService->deletePlan($p->plan_id);
            }
        }
        PayJpPlan::where('user_id', $userId)->delete();

        // Leave flag all payments of user
        Payment::where('user_id', $userId)
                ->update(['leave_flag' => 1]);

        // Set status = 2 for user
        User::where('id', $userId)
                ->update(['status' => 2]);

        return true;
    }
}
