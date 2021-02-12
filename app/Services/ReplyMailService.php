<?php
namespace App\Services;

use App\Models\ReplyMail;
use Illuminate\Support\Facades\DB;

class ReplyMailService extends AbstractEloquentService
{
    public function __construct(ReplyMail $model)
    {
        $this->model = $model;
    }

    public function searchAdvanced($request, $paginate = 0)
    {
        $data = $request->all();

        $replyMails = DB::table('reply_mails')
                        ->join('users', 'reply_mails.user_id', '=', 'users.id')
                        ->where(function ($query) use ($data) {
                            // From created at
                            if (isset($data['search_from_created_at']) && $data['search_from_created_at'] != '') {
                                $query->whereDate('reply_mails.created_at', '>=', $data['search_from_created_at']);
                            }

                            // To created at
                            if (isset($data['search_to_created_at']) && $data['search_to_created_at'] != '') {
                                $query->whereDate('reply_mails.created_at', '<=', $data['search_to_created_at']);
                            }

                            // Email
                            if (isset($data['search_email']) && $data['search_email'] != '') {
                                $query->where('users.email', 'like', '%'.$data['search_email'].'%');
                            }
                        })
                        ->select('reply_mails.id', 'reply_mails.created_at', 'reply_mails.subject', 'reply_mails.user_id', 'users.email', 'users.name', 'users.user_type', 'users.association_notification_representative_fname', 'users.association_notification_representative_lname', 'users.fname', 'users.lname')
                        ->orderBy('reply_mails.id', 'DESC');
        
        if ($paginate == 1) {
            return $replyMails->latest()->paginate(config('constants.reply_mail.per_page'));
        } else {
            return $replyMails->get();
        }
    }

    public static function saveLog($mailTemplate, $data, $userId, $subject = null, $content = null)
    {
        if ($mailTemplate != 'mail_newsletter') {
            if (in_array(config('app.url'), ['http://refining.or.jp', 'https://refining.or.jp', 'http://xb686172.xbiz.jp'])) {
                $mailContent = file_get_contents("../laravel/resources/views/emails/txt/".$mailTemplate.".txt");
            } else {
                $mailContent = file_get_contents("../resources/views/emails/txt/".$mailTemplate.".txt");
            }

            foreach ($data as $k => $v) {
                // For replace route
                $mailContent = str_replace('{{ '.$k.' }}', $v, $mailContent);
                
            }

            switch ($mailTemplate) {
                case 'complete_applicate_to_corp':
                    $subject = '[自動送信]新規入会準備が完了しました。';
                    break;
                case 'complete_register_to_corp':
                    $subject = '[自動送信]新規会員申請が完了しました。';
                    break;
                case 'password_changed_to_corp':
                    $subject = '[自動送信]パスワードを変更いたしました。';
                    break;
                case 'password_reset_corp':
                    $subject = '[自動送信]パスワードの再設定について';
                    break;                
                case 'complete_applicate_to_user':
                    $subject = '[自動送信]新規入会準備が完了しました。';
                    break;
                case 'complete_register_to_user':
                    $subject = '[自動送信]新規会員申請が完了しました';
                    break;
                case 'password_changed_to_user':
                    $subject = '[自動送信]パスワードを変更いたしました。';
                    break;
                case 'password_reset':
                    $subject = '[自動送信]パスワードの再設定について';
                    break;
                case 'bank_transfer_completed': 
                    $subject = '[自動送信]新年度の会費のお支払いが確認できました。';
                    break;
                case 'bank_transfer_completed_corp': 
                    $subject = '[自動送信]新年度の会費のお支払いが確認できました。';
                    break;
                case 'send_at_1st_september_to_corp': 
                    $subject = '[自動送信]次年度の会費につきまして';
                    break;
                case 'send_at_1st_september_to_personal': 
                    $subject = '[自動送信]次年度の会費につきまして';
                    break;
                case 'send_at_15th_october_to_corp':
                    $subject = '[自動送信]会費のお支払いがお済みでないようです';
                    break;
                case 'send_at_15th_october_to_personal':
                    $subject = '[自動送信]会費のお支払いがお済みでないようです';
                    break;
                case 'recurring_credit_card_failed': 
                    $subject = '[自動送信]会費決済の不具合につきまして';
                    break;
                case 'recurring_credit_card_failed_corp': 
                    $subject = '[自動送信]会費決済の不具合につきまして';
                    break; 
                case 'change_password_profile': 
                    $subject = '[自動送信]パスワードを変更いたしました。';
                    break;      
                case 'unsubscribe_to_personal':
                    $subject = '[自動返信]退会を受け付けました';
                    break;
                case 'unsubscribe_to_corp':
                    $subject = '[自動返信]退会を受け付けました';
                    break;
                case 'contact_to_user':
                    $subject = '[自動送信]お問い合わせありがとうございます';
                    break;
                case 'user_report_bank_transfer_to_admin':
                    $subject = '[自動送信]振込完了報告がありました';
                    break;
                case 'user_report_bank_transfer_to_user':
                    $subject = '[自動送信]振込完了報告を受け付けました';
                    break;
                case 'admin_change_user_password_to_personal':
                    $subject = '[自動送信]パスワードを変更いたしました。';
                    break;
                case 'admin_change_user_password_to_corp':
                    $subject = '[自動送信]パスワードを変更いたしました。';
                    break;
                case 'confirm_1st_payment_to_personal':
                    $subject = '[自動送信]会費のお支払いが完了いたしました。';
                    break;
                case 'confirm_1st_payment_to_corp':
                    $subject = '[自動送信]会費のお支払いが完了いたしました。';
                    break;
                case 'confirm_2nd_payment_to_personal': 
                    $subject = '[自動送信]次年度会費のお支払いが完了いたしました。';
                    break;
                case 'confirm_2nd_payment_to_corp': 
                    $subject = '[自動送信]次年度会費のお支払いが完了いたしました。';
                    break;
            }
        } else {
            $mailContent = $content;
        }
        

        ReplyMail::create([
            'user_id' => $userId,
            'subject' => $subject,
            'content' => $mailContent
        ]);
    }

    public static function getByUserId($userId)
    {
        return DB::table('reply_mails')
                ->join('users', 'reply_mails.user_id', '=', 'users.id')
                ->where('reply_mails.user_id', $userId)
                ->select('reply_mails.*', 'users.email', 'users.name')
                ->orderBy('reply_mails.id', 'DESC')
                ->get();
    }
}
