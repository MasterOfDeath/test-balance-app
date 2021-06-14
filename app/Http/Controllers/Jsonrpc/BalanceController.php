<?php

namespace App\Http\Controllers\Jsonrpc;

use App\Http\Controllers\Controller;
use App\Http\Resources\BalanceResource;
use App\Http\Resources\BalanceHistoryResource;
use App\Services\BalanceService;
use Illuminate\Support\Facades\Validator;
use Tochka\JsonRpc\Exceptions\RPC\InvalidParametersException;

class BalanceController extends Controller
{
    private BalanceService $balanceService;

    public function __construct(BalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
    }

    /**
     * Get user balance.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function userBalance($userId)
    {
        $validator = Validator::make(compact('userId'), [
            'userId' => 'required|integer|numeric',
        ]);

        if ($validator->fails()) {
            throw new InvalidParametersException($validator->errors());
        }

        $balance = $this->balanceService->find()->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        return $balance ? new BalanceResource($balance) : null;
    }

    /**
     * Get balance history.
     *
     * @param  int  $limit
     * @param  int  $page
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function history($limit, $page, $userId)
    {
        $validator = Validator::make(compact('limit', 'page', 'userId'), [
            'limit'  => 'required|integer|numeric',
            'page'   => 'required|integer|numeric',
            'userId' => 'required|integer|numeric',
        ]);

        if ($validator->fails()) {
            throw new InvalidParametersException($validator->errors());
        }

        $history = $this->balanceService->find()->where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->paginate($limit, ['*'], 'page', $page);

        return $history->count() ? new BalanceHistoryResource($history) : null;
    }
}
