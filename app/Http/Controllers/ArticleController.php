<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Traits\FlashAlert;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use FlashAlert;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(10);
        return view('pages.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string',],
            // 'published' => ['required'], dikomen saja karena user saat edit tidak melakukan published atau unpublished
        ]);

        request()->user()->articles()->create($request->all());

        return redirect()->route('article.index')->with($this->alertCreated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $article = Article::findOrFail($id);

            if (
                request()->user()->hasRole(['superadmin', 'admin']) ||
                request()->user()->isAbleToAndOwns('articles-update', $article)
            ) {
                // apabila user yang sedang login adalah superadmin, admin atau user yang memiliki permission untuk update article maka akan ke halaman edit article (sama dengan method update dan destroy)
                return view('pages.article.edit', compact('article'));
            } else {
                // jika tidak akan diredirect ke halaman article.index dengan pesan permissionDenied yang sudah kita definisikan didalam flashAlert.php
                return redirect()->route('article.index')->with($this->permissionDenied());
            }


        } catch (ModelNotFoundException $e) {
            return redirect()->route('article.index')->with($this->alertNotFound());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);

            if (
                request()->user()->hasRole(['superadmin', 'admin']) ||
                request()->user()->isAbleToAndOwns('articles-update', $article)
            ) {
                $this->validate($request, [
                    'title' => ['required', 'string', 'max:255'],
                    'body' => ['required', 'string',],
                ]);

                $article->update($request->all());

                return redirect()->route('article.index')->with($this->alertUpdated());
            } else {
                return redirect()->route('article.index')->with($this->permissionDenied());
            }


        } catch (ModelNotFoundException $e) {
            return redirect()->route('article.index')->with($this->alertNotFound());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            if (
                request()->user()->hasRole('superadmin') ||
                request()->user()->isAbleToAndOwns('articles-delete', $article)
            ) {
                $article->delete();

                return redirect()->route('article.index')->with($this->alertDeleted());
            } else {
                return redirect()->route('article.index')->with($this->permissionDenied());
            }


        } catch (ModelNotFoundException $e) {
            return redirect()->route('article.index')->with($this->alertNotFound());
        }
    }
}