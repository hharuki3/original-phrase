<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Memo;
use App\Models\Category;
use App\Models\Group;
use App\Models\Phrase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*', function($view){

            $query_category = \Request::query('category');
            // dd($query_category);
            if(!empty($query_category)){

                $phrases = Phrase::select('phrases.*')
                    ->leftJoin('phrase_categories', 'phrase_categories.phrase_id', '=', 'phrases.id')
                    ->where('phrase_categories.category_id', '=', $query_category)
                    ->whereNull('deleted_at')
                    ->where('user_id', '=', \Auth::id())
                    ->orderBy('updated_at', 'DESC')
                    ->get();

                
            }else{
                $phrases = Phrase::select('phrases.*')
                    ->whereNull('deleted_at')
                    ->where('user_id', '=', \Auth::id())
                    ->orderBy('updated_at', 'DESC')
                    ->get();

            }
            $randoms = range(0,count($phrases)-1);
            shuffle($randoms);
            
            $categories = Category::where('user_id', '=', \Auth::id())
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get();

            $phrase_exists = Phrase::where('user_id', '=', \Auth::id())
                ->whereNull('deleted_at')
                ->exists();
            
            

            $view->with('phrases', $phrases)
                ->with('categories', $categories)
                ->with('phrase_exists', $phrase_exists)
                ->with('randoms', $randoms);

        });
    }
}
