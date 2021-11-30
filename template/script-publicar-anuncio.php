<script>
    function archivo(evt) {
        	var files = evt.target.files; // FileList object
             
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                document.getElementById("img_anuncio").value="";
            	alert("seleccione archivos de tipo imagen");
                return;
            }
             
            var reader = new FileReader();
             
            reader.onload = (function(theFile) {
            	return function(e) {
               // Insertamos la imagen
            document.getElementById("list").innerHTML = ['<div id="limpiar"><img id="img1" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/></div><div class="files-2"><input type="button" class="files-a button-img" onClick="limpiar();">'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
            	}

            }
    document.getElementById('img_anuncio').addEventListener('change', archivo, false);
  	

    function archivo2(evt2) {
        	var files = evt2.target.files; // FileList object
             
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
            	document.getElementById("img_anuncio2").value="";
                alert("seleccione archivos de tipo imagen");
                return;
            }
             
            var reader = new FileReader();
             
            reader.onload = (function(theFile) {
            	return function(e) {
               // Insertamos la imagen
            document.getElementById("list2").innerHTML = ['<div id="limpiar2"><img id="img2" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/></div><div class="files-2"><input type="button" class="files-a button-img" onClick="limpiar2();">'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
            	}
            }
             
    document.getElementById('img_anuncio2').addEventListener('change', archivo2, false);


    function archivo3(evt) {
        	var files = evt.target.files; // FileList object
             
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
            	document.getElementById("img_anuncio3").value="";
                alert("seleccione archivos de tipo imagen");
                return;
            }
             
            var reader = new FileReader();
             
            reader.onload = (function(theFile) {
            	return function(e) {
               // Insertamos la imagen
            document.getElementById("list3").innerHTML = ['<div id="limpiar3"><img id="img3" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/></div><div class="files-2"><input type="button" class="files-a button-img" onClick="limpiar3();">'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
            	}
            }
             
    document.getElementById('img_anuncio3').addEventListener('change', archivo3, false);
 
             
    </script>
    <script>
    function limpiar(){
	var d = document.getElementById("list");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	document.getElementById('img_anuncio').value = "";
	}
	function limpiar2(){
	var d = document.getElementById("list2");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	document.getElementById('img_anuncio2').value ="";
	}
	function limpiar3(){
	var d = document.getElementById("list3");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	document.getElementById('img_anuncio3').value ="";
	}
    </script>