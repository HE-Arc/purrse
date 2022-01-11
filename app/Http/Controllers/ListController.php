<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lists;
use App\Models\Space;
use App\Models\UserToList;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Expense;

class ListController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $lists = Lists::all()->toArray();
        $spaces = Space::all()->toArray();
        $expenses = Expense::all()->toArray();
        for ($i = 0; $i < count($spaces); $i++) {
            $spaces[$i]['expenses'] = [];
            for ($j = 0; $j < count($expenses); $j++) {
                if ($spaces[$i]['id'] == $expenses[$j]['space_id']) {
                    array_push($spaces[$i]['expenses'], $expenses[$j]);
                }
            }
        }
        for ($i = 0; $i < count($lists); $i++) {
            $lists[$i]['spaces'] = [];
            for ($j = 0; $j < count($spaces); $j++) {
                if ($lists[$i]['id'] == $spaces[$j]['list_id']) {
                    array_push($lists[$i]['spaces'], $spaces[$j]);
                }
            }
        }
        //print_r($lists);
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
        $listId = $request->all();

        $list = Lists::find($listId['id']);
        $list->delete();

        return response()->json('deleted');
    }
}
