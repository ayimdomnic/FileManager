<?php

namespace Ayim\FileManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Ayim\MediaLibrary\MediaRepository;
use Ayim\MediaLibrary\Services\CheckExistence;


class DuplicateCommand extends Command
{

	//get the first instance of the command
	//enable the search protocal
	//get the file to be duplicated 
	//duplicate and add -copy to the name string
	//return a sucess or throw an exception
	protected $signature = 'medialibaray::duplicatefile
			{--all : Copy All the contents of the file }';


	protected $description = 'Duplicate an existing file by either copying only the file or checking every other form of it';


	protected $MediaLibrary;

	protected $service;


	public function __construct(MediaRepository $mediaRepository, CheckExistence $service)
	{
		$this->repository = $mediaRepository;

		$this->service = $repository;
	}


	public function handle()
	{
		$this->cannotBeId() ;

		try{

		}catch($e){
			
		}


}