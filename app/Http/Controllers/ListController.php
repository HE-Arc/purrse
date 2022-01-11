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
        $list_id = UserToList::where('user_id', Auth::id())->get('list_id');
        $lists = Lists::whereIn('id', $list_id)->get()->toArray();
        for($i = 0; $i < count($lists); $i++){
            $spaces = Space::where('list_id', $lists[$i]['id'])->get()->toArray();
            for($j = 0; $j < count($spaces); $j++){
                $expenses = Expense::where('space_id', $spaces[$j]['id'])->get()->toArray();
                $spaces[$j]['expenses'] = [];
                foreach ($expenses as $expense){
                    array_push($spaces[$j]['expenses'],$expense);
                }
            }
            $lists[$i]['spaces'] = [];
            foreach ($spaces as $space){
                array_push($lists[$i]['spaces'],$space);
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

        $list = Lists::find($listData['id'])->update([
            'name' => $listData['name'],
            'image' => $listData['image']
        ]);

        //Return the response of the axios->post
        return response()->json('updated');
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
