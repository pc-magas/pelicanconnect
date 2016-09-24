<?php

namespace AppBundle\Helpers;

use Doctrine\ORM\Query;

class PaginatorHelper 
{
	/**
	 * Method that applies Pagination to a Query
	 * @param Query $q
	 * @param unknown $page
	 * @param unknown $limit
	 */
	public static function paginateQuery(Query $q,$page,$limit)
	{
		$page=(int)$page;
		$limit=(int)$limit;
		
		$page=$page*$limit;
		
		
		
	}
	
}