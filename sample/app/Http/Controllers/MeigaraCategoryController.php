<?php

namespace App\Http\Controllers;

use App\Models\MeigaraCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MeigaraCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $text_category_name_part = request()->input("text_category_name_part");
        $data = MeigaraCategory::where("category_name","like","%{$text_category_name_part}%")->orderBy('created_at',"desc")->paginate(3);
        // $data = MeigaraCategory::all();
        return view("MeigaraCategory.index",['meigaraCategorys'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize("MeigaraCategory_create");
        return view("MeigaraCategory.create");
    }

    public function storeConfirm()
    {
        Gate::authorize("MeigaraCategory_create");
       
        return view("MeigaraCategory.storeConfirm");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Gate::authorize("MeigaraCategory_create");
        // $data = $request->all();
        $data = request()->validate([
            'category_name' => 'required',
        ],
        [
            'category_name.required' => '必須項目です。'
        ]);
        MeigaraCategory::create($data);
        return redirect()->route("MeigaraCategory.index")->with("message","登録しました");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MeigaraCategory  $meigaraCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MeigaraCategory $meigaraCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MeigaraCategory  $meigaraCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MeigaraCategory $meigaraCategory)
    {
        //
        Gate::authorize("MeigaraCategory_edit");
        return view("MeigaraCategory.edit",['meigaraCategory' => $meigaraCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MeigaraCategory  $meigaraCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeigaraCategory $meigaraCategory)
    {
        //

        Gate::authorize("MeigaraCategory_edit");
        // $data = $request -> all();
        $data = request()->validate([
            "category_name" => "required"
        ],
        [
            'category_name.required' => '必須項目です。'
        ]
        );
        $meigaraCategory->fill($data)->save();
        return redirect()->route("MeigaraCategory.edit",["meigaraCategory" => $meigaraCategory])->with("message","変更完了しました。");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MeigaraCategory  $meigaraCategory
     * @return \Illuminate\Http\Response
     */

    public function delete(MeigaraCategory $meigaraCategory)
    {
        //
        Gate::authorize("MeigaraCategory_delete");
        return view("MeigaraCategory.delete",["meigaraCategory" => $meigaraCategory]);

    } 
    public function destroy(MeigaraCategory $meigaraCategory)
    {
        //
        $data = request()->validate([
            'category_name' => 'required',
        ],
        [
            'category_name.required' => '必須項目です。'
        ]);
        Gate::authorize("MeigaraCategory_delete");
        $meigaraCategory -> delete();
        return redirect()->route("MeigaraCategory.index")->with("message","削除完了しました。");
    }
}
