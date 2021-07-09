<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\EducationalLevel;
use App\Models\School;
use Illuminate\Http\Request;

class ClasseController extends Controller
{

    public function search(Request $request)
    {
        $query = Classe::query();
        $filter = $request->input("filter");
        $text = $request->input("keyword");

        if(!empty($filter)){
            switch($filter){
                case "school_id":
                    $query->whereHas("school", function($query) use ($text){
                        $query->where("name", "LIKE", "%".$text."%");
                    });
                break;
                case "nivel_id":
                    $query->whereHas("level", function($query) use ($text){
                        $query->where("description", "LIKE", "%".$text."%");
                    });
                break;
                default :
                    $query->where($filter, "LIKE", "%".$text."%");
                break;
            }
        }

        return $query->paginate(10);
    }

    public function create()
    {
        return [
            "schools" => School::all(),
            "levels" => EducationalLevel::all()
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Classe::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseRequest $request)
    {
        Classe::create($request->all());

        return response()->json(["message" => "Added Class Successfully."], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        return $classe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseRequest $request, Classe $classe)
    {
        $classe->update($request->all());

        return response()->json(["message" => "Updated Class."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return response()->json(["message" => "Deleted Class."], 204);
    }
}
