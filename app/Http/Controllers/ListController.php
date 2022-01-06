<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Lists;
use App\Models\Space;
use App\Models\Expense;
use SebastianBergmann\Environment\Console;

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
        for($i = 0; $i < count($spaces); $i++){
            $spaces[$i]['expenses'] = [];
            for($j = 0; $j < count($expenses); $j++){
                if($spaces[$i]['id'] == $expenses[$j]['space_id']){
                    array_push($spaces[$i]['expenses'],$expenses[$j]);
                }
            }
        }
        for($i = 0; $i < count($lists); $i++){
            $lists[$i]['spaces'] = [];
            for($j = 0; $j < count($spaces); $j++){
                if($lists[$i]['id'] == $spaces[$j]['list_id']){
                    array_push($lists[$i]['spaces'],$spaces[$j]);
                }
            }
        }
        //print_r($lists);
        return Inertia::render('Application/Mainboard', [
            'lists_arr' => $lists
        ]);
    }
}
