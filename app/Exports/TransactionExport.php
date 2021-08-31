<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Name',
            'E-mail',
            'Phone',
            'Transaction Id',
            'Bank Transaction Id',
            'Amount',
            'Currency',
            'Payment Option',
            'Status',
            'Created At',
            'Updated At',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Order::join('users', 'orders.user_id', '=', 'users.id')->select('users.name','users.email','users.phone','orders.tx_id','orders.bank_tx_id','orders.amount','orders.currency','orders.payment_option','orders.status','orders.created_at','orders.updated_at')->orderByDesc('orders.created_at')->get()->toArray());
    }
}
