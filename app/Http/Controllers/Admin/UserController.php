<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

use App\Services\PaymentService;
use App\Services\ReplyMailService;
use App\Services\EventService;
use App\Services\UserService;
use App\Services\CheckoutService;
use App\Models\User;
use App\Models\Payment;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Event;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->service->searchAdvanced($request, 1);
        $userTypeConfig = config('constants.user.user_type');
        $statusConfig = config('constants.user.status');
        $displayOnListConfig = config('constants.user.display_on_list');
        $searchParams = '?search_user_type='.request()->search_user_type.
                        '&search_representative_name='.request()->search_representative_name.
                        '&search_corporation_name='.request()->search_corporation_name.
                        '&search_transfer_holder='.request()->search_transfer_holder.
                        '&search_status='.request()->search_status.
                        '&search_display_on_list='.request()->search_display_on_list.
                        '&search_payment_confirmation_button='.request()->search_payment_confirmation_button;
       
        return view('admin.users.index', compact('users', 'statusConfig', 'userTypeConfig', 'displayOnListConfig', 'searchParams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userType = in_array($request->user_type, [0, 1, 2, 3]) ? $request->user_type : 0;

        list($industryConfig, $industryCoConfig, $paymentMethodConfig, $clientConfig, $prefectureConfig, $genderConfig, $chooseMailingAddressConfig, $paymentStatusConfig, $eventTypeConfig, $userTypeConfig, $displayOnListConfig) = $this->service->prepareUserFormData($request);

        return view('admin.users.create', compact('userType', 'industryConfig', 'paymentMethodConfig', 'clientConfig', 'prefectureConfig', 'genderConfig', 'chooseMailingAddressConfig', 'paymentStatusConfig', 'eventTypeConfig', 'userTypeConfig', 'displayOnListConfig', 'industryCoConfig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $id = $this->service->storeUser($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.users.index').'?page='.request()->page;
        return redirect($url)->with('success', __('Save successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $userType = $user->user_type;

        list($industryConfig, $industryCoConfig, $paymentMethodConfig, $clientConfig, $prefectureConfig, $genderConfig, $chooseMailingAddressConfig, $paymentStatusConfig, $eventTypeConfig, $userTypeConfig, $displayOnListConfig) = $this->service->prepareUserFormData($request);

        $refiningBuildingRating = explode("-", $user->refining_building_rating);
        $refiningBuildingRatingYear = isset($refiningBuildingRating[0]) ? $refiningBuildingRating[0] : '';
        $refiningBuildingRatingMonth = isset($refiningBuildingRating[1]) ? $refiningBuildingRating[1] : '';

        $replyMails = ReplyMailService::getByUserId($id);

        $payment = Payment::where('id', $request->payment_id)->first();

        $events = EventService::getByUserId($id);

        $emailDeliveryAddress = json_decode($user->email_delivery_address, true);

        return view('admin.users.edit', compact('user', 'userType', 'industryConfig', 'paymentMethodConfig', 'clientConfig', 'prefectureConfig', 'genderConfig', 'chooseMailingAddressConfig', 'refiningBuildingRatingYear', 'refiningBuildingRatingMonth', 'paymentStatusConfig', 'eventTypeConfig', 'userTypeConfig', 'displayOnListConfig', 'replyMails', 'payment', 'events', 'emailDeliveryAddress', 'industryCoConfig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $id = $this->service->updateUser($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        if (isset($request->action) && $request->action == 'update-status') {
            echo $id;
        } else {
            $url = route('admin.users.index').'?page='.request()->page;
            return redirect($url)->with('success', __('Save successfully'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $this->service->destroyUser($id);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        echo $id;
        //$url = route('admin.users.index').'?page='.request()->page;
        //return redirect($url)->with('success', __('Deleted successfully'));
    }

    public function exportCsv(Request $request)
    {
        list($industryConfig, $industryCoConfig, $paymentMethodConfig, $clientConfig, $prefectureConfig, $genderConfig, $chooseMailingAddressConfig, $paymentStatusConfig, $eventTypeConfig, $userTypeConfig, $displayOnListConfig) = $this->service->prepareUserFormData($request);
        $getEvent = Event::get()->toArray();
       
        return Excel::download(new UsersExport($request, $this->service, $getEvent, $clientConfig, $industryConfig, $paymentMethodConfig), 'users_'.date('Y_m_d_H_i_s').'.csv');
    }

    // Add event for user
    public function storeEvent(Request $request)
    {
        try {
            $event = $this->service->storeEvent($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
        }

        return view('admin.users.store_event', compact('event'));
    }

    // Delete event for user
    public function destroyEvent(Request $request, $id)
    {
        try {
            $this->service->destroyEvent($id);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
        }

        echo $id;
    }

    // Create bank transfer payment
    public function createBankTransferPayment(Request $request)
    {
        $userId = (int)$request->hidden_user_id;
        $from = $request->from;
        $user = User::where('id', $userId)->first();

        if (isset($user->id)) {
            $checkoutService = new CheckoutService();

            $numberOfApplications = $user->user_type == 1 ? $checkoutService->getNumberOfApplications($user->id) : 0;
            $corpJoinFee = ($user->user_type == 1 && $checkoutService->totalSuccessfullyPaymentsByUserId($user->id) == 0) ? config('constants.general.corp_join_fee') : 0;
            $partnerJoinFee = ($user->user_type == 0 && $checkoutService->totalSuccessfullyPaymentsByUserId($user->id) == 0) ? config('constants.general.partner_join_fee') : 0;
        


            $newPayment = Payment::create([
                'user_id' => $user->id,
                'payment_method' => 1,
                'transfer_holder' => $user->corporation_name,
                'partner_join_fee' => $partnerJoinFee,
                'corp_join_fee' => $corpJoinFee,
                'partner_yearly_fee' => $user->user_type == 0 ? config('constants.general.partner_yearly_fee') : 0,
                'corp_yearly_fee' => $user->user_type == 1 ? config('constants.general.corp_yearly_fee') : 0,
                'personal_yearly_fee' => $user->user_type == 2 ? config('constants.general.personal_yearly_fee') : 0,
                'number_of_applications' => $numberOfApplications,
                'amount' => $checkoutService->calculatePaymentAmount($user->user_type, $user->id, $numberOfApplications),
                'failed_reason' => '',
                'status' => 0,
                //'created_at' => null
            ]);

            //$this->service->updateSettlementConfirmationDate($userId);
            $this->service->updateLastDepositReportDate($userId);

            $message = __('Create bank transfer payment successfully.');

            if ($from == 'index') {
                $url = route('admin.users.index').'?page='.request()->page;
            }

            if ($from == 'edit') {
                $url = route('admin.users.edit', $user->id).'?payment_id='.$newPayment->id.'&page='.request()->page;
            }
        } else {
            $url = route('admin.users.index').'?page='.request()->page;
            $message = __('Not found user.');
        }
        
        return redirect($url)->with('success', $message);
    }
}
