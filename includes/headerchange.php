<?php header('Conent-type: application/json'); ?>
<?php    
    $filename = "../".$_GET['img'];

        $luminance = getLuminance($filename,10);

        if ($luminance > 100) {
            echo json_encode("#242424");
        } else {
            echo json_encode("#e4e4e4");
        }

    function getLuminance($filename, $num_samples=10) 
    {
        $img = imagecreatefromjpeg($filename);

        $width = imagesx($img);
        $height = imagesy($img);

        $x_step = intval($width/$num_samples);
        $y_step = intval($height/$num_samples);

        $total_lum = 0;

        $sample_no = 1;

        for ($x=0; $x<$width; $x+=$x_step) {
            for ($y=0; $y<$height; $y+=$y_step) {

                $rgb = imagecolorat($img, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $lum = ($r+$r+$b+$g+$g+$g)/6;

                $total_lum += $lum;

                $sample_no++;
            }
        }

        $avg_lum  = $total_lum/$sample_no;

        return $avg_lum;
    }
?>