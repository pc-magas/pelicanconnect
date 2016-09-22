<?php

namespace AppBundle\Interfaces;

interface CrudManagerInterface 
{
	/**
	 * Method to add something into the database
	 * @param array $dataToAdd All the required data to add into the database
	 */
	public function add(array $dataToAdd);
	
	/**
	 * Method that update data into the database
	 * @param array $changedData The data that are needed in order to update the entries into the db
	 */
	public function edit(array $changedData);
	
	/**
	 * Method that deletes record from the database
	 * @param array $changedData Alll the data we need in order to determine what are the entries we need to delete 
	 */
	public function delete(array $changedData);
	
	/**
	 * Method that performs any sort of serching
	 * 
	 * @param array $searchParams Parameters that needed to perform the search.
	 * @param int $page The page we want to fetch.
	 * @param int $limit The limit that is needed in order to perform this task.
	 * 
	 */
	public function search(array $searchParams,$page,$limit);
}