<?php

namespace App\Http\Livewire;
use Illuminate\Support\Str;
use Livewire\Component;
// use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post;

class PostComponent extends Component
{
    public $title,$slug,$posts;

    public function render()
    {
        $this->posts=Post::all();
        return view('livewire.post-component');
    }

    public function updatedTitle()
    {
        // $this->slug = SlugService::createSlug(Post::class, 'slug', $this->title);

        if (Post::whereSlug($this->slug = Str::slug($this->title))->exists()) {
            $count = Post::whereRaw("slug RLIKE '^{$this->slug}(-[0-9]+)?$'")->count();
            $this->slug = $count ? "{$this->slug}-{$count}" : $this->slug;
        }
        return $this->slug;
    }

    public function store()
    {
        $data=$this->validate([
            'title' => 'required|string',
            'slug'  => 'required|distinct'
        ]);
        Post::create($data);
        $this->title = '';
        $this->slug = '';
    }
}
