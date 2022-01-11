<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\ExpenseToUser;
use App\Models\User;

class ExpenseController extends Controller
{

    /**
     * route : /newList
     * Create a new list and generate a token for the list.
     * Create a entry in the table user_to_list, to link the user to the new list
     */
    public function createNewExpense(Request $request)
    {
        $expenseData = $request->all();

        $newExpense = Expense::create([
            'space_id' => $expenseData['space_id'],
            'name' => $expenseData['name'],
            'cost' => doubleval($expenseData['montant']),
            'date' => $expenseData['date'],
            'is_paid' => 0,
            'user_id' => Auth::id()
        ])->toArray();

        $userName = User::where('id', Auth::id())->get('username')[0];
        $newExpense['user'] = $userName['username'];
        //Return the responde of the axios->post
        return response()->json($newExpense);
    }

    /**
     * route : /updateExpense
     * Update the space with data in arguments
     * @return \Illuminate\Http\Response
     */
    public function updateExpense(Request $request)
    {
        $expenseData = $request->all();

        $expense = Expense::where('id', $expenseData['id']);

        $expense->update([
            'is_paid' => $expenseData['paid']
        ]);

        //Return the response of the axios->post
        return response()->json("updated");
    }

    /**
     * route : /deleteExpense
     * Delete the expense with is id in arguments
     * @return \Illuminate\Http\Response
     */
    public function deleteExpense(Request $request)
    {
        $expenseId = $request->all();

        $expense = Expense::find($expenseId['id']);
        $expense->delete();

        return response()->json('deleted');
    }
}
