<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * route : /newSpace
     * Create a new space
     * @return \Illuminate\Http\Response
     */
    public function createNewSpace(Request $request)
    {
        $spaceData = $request->all();

        $newSpace = Space::create([
            'list_id' => $spaceData['list_id'],
            'image' => $spaceData['name'],
            'description' => $spaceData['description'],
            'budget' => $spaceData['budget']
        ]);

        //Return the response of the axios->post
        return response()->json($newSpace);
    }

    /**
     * route : /updateSpace
     * Update the space with data in arguments
     * @return \Illuminate\Http\Response
     */
    public function updateSpace(Request $request)
    {
        $spaceData = $request->all();

        $space = Space::find($spaceData['id'])->update([
            'name' => $spaceData['name'],
            'description' => $spaceData['description'],
            'budget' => doubleval($spaceData['budget']),

        ]);

        //Return the response of the axios->post
        return response()->json('updated');
    }

    /**
     * route : /deleteSpace
     * Delete the space with is id in arguments
     * @return \Illuminate\Http\Response
     */
    public function deleteSpace(Request $request)
    {
        $spaceId = $request->all();

        $list = Space::find($spaceId['id']);
        $list->delete();

        //Return the response of the axios->post
        return response()->json('deleted');
    }
}
