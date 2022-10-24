<?php

namespace App\Http\Controllers\ClinicalPathway;

use App\Models\ClinicalPathway\Article;
use App\Models\ClinicalPathway\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->get('category');

        if ($category) {
            // Get articles in the category
            $articles = Article::whereHas('categories', function ($query) use (&$category) {
                $query->where('slug', $category);
            })->orderBy('created_at', 'DESC')->get();
        } else {
            $articles = Article::orderBy('created_at', 'DESC')->get();
        }
        
        return view('clinical-pathways.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinical-pathways.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $article = Article::create($input);

        $categories_str = $request->input('categories');
        $category_names = explode(',', $categories_str);
        $categories = array();

        foreach ($category_names as $name) {
            if (trim($name) !== '') {
                $css_classes = array('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark');
                $category = Category::updateOrCreate(
                    [
                        'slug' => str_slug($name, '-')
                    ],
                    [
                        'name' => strtolower(trim($name)),
                        'css_class' => $css_classes[array_rand($css_classes)]
                    ]
                );
                array_push($categories, $category->id);
            }
        }

        $article->categories()->sync($categories);
        $article->files()->sync($request->input('files'));

        return redirect('/clinical-pathways/' . $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClinicalPathway\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // Increment view count
        $article->increment('views');

        // Related articles
        $related_articles = Article::where('icd10_id', $article->icd10_id)
            ->where('id', '!=', $article->id)
            ->get();

        return view('clinical-pathways.show', [
            'article' => $article,
            'related_articles' => $related_articles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClinicalPathway\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('clinical-pathways.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClinicalPathway\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        $categories_str = $request->input('categories');
        $category_names = explode(',', $categories_str);
        $categories = array();

        foreach ($category_names as $name) {
            if (trim($name) !== '') {
                $css_classes = array('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark');
                $category = Category::updateOrCreate(
                    [
                        'slug' => str_slug($name, '-')
                    ],
                    [
                        'name' => strtolower(trim($name)),
                        'css_class' => $css_classes[array_rand($css_classes)]
                    ]
                );
                array_push($categories, $category->id);
            }
        }

        $article->categories()->sync($categories);
        $article->files()->sync($request->input('files'));

        return redirect('/clinical-pathways/' . $article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClinicalPathway\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/clinical-pathways');
    }
}
