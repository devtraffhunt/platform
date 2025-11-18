<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\SystemDep;
use Carbon\Carbon;

class PaymentPageController extends Controller
{
    public function show($transaction)
    {
        $payment = Payment::query()
            ->where('payments.transaction', $transaction)
            ->where('payments.user_id', auth()->id()) // проверка владельца
            ->join('system_dep', 'system_dep.number_ps', '=', 'payments.id_system')
            ->select(
                'payments.external_id',
                'payments.user_id',
                'payments.sum',
                'payments.transaction',
                'payments.status',
                'payments.img_system',
                'payments.details',
                'system_dep.name as name_system',
                'payments.created_at',
                'payments.ps_system_id'
            )
            ->first();

        if (!$payment) {
            return response('Ошибка: платёж не найден или недоступен', 404);
        }

        $createdAt = $payment->created_at instanceof Carbon
            ? $payment->created_at
            : Carbon::parse($payment->created_at);

        $elapsedSec = max(0, $createdAt->diffInSeconds(now(), false));
        $ttlSec = max(0, 900 - $elapsedSec);
        $ttl = gmdate('i:s', $ttlSec);

        $details = json_decode($payment->details, true) ?? [];

        $data = [
            'external_id'   => $payment->external_id,
            'user_id'       => $payment->user_id,
            'sum'           => $payment->sum,
            'transaction'   => $payment->transaction,
            'status'        => $payment->status,
            'img_system'    => $payment->img_system,
            'details'       => $details,
            'name_system'   => $payment->name_system,
            'created_at'    => $payment->created_at,
            'ps_system_id'  => $payment->ps_system_id,
            'ttl'           => $ttl,
        ];

        switch ($payment->status) {
            case 1:
                $view = 'payments.success';
                break;
            case 2:
                $view = 'payments.failed';
                break;
            default:
                $view = 'payments.pay';
                break;
        }

        return view($view, compact('data'));
    }

    public function check($transaction)
{
    if (!$transaction) {
        return response()->json([
            'success' => false,
            'message' => 'Не указан transaction ID'
        ], 400);
    }

    $payment = Payment::query()
        ->where('transaction', $transaction)
        ->join('system_dep', 'system_dep.number_ps', '=', 'payments.id_system')
        ->select(
            'payments.external_id',
            'payments.user_id',
            'payments.sum',
            'payments.transaction',
            'payments.status',
            'payments.img_system',
            'payments.details',
            'system_dep.name as name_system',
            'payments.created_at',
            'payments.ps_system_id'
        )
        ->first();

    if (!$payment) {
        return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
    }

    if ($payment->user_id !== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'Access denied'], 403);
    }

    return response()->json([
        'success' => true,
        'status' => $payment->status,
        'transaction' => $payment->transaction,
        'external_id' => $payment->external_id,
        'sum' => $payment->sum,
        'details' => json_decode($payment->details, true) ?? [],
    ]);
}

public function decline($transaction)
{
    $payment = Payment::where('transaction', $transaction)
        ->where('status', 0)
        ->first();

    if (!$payment) {
        return response()->json(['success' => false, 'message' => 'Transaction not found or already closed'], 404);
    }

    if ($payment->user_id !== auth()->id()) {
        return response()->json(['success' => false, 'message' => 'You cannot cancel someone else transaction.'], 403);
    }

    $payment->update(['status' => 2]);

    \Log::info('Payment declined manually', [
        'transaction' => $payment->transaction,
        'user_id' => $payment->user_id,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Transactional deviations',
        'status' => 2,
    ]);
}

}
