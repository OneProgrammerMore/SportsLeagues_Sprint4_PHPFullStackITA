<?php

namespace App\Livewire;

use App\Models\League;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\LeagueTypes;

class FetchLeagues extends Component
{

    public $leagues;
    public $nextCursor;
    public $hasMorePages;

    public function mount()
    {
        $this->leagues = new Collection;
        $this->loadLeagues();
    }

    public function loadLeagues()
    {
        if ($this->hasMorePages !== null && ! $this->hasMorePages) {
            return;
        }
        $leagues = League::cursorPaginate(3, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));
        
        $this->leagues->push(...$leagues->items());
        foreach($this->leagues as $league){
            $league_type = LeagueTypes::where('league_type_id', $league->league_type_id)->first()->league_type;
            $league['league_type'] = $league_type;
        }
        if ($this->hasMorePages = $leagues->hasMorePages()) {
            $this->nextCursor = $leagues->nextCursor()->encode();
        }
        $this->hasMorePages = $leagues->hasMorePages();

    }

    public function render()
    {
        return view('livewire.fetch-leagues')->with('leagues',$this->leagues);
    }
}
