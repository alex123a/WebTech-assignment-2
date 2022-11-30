<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdoptionController extends Controller {
    public function create() {
        if(auth()->check()) {
            $name = auth()->user()->name;
            return view('adoptions.create', ["username" => $name]);
        } else {
            return redirect()->route("login");
        }
    }

    public function store(Request $request) {
        if(auth()->check()) {
            $validated = $request->validate([
                'name'        => ['required'],
                'description' => ['required'],
                'image'       => ['file', 'image']
            ]);


            $adoption = new Adoption();
            if ($request->has('image')) {
                $filename = Str::random(32) . "." . $request->file('image')->extension();
                $request->file('image')->move('imgs/uploads', $filename);
                $adoption->image_path = "imgs/uploads/$filename";
            }
            else
                $adoption->image_path = "imgs/demo/4.jpg";
            $adoption->name        = $validated['name'];
            $adoption->description = $validated['description'];
            $adoption->listed_by = auth()->id();
            // $adoption->listed_by()->associate(User::find(auth()->id()));
            $adoption->save();
            session()->put("success", "Post for ".$adoption->name." created successfully");
            return redirect()->route("home");
        } else {
            return redirect()->route("login");
        }

    }

    public function show(Adoption $adoption) {
        return view('adoptions.details', ['adoption' => $adoption]);
    }

    public function adopt(Adoption $adoption) {
        if (auth()->check()) {
            if (auth()->id() != $adoption["listed_by"]) {
                $adoption->adopted_by = auth()->id();
                $adoption->save();
                session()->put("message", "Pet ".$adoption->name." adopted successfully");
                return redirect()->home()->with('success', "Pet $adoption->name adopted successfully");
            } else {
                abort(403);
            }
        } else {
            return redirect()->route("login");
        }
    }


    public function mine() {
        if(auth()->check()) {
            $adoptions = Adoption::where("adopted_by", auth()->id())->get();
            return view('adoptions.list', ['adoptions' => $adoptions, 'header' => 'My Adoptions']);
        } else {
            return redirect()->route("login");
        }
    }
}
