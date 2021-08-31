<?php

namespace App\Http\Controllers;

use App\RequestDetail;
use App\TalentAccount;
use App\Temp;
use App\User;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $username)
    {
        $tuser = User::where('username', $username)->first();
        $this->validate($request, [
            'to' => 'required|string|max:50',
            'pronoun' => 'required|string|in:She/Her,He/Him,They/Them,Other',
            'occasion' => 'required|string|in:None,Birthday,Anniversary,Give Thanks,Wedding,Gift,Announcement,Roast,Get advice,Question,Pep talk,Just cuz',
            'instruction' => 'required|string',
            'book_price' => 'required|integer|min:1',
        ]);

        $data = $request->input('to') . '|' . $request->input('pronoun') . '|' . $request->input('occasion') . '|' . $request->input('instruction');

        if ($request->has('from')) {
            $this->validate($request, [
                'from' => 'required|string|max:50',
            ]);
            $data = $data . '|' . $request->input('from');
        } else {
            $data = $data . '|' . '0';
        }
        if ($request->has('hide')) {
            $data = $data . '|' . 1;
        } else {
            $data = $data . '|' . 0;
        }

        Temp::updateOrCreate(
            ['user_id' => auth()->user()->id, 'data' => 0],
            ['data' => $data]
        );

        $shurjopay_service = new ShurjopayService();
        $tx_id = $shurjopay_service->generateTxId();
        $success_route = route('user.transaction.sammary', ['uid' => auth()->user()->id, 'tid' => $tuser->id]);
        $shurjopay_service->sendPayment(1, $success_route);
    }

    public function transaction_sammary(Request $request, $uid, $tid)
    {
        if ($uid == auth()->user()->id) {
            $talentUser = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.id', $tid)->select('users.*','talent_infos.*','categories.category')->first();
            $transaction = TalentAccount::join('orders', 'talent_accounts.order_id', '=', 'orders.id')->join('request_details', 'talent_accounts.request_id', '=', 'request_details.id')
            ->where(['talent_accounts.user_id' => $uid, 'talent_accounts.order_id' => $request->input('order_id'), 'talent_accounts.request_id' => $request->input('request_id')])
            ->select('talent_accounts.*', 'orders.tx_id', 'orders.bank_tx_id', 'orders.amount', 'orders.currency', 'orders.payment_option', 'request_details.talent_id', 'request_details.to', 'request_details.from', 'request_details.pronoun', 'request_details.occasion', 'request_details.instruction', 'request_details.hide', 'request_details.status as reqstatus')->first();

            return view('transaction_sammary')->with([
                'talentUser' => $talentUser,
                'transaction' => $transaction,
            ]);
        }
    }

    public function modify_order(Request $request, $request_id)
    {
        $data = RequestDetail::find($request_id);
        if ($data->status == 'Pending') {
            $this->validate($request, [
                'video_for' => 'required|string|max:50',
                'video_from' => 'nullable|string|max:50',
                'pronoun' => 'required|string|in:She/Her,He/Him,They/Them,Other',
                'occasion' => 'required|string|in:None,Birthday,Anniversary,Give Thanks,Wedding,Gift,Announcement,Roast,Get advice,Question,Pep talk,Just cuz',
                'instruction' => 'required|string',
            ]);
    
            if (is_null($request->input('video_from'))) {
                $data->from = '0';
            } else {
                $data->from = $request->input('video_from');
            }
            $data->to = $request->input('video_for');
            $data->pronoun = $request->input('pronoun');
            $data->occasion = $request->input('occasion');
            $data->instruction = $request->input('instruction');
            if ($request->has('hide')) {
                $data->hide = true;
            } else {
                $data->hide = false;
            }
            
            if ($data->save()) {
                return back()->with('flush-alert', array('success', 'Order information updated.'));
                flush('flush-alert');
            }
        } else {
            return back()->with('flush-alert', array('danger', 'This operation can no longer be changed.'));
            flush('flush-alert');
        }
    }
}
