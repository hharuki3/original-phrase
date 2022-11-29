<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Group;
use App\Models\Phrase;
use App\Models\PhraseCategory;
use App\Models\UserGroup;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $phrases = Phrase::select('phrases.*')
            ->whereNull('deleted_at')
            ->where('user_id', '=', \Auth::id())
            ->orderBy('updated_at', 'DESC')
            ->get();
            // dd($phrases);
        return view('home', compact('phrases'));
    }

    public function create()
    {
        $categories = Category::where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
            // dd($categories);
        return view('create', compact('categories'));
    }


    public function store(Request $request)
    {
        $posts = $request->all();
        // dd($posts);
        DB::transaction(function() use($posts){
            $phrase_id = Phrase::insertGetId(['japanese' => $posts['japanese'], 'phrase' => $posts['phrase'], 
            'memo' => $posts['memo'], 'user_id' => \Auth::id()]);
            $category_exists = Category::where('user_id', '=', \Auth::id())->where('name', '=', $posts['new_category'])
                ->exists();
            //emptyは0も空扱いになるため、厳密に書くのであれば「|| $posts['new_category']===0」も追加
            if(!empty($posts['new_category'] && !$category_exists)){
                $category_id = Category::insertGetId(['name' => $posts['new_category'], 'user_id' => \Auth::id()]);
                PhraseCategory::insert(['phrase_id' => $phrase_id, 'category_id' => $category_id]);
            }
            if(!empty($posts['categories'][0])){
                foreach($posts['categories'] as $category){
                    PhraseCategory::insert(['phrase_id' => $phrase_id, 'category_id' => $category]);
                }
            }
        });

        return redirect(route('home'));
    }


    public function edit($id)
    {
        // dd($id);
        $phrases = Phrase::select('phrases.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $edit_phrase = Phrase::select('phrases.*', 'categories.id as category_id')
            ->leftJoin('phrase_categories', 'phrase_categories.phrase_id', '=', 'phrases.id')
            ->leftJoin('categories', 'phrase_categories.category_id', '=', 'categories.id')
            ->where('phrases.user_id', '=', \Auth::id())
            ->where('phrases.id', '=', $id)
            ->whereNull('phrases.deleted_at')
            ->get(); 
        $include_categories = [];
        foreach($edit_phrase as $phrase){
            array_push($include_categories, $phrase['category_id']);
        }
        $categories = Category::select('categories.*')->where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        // dd($phrases);
        return view('edit', compact('phrases', 'edit_phrase', 'include_categories', 'categories'));
    }


    public function update(Request $request)
    {
        $posts = $request->all();
        // dd($posts);
        DB::transaction(function() use($posts){
            Phrase::where('id', '=', $posts['phrase_id'])
                ->update(['japanese' => $posts['japanese'], 'phrase' => $posts['phrase'], 'memo' => $posts['memo']]);
            PhraseCategory::where('phrase_id', '=', $posts['phrase_id'])->delete();
            foreach($posts['categories'] as $category){
                PhraseCategory::insert(['phrase_id' => $posts['phrase_id'], 'category_id' => $category]);
            }
            $category_exists = Category::where('user_id', '=', \Auth::id())->where('name', '=', $posts['new_category'])
                ->exists();
            //emptyは0も空扱いになるため、厳密に書くのであれば「|| $posts['new_category']===0」も追加
            if(!empty($posts['new_category'] && !$category_exists)){
                $category_id = Category::insertGetId(['name' => $posts['new_category'], 'user_id' => \Auth::id()]);
                PhraseCategory::insert(['phrase_id' => $posts['phrase_id'], 'category_id' => $category_id]);
            }

        });
        return redirect(route('home'));
    }


    public function detail($id)
    {
        $edit_phrase = Phrase::select('phrases.*', 'categories.id as category_id')
            ->leftJoin('phrase_categories', 'phrase_categories.phrase_id', '=', 'phrases.id')
            ->leftJoin('categories', 'phrase_categories.category_id', '=', 'categories.id')
            ->where('phrases.user_id', '=', \Auth::id())
            ->where('phrases.id', '=', $id)
            ->whereNull('phrases.deleted_at')
            ->get(); 
            // dd($edit_phrase);

        $categories = Category::where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
            // dd($categories);
        return view('detail', compact('edit_phrase', 'categories'));
    }

    public function destroy(Request $request)
    {
        $posts = $request->all();
        // dd($posts);
        Phrase::where('id', $posts['phrase_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect(route('home'));
    }


}
