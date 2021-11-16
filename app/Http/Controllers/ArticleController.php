<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{

    public function __construct()
    {
        // アクションに合わせたpolicyのメソッドで認可されていないユーザーはエラーを投げる
        $this->authorizeResource(Article::class, 'article');
    }

    public function top(Request $request)
    {
        return view('colorlib-search-1.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $caption = $request->caption;
        $category = $request->category;
        $status = $request->status;

        $query = Article::query();

        if (!empty($caption)) {

            $query->where('caption', 'like', '%' . $caption . '%');
        }

        if (!empty($category)) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', 'like', '%' . $category . '%');
            });
        }

        if (!empty($status)) {
            $query->whereHas('status', function ($q) use ($status) {
                $q->where('name', 'like', '%' . $status . '%');
            });
        }
        //N+1問題のため使用 本来無くてもINN_App内では動くがApi側で使う時はリレーションを定義したモデルがないためwithの中に入れる必要あり。
        $articles = $query->with('attachments','status')->paginate(30);
        $articles->appends(compact('caption', 'category', 'status'));

        $self_article = "";
        if (!empty(Auth::user())) {
            $self_article = Auth::user()->article;
        }

        // $articles = Article::all();
        // dd($articles);
        return view('articles.index', compact('articles', 'caption', 'self_article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        // Articleのデータを用意
        $article = new Article();
        $article->fill($request->all());

        // ユーザーIDを追加
        $article->user_id = $request->user()->id;

        // ファイルの用意
        $files = $request->file('file');

        DB::beginTransaction();

        try {
            // Article保存
            $article->save();

            // 画像ファイル保存
            $paths = [];
            foreach ($files as $file) {
                // get original name of file
                $name = $file->getClientOriginalName();
                // save files
                $path = Storage::putFile('articles', $file);
                if (!$path) {
                    throw new \Exception("保存に失敗しました");
                }
                $paths[] = $path;
                // set attachment info
                $attachment = new Attachment([
                    'article_id' => $article->id,
                    'org_name' => $name,
                    'name' => basename($path)
                ]);
                // save photo
                $attachment->save();
            }

            // commit
            DB::commit();
        } catch (\Exception $e) {

            // file rollback(delete files)
            if (!empty($paths)) {
                foreach ($paths as $path) {
                    Storage::delete($path);
                }
            }

            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // redirect view
        return redirect()->route('articles.index')->with(['notice' => '新しい記事を作成しました']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // Articleのデータを更新
        $article->fill($request->all());


        try {
            $article->save();
        } catch (\Exception $e) {
            back()->withErrors(['error' => '保存に失敗しました']);
        }
        return redirect(route('articles.index'))->with(['flash_message' => '更新が完了しました']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $paths = $article->image_paths;

        DB::beginTransaction();

        try {
            $article->delete(); //Article delete
            foreach ($paths as $path) {
                if (!Storage::delete($path)) {
                    throw new \Exception('ファイルの削除に失敗しました。');
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->getMessage());
        }
        return redirect()
            ->route('articles.index')
            ->with(['flash_message' => '削除が完了しました']);
    }

}