<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Post;

class CategoryShow extends Component
{
    use WithPagination;

    public ?Category $category = null; // null 許容
    public $activeTab = 'posts';
    public $sortPosts = 'latest';
    public $sortUsers = 'post_count_desc';

    protected $paginationTheme = 'bootstrap';

public function mount($category)
{
    if ($category instanceof Category) {
        $this->category = $category;
    } elseif ($category === null || $category === 'uncategorized') {
        $this->category = null;
    } else {
        $this->category = Category::findOrFail($category); // ここでIDをモデル化
    }

    $this->activeTab = request()->get('tab', 'posts');
}


    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

public function render()
{
    // 投稿一覧
    $postsQuery = $this->category
        ? $this->category->posts()
        : Post::whereDoesntHave('categoryPost');

    $posts = $postsQuery->orderBy('posts.created_at', 'desc')->paginate(12);

    $popularPosts = (clone $postsQuery)
        ->withCount(['likes', 'comments'])
        ->where('posts.created_at', '>=', now()->subDays(7))
        ->orderByRaw('(likes_count * 2 + comments_count) DESC')
        ->take(12)
        ->get();

    $users = collect(); // 一旦空でOK

    // 全カテゴリ + Uncategorized
    $allCategories = Category::all();
    
    return view('livewire.category.category-show', [
        'posts' => $posts,
        'popularPosts' => $popularPosts,
        'users' => $users,
        'categories' => $allCategories,
    ]);
}

}
