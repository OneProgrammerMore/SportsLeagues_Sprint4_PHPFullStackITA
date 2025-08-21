<?php

namespace App\View\Components\Players;

use App\Models\League;
use App\Models\Players;
use App\Models\Team;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowPlayersMinInfo extends Component
{
    public $leagueId;

    public $teamId;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $leagueId = null, ?string $teamId = null)
    {
        //
        $this->leagueId = $leagueId;
        $this->teamId = $teamId;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        if ($this->leagueId == null or $this->teamId == null) {
            return '';
        }

        $players = Players::where('team_id', $this->teamId)->get();
        $league = League::find($this->leagueId);
        $team = Team::find($this->teamId);

        return view('components.players.show-players-min-info', ['players' => $players, 'league' => $league, 'team' => $team]);
    }
}
