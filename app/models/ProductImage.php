<?php

class ProductImage extends Eloquent {

    const IMAGE_UNAVAILABLE_DIRECTORY =  'assets/product/unavailable/';
    
    const IMAGE_UNAVAILABLE_FILE =  'unavailable_product_img.jpg';
    
    const DEFAULT_IMAGE_DIRECTORY = 'assets/product/default/';
    
    const DEFAULT_IMAGE_FILE = 'default_product_img.jpg';

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_product_image';

   /*
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_product_image';
    
    public $timestamps = false;   
       
    protected $appends = array('filename', 'directory');
    

    public function product()
    {
        return $this->belongsTo('Product', 'id_product', 'product_id');
    }

    public function getFilenameAttribute()
    {
        $productImagePath = $this->product_image_path;
        $filename = '';
        if(trim($productImagePath) === ''){
            $filename = self::DEFAULT_IMAGE_FILE;
        }
        else{
            $reversedPath = strrev($productImagePath);
            $filename = substr($productImagePath,strlen($reversedPath)-strpos($reversedPath,'/'),strlen($reversedPath));
        }    
        return $filename;   
    }
    
    public function getDirectoryAttribute()
    {
        $productImagePath = $this->product_image_path;
        $directory = '';        
        if(trim($productImagePath) === ''){
            $directory = self::DEFAULT_IMAGE_DIRECTORY;
        }
        else{
            $reversedPath = strrev($productImagePath);
            $directory = substr($productImagePath,0,strlen($reversedPath)-strpos($reversedPath,'/'));
        }    
        return $directory;
    }
    
}
