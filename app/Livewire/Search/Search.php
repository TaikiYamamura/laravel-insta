<?php

namespace App\Livewire\Search;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class Search extends Component
{
    public $query;
    public $users = [];
    public $posts = [];
    public $categories = [];

    public function mount($query = '')
    {
        $this->query = $query;
        $this->search();
    }

    public function search()
    {
        if (!$this->query) {
            $this->users = collect();
            $this->posts = collect();
            $this->categories = collect();
            return;
        }

        $q = $this->query;
        $this->users = User::where('name', 'like', "%$q%")->take(10)->get();
        $this->posts = Post::where('description', 'like', "%$q%")->take(10)->get();
        $this->categories = Category::where('name', 'like', "%$q%")->take(10)->get();
    }

    public function render()
    {
        return view('livewire.search.search');
    }
}
?>