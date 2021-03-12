<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{

    public function create_rest(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'grade' => 'required',
                'phone_number' => 'required',
                'localization' => 'required',
                'website' => 'required',
                'hours' => 'required'
            ]
        );
        if ($validator->fails()) {
            return response('', 400);
        } else {

            $rest = new Restaurant;
            $rest->description = $request->description;
            $rest->grade = $request->grade;
            $rest->name = $request->name;
            $rest->phone_number = $request->phone_number;
            $rest->localization = $request->localization;
            $rest->website = $request->website;
            $rest->hours = $request->hours;

            $rest->save();

            return response('Created', 201);
        }
    }

    public function update_rest(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'grade' => 'required',
                'phone_number' => 'required',
                'localization' => 'required',
                'website' => 'required',
                'hours' => 'required'
            ],
        );
        if ($validator->fails()) {
            return response('', 400);
        } else {
            Restaurant::updateOrCreate(
                ['id' => $id],

                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'grade' => $request->grade,
                    'phone_number' => $request->phone_number,
                    'localization' => $request->localization,
                    'website' => $request->website,
                    'hours' => $request->hours,
                ]
            );

            return response('OK', 200);
        }
    }

    public function delete_rest($id)
    {
        $rest_check = Restaurant::where('id',$id)->exists();
        $rest = Restaurant::where('id',$id);
        if ($rest_check) {
            $rest->delete();
            return response('Deleted', 200);
        } else{
            return response('', 400);
        }
    }
}
