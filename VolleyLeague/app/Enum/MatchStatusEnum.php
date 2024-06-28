<?php 
namespace App\Enum;

enum MatchStatusEnum:string
{
	case PENDING = 'Pending';
	case ONGOING = 'Ongoing';
	case FINISHED = 'Finished';
	case CANCELED = 'Canceled';
}
