<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\League;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;

class FetchLeagues extends Component
{
	/*
    public function render()
    {
        return view('livewire.fetch-leagues');
    }*/
    
    
    public $posts;  //TODO - Change variable name to leagues
    public $nextCursor;
    public $hasMorePages;

    public function mount()
    {
        $this->posts = new Collection();

        $this->loadLeagues();
    }

    public function loadLeagues()
    {
        if ($this->hasMorePages !== null  && ! $this->hasMorePages) {
            return;
        }

        $posts = League::cursorPaginate(2, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));

        $this->posts->push(...$posts->items());

        if ($this->hasMorePages = $posts->hasMorePages()) {
            $this->nextCursor = $posts->nextCursor()->encode();
        }
    }

    public function render()
    {
        //return view('livewire.infinite-post-listing')->layout('layouts.base');
        //return view('livewire.fetch-leagues')->layout('layouts.base');
        return view('livewire.fetch-leagues')->layout('layouts.mylayout');
    }
    
    
    
}
