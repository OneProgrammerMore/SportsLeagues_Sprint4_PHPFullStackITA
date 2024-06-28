<?php 
namespace App\Enum;

enum LeagueStatusEnum:string
{
	case WAITING = 'Waiting';
	case ONGOING = 'Ongoing';
	case FINISHED = 'Finished';
	case CANCELED = 'Canceled';
}
