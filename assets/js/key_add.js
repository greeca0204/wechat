KindEditor.ready(function(K) {
	var uploadbutton = K.uploadbutton({
		button : K('#upbtn')[0],
		fieldName : 'imgFile',
		url : '/editor/upload_mp3',
		afterUpload : function(data) {
			if (data.error === 0) {
				var url = K.formatUrl(data.url, 'absolute');
				K('#link2').val(url);
				//document.getElementById("favorites_pic").src=url;
			} else {
				alert(data.message);
			}
		},
		afterError : function(str) {
			alert('自定义错误信息: ' + str);
		}
	});
	uploadbutton.fileBox.change(function(e) {
		uploadbutton.submit();
	});
});
function show_text(){
	document.getElementById("textdiv").style.display="";
	document.getElementById("picdiv").style.display="none";
	document.getElementById("sounddiv").style.display="none";
	//document.getElementById("otherdiv").style.display="none";
	document.getElementById("body0").setAttribute("check","need");
	document.getElementById("toBox").removeAttribute("check");
	document.getElementById("body2").removeAttribute("check");
	document.getElementById("title2").removeAttribute("check");
	//document.getElementById("title3").removeAttribute("check");
	document.getElementById("link2").removeAttribute("check");
	//document.getElementById("link3").removeAttribute("check");
}
function show_pic(){
	document.getElementById("textdiv").style.display="none";
	document.getElementById("picdiv").style.display="";
	document.getElementById("sounddiv").style.display="none";
	//document.getElementById("otherdiv").style.display="none";
	document.getElementById("body0").removeAttribute("check");
	document.getElementById("toBox").setAttribute("check","need");
	document.getElementById("body2").removeAttribute("check");
	document.getElementById("title2").removeAttribute("check");
	//document.getElementById("title3").removeAttribute("check");
	document.getElementById("link2").removeAttribute("check");
	//document.getElementById("link3").removeAttribute("check");
}
function show_sound(){
	document.getElementById("textdiv").style.display="none";
	document.getElementById("picdiv").style.display="none";
	document.getElementById("sounddiv").style.display="";
	//document.getElementById("otherdiv").style.display="none";
	document.getElementById("body0").removeAttribute("check");
	document.getElementById("toBox").removeAttribute("check");
	document.getElementById("body2").setAttribute("check","need");
	document.getElementById("title2").setAttribute("check","need");
	//document.getElementById("title3").removeAttribute("check");
	document.getElementById("link2").setAttribute("check","need");
	//document.getElementById("link3").removeAttribute("check");
}
function show_other(){
	document.getElementById("textdiv").style.display="none";
	document.getElementById("picdiv").style.display="none";
	document.getElementById("sounddiv").style.display="none";
	//document.getElementById("otherdiv").style.display="";
	document.getElementById("body0").removeAttribute("check");
	document.getElementById("toBox").removeAttribute("check");
	document.getElementById("body2").removeAttribute("check");
	document.getElementById("title2").removeAttribute("check");
	//document.getElementById("title3").setAttribute("check","need");
	document.getElementById("link2").removeAttribute("check");
	//document.getElementById("link3").setAttribute("check","need");
}
var fromBoxArray = new Array();
var toBoxArray = new Array();
var selectBoxIndex = 0;
var arrayOfItemsToSelect = new Array();
function moveSingleElement() {
	var selectBoxIndex = this.parentNode.parentNode.id.replace(/[^\d]/g, '');
	var tmpFromBox;
	var tmpToBox;
	if (this.tagName.toLowerCase() == 'select') {
		tmpFromBox = this;
		if (tmpFromBox == fromBoxArray[selectBoxIndex]) tmpToBox = toBoxArray[selectBoxIndex];
		else tmpToBox = fromBoxArray[selectBoxIndex]
	} else {
		if (this.value.indexOf('>') >= 0) {
			tmpFromBox = fromBoxArray[selectBoxIndex];
			tmpToBox = toBoxArray[selectBoxIndex]
		} else {
			tmpFromBox = toBoxArray[selectBoxIndex];
			tmpToBox = fromBoxArray[selectBoxIndex]
		}
	}
	for (var no = 0; no < tmpFromBox.options.length; no++) {
		if (tmpFromBox.options[no].selected) {
			tmpFromBox.options[no].selected = false;
			tmpToBox.options[tmpToBox.options.length] = new Option(tmpFromBox.options[no].text, tmpFromBox.options[no].value);
			for (var no2 = no; no2 < (tmpFromBox.options.length - 1); no2++) {
				tmpFromBox.options[no2].value = tmpFromBox.options[no2 + 1].value;
				tmpFromBox.options[no2].text = tmpFromBox.options[no2 + 1].text;
				tmpFromBox.options[no2].selected = tmpFromBox.options[no2 + 1].selected
			}
			no = no - 1;
			tmpFromBox.options.length = tmpFromBox.options.length - 1
		}
	}
	/*
	for (var no = 0; no < tmpTextArray.length; no++) {
		var items = tmpTextArray[no].split('___');
		tmpFromBox.options[no] = new Option(items[0], items[1])
	}
	for (var no = 0; no < tmpTextArray2.length; no++) {
		var items = tmpTextArray2[no].split('___');
		tmpToBox.options[no] = new Option(items[0], items[1])
	}
	*/
}

function multipleSelectOnSubmit() {
	var ids = "";
	for (var no = 0; no < arrayOfItemsToSelect.length; no++) {
		var obj = arrayOfItemsToSelect[no];
		for (var no2 = 0; no2 < obj.options.length; no2++) {
			obj.options[no2].selected = true;
			ids += obj.options[no2].value;
			if(no2!=obj.options.length-1){
				ids += ",";
			}
		}
	}
	document.getElementById("body1").value = ids;
}
function createMovableOptions(fromBox, toBox, totalWidth, totalHeight, labelLeft, labelRight) {
	fromObj = document.getElementById(fromBox);
	toObj = document.getElementById(toBox);
	arrayOfItemsToSelect[arrayOfItemsToSelect.length] = toObj;
	fromObj.ondblclick = moveSingleElement;
	toObj.ondblclick = moveSingleElement;
	fromBoxArray.push(fromObj);
	toBoxArray.push(toObj);
	var parentEl = fromObj.parentNode;
	var parentDiv = document.createElement('div');
	parentDiv.className = 'multipleSelectBoxControl';
	parentDiv.id = 'selectBoxGroup' + selectBoxIndex;
	parentDiv.style.width = totalWidth+100 + 'px';
	parentDiv.style.height = totalHeight + 'px';
	parentEl.insertBefore(parentDiv, fromObj);
	var subDiv = document.createElement('div');
	subDiv.style.width = (Math.floor(totalWidth / 2) - 15) + 'px';
	fromObj.style.width = (Math.floor(totalWidth / 2) - 15) + 'px';
	var label = document.createElement('SPAN');
	label.innerHTML = labelLeft;
	subDiv.appendChild(label);
	subDiv.appendChild(fromObj);
	subDiv.className = 'multipleSelectBoxDiv';
	parentDiv.appendChild(subDiv);
	var subDiv = document.createElement('DIV');
	subDiv.style.width = (Math.floor(totalWidth / 2) - 15)+100 + 'px';
	toObj.style.width = (Math.floor(totalWidth / 2) - 15) + 'px';
	var label = document.createElement('SPAN');
	label.innerHTML = labelRight;
	subDiv.appendChild(label);
	subDiv.appendChild(toObj);
	parentDiv.appendChild(subDiv);
	toObj.style.height = (totalHeight - label.offsetHeight) + 'px';
	fromObj.style.height = (totalHeight - label.offsetHeight) + 'px';
	selectBoxIndex++
}