<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\ExpenseToUser;

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
        ]);

        /*
        $userToExpense = ExpenseToUser::create([
            'user_id' => Auth::id(),
            'expense_id' => $newExpense->id,
        ]);*/

        //Return the responde of the axios->post
        return response()->json($newExpense);
    }
}
