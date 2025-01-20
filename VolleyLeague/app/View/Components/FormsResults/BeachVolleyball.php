<?php

namespace App\View\Components\FormsResults;

use App\Models\Matchy;
use App\Models\Results\ResultsBeachVolleyball;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BeachVolleyball extends Component
{
    public $matchId = null;

    public $match_results = null;

    /**
     * Create a new component instance.
     */
    public function __construct($matchId = null)
    {
        //
        $this->matchId = $matchId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->matchId != null) {
            // $this->match_results = Matchy::find($this->matchId);
            $this->match_results = ResultsBeachVolleyball::where('match_id', $this->matchId)->first();
        } else {
            $this->match_results = null;
        }

        return view('components.forms-results.beach-volleyball', ['match_results' => $this->match_results]);
    }
}
