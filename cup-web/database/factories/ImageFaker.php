<?php
namespace Database\Factories;

class ImageFaker{
    public $examplesImagePath = '';
    public $inputFilesPath = '/storage/app/examples/leagues/';
    public $outputPath = '/storage/app/public';
    
    public $infix = '';
    public $fileName = '';


    public function __construct($examplesImagePath, $inputFilesPath, $outputPath, $infix) {
        $this->examplesImagePath = $examplesImagePath;
        $this->inputFilesPath = base_path().$inputFilesPath;
        $this->outputPath = $outputPath;
        $this->infix = $infix;

        # List Items in Path with available extension
        $files = glob($this->inputFilesPath.'*.png');

        # Select a random image
        $key = array_rand($files);
        $file = $files[$key];

        # Return Name of the image
        $this->fileName = $file;
        
        # Store the image in the outputPath
        $image = file_get_contents($this->fileName);
        file_put_contents(base_path().$this->outputPath.$this->infix.basename($this->fileName), $image);
    }

    public function getImageName() {
        return 'public/imgs/'.$this->infix . basename($this->fileName);
    }



}