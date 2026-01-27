<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

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

    $popularPosts = Post::withCount(['likes', 'comments'])
      ->when($this->category, function ($query) {
        // カテゴリがある場合は絞る
        $query->whereHas('categories', function ($q) {
          $q->where('categories.id', $this->category->id);
        });
      })
      ->when($this->category === null, function ($query) {
        // Uncategorized
        $query->whereDoesntHave('categories');
      })
      ->where('created_at', '>=', now()->subDays(7))
      ->orderByRaw('(comments_count * 2 + likes_count) DESC')
      ->take(12)
      ->get();

    $usersQuery = User::query()
      ->whereHas('posts', function ($q) {
        if ($this->category) {
          $q->whereHas('categories', function ($c) {
            $c->where('categories.id', $this->category->id);
          });
        } else {
          $q->whereDoesntHave('categories');
        }
      })
      ->withCount(['posts as posts_count' => function ($q) {
        if ($this->category) {
          $q->whereHas('categories', function ($c) {
            $c->where('categories.id', $this->category->id);
          });
        } else {
          $q->whereDoesntHave('categories');
        }
      }])
      ->orderByDesc('posts_count');

    $users = $usersQuery->get();

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
