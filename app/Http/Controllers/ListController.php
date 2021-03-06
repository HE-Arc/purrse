<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lists;
use App\Models\Space;
use App\Models\UserToList;
use App\Models\ExpenseToUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Expense;

class ListController extends Controller
{
    /**
     * Display the mainboard view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        //Get all lists id related to the connected users
        $list_id = UserToList::where('user_id', Auth::id())->get('list_id');
        //Get lists from lists id
        $lists = Lists::whereIn('id', $list_id)->get()->toArray();
        for ($i = 0; $i < count($lists); $i++) {
            //Get Spaces tied to this list
            $spaces = Space::where('list_id', $lists[$i]['id'])->get()->toArray();
            for ($j = 0; $j < count($spaces); $j++) {
                //Get Expenses tied to this space
                $expenses = Expense::where('space_id', $spaces[$j]['id'])->get()->toArray();
                $spaces[$j]['expenses'] = [];
                foreach ($expenses as $expense){
                    //Get the username that created the expense
                    $expense['user'] = User::where('id', $expense['user_id'])->get('username')[0]['username'];
                    array_push($spaces[$j]['expenses'],$expense);
                }
            }
            $lists[$i]['spaces'] = [];
            foreach ($spaces as $space) {
                array_push($lists[$i]['spaces'], $space);
            }
        }

        return Inertia::render('Application/Mainboard', [
            'lists_arr' => $lists
        ]);
    }

    /**
     * route : /newList
     * Create a new list and generate a token for the list.
     * Create a entry in the table user_to_list, to link the user to the new list
     * @return \Illuminate\Http\Response
     */
    public function createNewList(Request $request)
    {
        $listData = $request->all();
        $listToken = substr(md5(uniqid(rand(1, 10))), 0, 10);

        $newList = Lists::create([
            'name' => $listData['name'],
            'image' => $listData['image'],
            'token' => $listToken,
            'owner_id' => Auth::id()
        ]);


        $userToList = UserToList::create([
            'user_id' => Auth::id(),
            'list_id' => $newList->id,
        ]);

        //Return the response of the axios->post
        return response()->json($newList);
    }

    /**
     * route : /updateList
     * Update the list with data in arguments
     * @return \Illuminate\Http\Response
     */
    public function updateList(Request $request)
    {
        $listData = $request->all();

        $list = Lists::where('id', $listData['id'])->where('owner_id', Auth::id());
        $listCollection = $list->first();
        if ($listCollection) {
            $list->update([
                'name' => $listData['name']
            ]);
            return response()->json($listCollection->fresh());
        }else{
            return response()->json("false");
        }
    }

    /**
     * route : /deleteList
     * Delete the list with is id in arguments
     * @return \Illuminate\Http\Response
     */
    public function deleteList(Request $request)
    {
        $listData = $request->all();

        $list = Lists::where('id', $listData['id'])->where('owner_id', Auth::id());

        return response()->json($list->delete());
    }
}
