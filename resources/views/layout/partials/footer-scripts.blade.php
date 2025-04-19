
<script src="{{ asset('assets/js/app.js') }}"></script>
@php 
$path=Request::path();

$dir_path = public_path().'/assets/js/'.$path;
if (is_dir($dir_path))
{
   
   $directory = new DirectoryIterator($dir_path);
   
   // Loop runs while directory is valid
   while ($directory->valid()) {
      
    // Check the file is not directory
    if (!$directory->isDir()) {
          
        // Display the filename
        //echo $directory->getFilename() . "<br>";
        $filename=url('assets/js/'. $path .'/'.$directory->getFilename());
        echo '<script src="'.$filename.'"></script>';
    }
  
    // Move to the next element
    $directory->next();
   }
}
@endphp
