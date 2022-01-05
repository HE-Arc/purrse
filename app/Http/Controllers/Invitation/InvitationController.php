<?php
namespace App\Http\Controllers\Invitation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lists;
use App\Models\UserToList;
use Illuminate\Support\Facades\Auth;

/**
 * The InvitationController manage the invitation link and when the user accept to add the list in his collection
 */
class InvitationController extends Controller
{
    /**
     * route : /invite/{token}
     * Find if the list exist
     */
    public function create(Request $request)
    {
        $arrayLists = Lists::where('token', $request->route('token'))->get(); //Find all list with the token il the url
        $exist = false;
        $error = false;
        $listName = null;
        if(sizeof($arrayLists) == 1){ //If one list is find
            $listName = $arrayLists[0]->name; //retrives the name
            //Find in the rellation table user_to_list, if the user has already acces to the list
            $userToList = UserToList::where([['user_id', Auth::id()],['list_id', $arrayLists[0]->id]])->get();
            $exist = sizeof($userToList) > 0 ? true : false;
        }else{
            $error = true; //Error when the token refere to any list
        }

        //Go to the invitation page
        return Inertia::render('Application/AcceptInvitation', [
            'listName' => $listName,
            'listToken' => $request->route('token'),
            'error' => $error,
            'listExist' => $exist,
        ]);
    }

    /**
     * route : /accept/{token}
     * Add to list to the user only if the user don't have already the list
     */
    public function accept(Request $request)
    {
        //Find the list with the token in the url
        $arrayListId = Lists::where('token', $request->route('token'))->get('id');

        //add the list to the relation table user_to_list
        if(sizeof($arrayListId) == 1){
            $userToList = UserToList::firstOrCreate([
                'user_id' => Auth::id(),
                'list_id' => $arrayListId[0]->id,
            ]);
        }
        return Inertia::render('Application/Home'); //Go to the home page
    }
}

?>
