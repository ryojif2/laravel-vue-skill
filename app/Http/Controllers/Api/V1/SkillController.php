<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SkillResource;

class SkillController extends Controller
{
    public function index(){
        return SkillResource::collection(Skill::all());
        // $skills = Skill::all();
        // return $skills;
       
    }

     public function show(Skill $skill) {
        
        return new SkillResource($skill);
        // return $skill;
    }


    public function store(Request $request) {

        $request->validate([
            'name' => 'required|min:3|max:20',
            'slug' => 'required|unique:skills,slug'
        ]);

        Skill::create($request -> all());

        return response()-> json("Skill Created!");
    }

      public function update(Request $request, Skill $skill) {
        
        $request->validate([
            'name' => 'required|min:3|max:20',
            'slug' => 'required|unique:skills,slug'
        ]);

        $skill->update($request->all());

        return response()-> json("Skill Updated!");
    }

     public function destroy(Skill $skill) {
        
        $skill->delete();

        return response()-> json("Skill Deleted!");
    }
}