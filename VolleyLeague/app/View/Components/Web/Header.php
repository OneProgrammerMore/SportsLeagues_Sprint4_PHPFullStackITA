<?php

namespace App\View\Components\Web;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\League;

class Header extends Component
{
	
	public  $leagueId;
    /**
     * Create a new component instance.
     */
    public function __construct($leagueId = null)
    {
        //
        $this->leagueId = $leagueId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if($this->leagueId == null){
			 return view('components.web.header-home');
		}else{
			$league = League::find($this->leagueId);
			return view('components.web.header', ['league' => $league]);
		}
        
        
       
    }
}
