<?php
namespace App\Http\Controllers\Invitation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lists;

class InvitationController extends Controller
{
    public function create(Request $request)
    {
        $list = Lists::where('token', $request->route('token'));
        $arrayListName = $list->get('name');
        $error = false;
        $listName = null;
        if(sizeof($arrayListName) == 1){
            $listName = $arrayListName[0];
        }else{
            $error = true;
        }

        //if token exist
        return Inertia::render('Application/AcceptInvitation', [
            'listName' => $listName,
            'error' => $error,
        ]);
    }
}

?>
