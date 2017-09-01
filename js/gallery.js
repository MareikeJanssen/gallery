var i = 0;
var currentThumb = 0;
var imgs = [];

// object for images
function Pic( mediathumb, mediatitle, mediaalt, counter) {
	this.src = mediathumb.replace(
		'thumbs/',
		'img/'
	);
	this.thumb = mediathumb;
	this.title = mediatitle;
	this.alt = mediaalt; 
	this.key = counter;
};

// generates a new Pic-object for each image of page and push it to imgs
function getImgs(){
	var thumbImgs = $('.thumbimg');
	
	for (var y=0; y<thumbImgs.length; y++) {
		
		var thumb = thumbImgs[y].src;
		var title = thumbImgs[y].title;
		var alt = thumbImgs[y].alt;
		var key = y;
		
		var newImg = new Pic(thumb, title, alt, key);
		imgs.push(newImg);
	}
};

// proofs, if at least one image exists
function isImgs(){
	if( imgs.length>0 ){
		return true;
	}
	return false;
};

// shows next image
function forward() {
	if(isImgs()){
		if (i == imgs.length-1) {
			i = -1;
		}
		i++;
		// output
		showPic(i);
	}
	
};

// shows previous image
function backward() {
	if(isImgs()){
		if (i == 0) {
			i = imgs.length;
		}
		i--;
		// output
		showPic(i);
	}
};

// shows current image
function showPic(piccount) {
	if(isImgs()){
		i = piccount;
		
		$('#bigpicture').attr('src', imgs[i].src);
		$('#bigpicture').attr('title', imgs[i].title);
		$('#bigpicture').attr('alt', imgs[i].alt);
		$('#subtitle').text(imgs[i].title);
		sortThumbs(currentThumb);
	}
};

// moves thumbs forward
function thumbsForward(){
	if(isImgs()){
		if(currentThumb==imgs.length-1){
			currentThumb = -1;
		}
		currentThumb++;
		sortThumbs(currentThumb);
	}
};

// moves thumbs backward
function thumbsBackward(){
	if(isImgs()){
		if (currentThumb == 0) {
			currentThumb = imgs.length;
		}
		currentThumb--;
		sortThumbs(currentThumb);
	}
};

// sorts thumbs in right direction
function sortThumbs(thumbcount){
	if(isImgs()){
		var m = 0;
		
		for(var k=thumbcount; k<imgs.length; k++){
			showThumb(m, k);
			m++;
		}
		for(var l=0; l<thumbcount; l++){
			showThumb(m, l);
			m++;
		}
	}
};

// shows one thumb and assigns a class
function showThumb(id, c){
	if(isImgs()){
		if(c!==i){
			$('#img'+id).attr('class','thumbimg');
		}else{
			$('#img'+id).attr('class','current thumbimg');
		}
		$('#img'+id).attr('src', imgs[c].thumb);
		$('#img'+id).attr('title', imgs[c].title);
		$('#img'+id).attr('alt', imgs[c].alt);
		$('#img'+id).attr('onClick', 'javascript: showPic('+c+');');
	}
};

$(document).ready(function(){
	getImgs();
});