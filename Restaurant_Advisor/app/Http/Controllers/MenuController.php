<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;

class MenuController extends Controller
{
    public function create_menu(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response('', 400);
        } else {

            $menu = new Menu;

            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->name = $request->name;
            $menu->restaurant_id = $id;

            $menu->save();

            return response('Created', 201);
        }
    }
    public function update_menu(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response('', 400);
        } else {
            Menu::updateOrCreate(
                ['id' => $id],

                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                ]
            );

            return response('OK', 200);
        }
    }
    public function delete_menu($id)
    {
        $menu_check = Menu::where('id',$id)->exists();
        $menu = Menu::where('id',$id);
        if ($menu_check) {
            $menu->delete();
            return response('Deleted', 200);
        } else{
            return response('', 400);
        }
    }
}
