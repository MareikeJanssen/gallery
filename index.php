<!DOCTYPE html>
<html>
    <head>
        <title>picture gallery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/gallery.js"></script>
    </head>
	
	
	<?php
		# paths to the images
		$pathimg = 'img/';
		$paththumb = 'thumbs/';
		# allowed file extensions
		$extensions = array('jpg', 'gif', 'png', 'jpeg');
		$images = [];
		$file = '';
		$counter = -1;

		# if directory does not exist, then abort script
		if (!is_dir($paththumb)) {
			die('Leider wurde das Verzeichnis nicht gefunden!</div></body></html>');
		}

		# open directory and set pointers to the beginning
		$pointer = opendir($paththumb);
 
		while ($file = readdir($pointer)) { 

			# exclude points and subdirectories
			if (is_file($paththumb . $file)) {
				$counter++;
				# determine the file transfer and convert it into lowercase
				$extention = strtolower(pathinfo($file, PATHINFO_EXTENSION));

				# proof, if the file has an allowed extension
				if (in_array($extention, $extensions) ) {

					if(is_file($paththumb.$file)) {
						//TODO: generalization for all kind of name structure
						# requires files with the following name build: abc_abc1.extension
						$alt = explode('.', $file);
						$altarray = explode('_', $alt[0]);
						$altstring = '';
						for($i=0; $i<count($altarray); $i++){
							if($i!==0){
								$altstring .= ' ';
							}
							$altstring .= $altarray[$i];
						}
						array_push($images, ['src'=>$pathimg, 'thumb'=>$paththumb, 'file'=>$file, 'alt'=>$altstring, 'key'=>$counter]);
					}
				}
			}
		}

		# close path, release pointer
        closedir($pointer);
    ?>
	
	
    <body>
        <div id="gallery">
            <section id="bigsect">
				<div id="bigpicbox">
					<?php
						# output of the first image in the folder
						echo '
							<img 
								id="bigpicture" 
								src="'.$images[0]['src'].$images[0]['file'].'" 
								title="'.$images[0]['alt'].'" 
								alt="'.$images[0]['alt'].'">';
						echo '
							<div id="subtitle">'.$images[0]['alt'].'</div>';
					?>
				</div>
				<div class="buttonbox left" onclick="backward()">
					<div class="circle">
						<img id="back" src="buttons/arrowLeft.jpg">
					</div>
				</div>
				<div class="buttonbox right">
					<div class="circle" onclick="forward()">
						<img id="forth" src="buttons/arrowRight.jpg" >
					</div>
				</div>
            </section>
			
			<section id="thumbwrapper">
				<div id="thumbs">
					<ul id="thumblist">
						<?php
							# output of all images contained in the folder
							foreach($images as $key => $value){
								$thumbclass = 'thumbimg';
								if($key===0){
									$thumbclass = 'current thumbimg';
								}
									echo 
									'<li>
										<img 
											id="img'.$key.'"
											class="'.$thumbclass.'"
											src="'.$value['thumb'].$value['file'].'" 
											title="'.$value['alt'].'" 
											alt="'.$value['alt'].'"
											onclick="showPic('.$key.')">
									</li>';
							}
						?>
					</ul>
				</div>
				<div class="buttonbox left">
					<div class="circle" onclick="thumbsBackward()">
						<img id="backthumbs" src="buttons/arrowLeft.jpg">
					</div>
				</div>
				<div class="buttonbox right">
					<div class="circle" onclick="thumbsForward()">				
						<img id="forththumbs"src="buttons/arrowRight.jpg">
					</div>
				</div>
			</section>
        </div>		
    </body>
</html>
