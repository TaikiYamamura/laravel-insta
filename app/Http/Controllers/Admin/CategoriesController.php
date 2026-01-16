<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        $all_categories = $this->category->all();

        $uncategorized_count = Post::whereDoesntHave('categoryPost')->count();

        return view('admin.categories.index')->with('all_categories', $all_categories)->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id){
        // 入力データのバリデーション
        $request->validate([
            'name' => 'required|max:50'
        ]);

        // IDでカテゴリーを取得
        $category = $this->category->findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back();
    }

    public function destroy($id){
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
