<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{

    public function getTransactionsUser( int $user_id)
    {
        $transaction = DB::select('select * from transactions where user_id = :user_id', ['user_id' => $user_id]);
        $transaction_index = DB::select("select (select sum(amount) from transactions where user_id = ".$user_id." AND type = 'receita' group by user_id) as receitas,(select sum(amount) from transactions where user_id = ".$user_id." AND type = 'despesa' group by user_id) as despesas, (select sum(amount) from transactions where user_id = ".$user_id." AND type = 'receita' group by user_id) - (select sum(amount) from transactions where user_id = ".$user_id." AND type = 'despesa' group by user_id) as total from transactions where user_id = :user_id group by user_id", ['user_id' => $user_id]);

       return response()->json(['status'=>1, 'data'=>$transaction, 'data_index'=>$transaction_index[0]], 200);
    }

    public function getTransactionsType( int $user_id, int $type)
    {
        $transaction = DB::select('select * from transactions where user_id = :user_id and type = :type', ['user_id' => $user_id, 'type' => $type]);
        
       return response()->json(['status'=>1, 'data'=>$transaction], 200);
    }

    public function getTransactionsRange( int $user_id, string $start, string $end)
    {
        $transaction = DB::select("select * from transactions where user_id = :user_id and transaction_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:59'", ['user_id' => $user_id]);
        
       return response()->json(['status'=>1, 'data'=>$transaction], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transactions::get();
        return response()->json(['status'=>1, 'data'=>$transaction], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'type' => 'required|integer',
            'description' => 'required|string|max:255',
            'amount' => 'required|max:255'
        ]);

        $transaction = new Transactions();
        $transaction->user_id = $request->user_id;
        $transaction->type = ($request->type==1)?'receita':'despesa';
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->transaction_date = date("Y-m-d H:i:s" );
        $res = $transaction->save($validated);

       return response()->json(['status'=>1, 'message' => 'Created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $transaction = Transactions::find($id);
        return response()->json(['status'=>1, 'data'=>$transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'type' => 'required|integer',
            'description' => 'required|string|max:255',
            'amount' => 'required|max:255'
        ]);

        $transaction = Transactions::find($id);
        $transaction->type = ($request->type==1)?'receita':'despesa';
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $res = $transaction->save($validated);

        return response()->json(['status'=>1, 'data'=>$transaction], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, )
    {
       Transactions::destroy($id);
        return response()->json(['status'=>1,'message' => 'Deleted']);
    }
}
