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
     */
    public function createNewList(Request $request)
    {
        $listData = $request->all();
        $listToken = substr(md5(uniqid(rand(1, 10))), 0, 10);

        $newList = Lists::create([
            'name' => $listData['name'],
            'image' => $listData['image'],
            'token' => $listToken
        ]);


        $userToList = UserToList::create([
            'user_id' => Auth::id(),
            'list_id' => $newList->id,
        ]);

        //Return the responde of the axios->post
        return response()->json($newList);
    }
}
