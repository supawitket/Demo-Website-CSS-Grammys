function toggle(ID) {
	var el = document.getElementById(ID);
	if(el.style.display == 'none') {
		el.style.display = 'block';
	} else {
		el.style.display = 'none';
	}
}
function open_modal_window(URL) {
	var el = document.getElementById('modal_window');
	var frame = document.getElementById('modal_frame');

	if(el.style.display == 'none') {
		el.style.display = 'block';
		frame.src= URL;
	} else {
		el.style.display = 'none';
		iframe.src= '';
	}
}
function add(dupeSelect) {
	document.getElementById('nominees').appendChild(dupeSelect);
}
function del(key) {
	if(confirm('Are you sure to remove this nominee?') == true) {
		if(key.parentNode.parentNode.parentNode.removeChild(key.parentNode.parentNode)) {

		}else {
			alert('There was an error removing this activity');
		}
	}
}
function msg(txt, type) {
	document.getElementById('msg').innerHTML = '<div class="'+type+'">' + txt + '</div>';
	document.getElementById('msg').style.height = '40px';
}