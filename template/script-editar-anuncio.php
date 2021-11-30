<script>
    function archivo(evt) {
            var files = evt.target.files; // FileList object
             
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
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
    if(document.getElementById('img_anuncio')){
    document.getElementById('img_anuncio').addEventListener('change', archivo, true);
    }
    function archivo2(evt) {
        	var files = evt.target.files; 
             
            for (var i = 0, f; f = files[i]; i++) {

            if (!f.type.match('image.*')) {
            	continue;
            }
             
            var reader = new FileReader();
             
            reader.onload = (function(theFile) {
            	return function(e) {

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
            	continue;
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
    document.getElementById('img_anuncio').value ="";
    }
    function limpiar_edit(){
    var d = document.getElementById("list-preview");
    while (d.hasChildNodes())
    d.removeChild(d.firstChild);
    document.getElementById("list-preview").innerHTML=['<input type="hidden" value="<?php echo $reg_edit['codigo']-12345; ?>" name="d-img1">'];
	}
    function limpiar2_edit(){
    var d = document.getElementById("list2-preview");
    while (d.hasChildNodes())
    d.removeChild(d.firstChild);
    document.getElementById("list2-preview").innerHTML=['<input type="hidden" value="<?php echo $reg_edit['codigo']-23451; ?>" name="d-img2">'];
    }
	function limpiar2(){
	var d = document.getElementById("list2");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	document.getElementById('img_anuncio2').value ="";
	}
    function limpiar3_edit(){
    var d = document.getElementById("list3-preview");
    while (d.hasChildNodes())
    d.removeChild(d.firstChild);
    document.getElementById("list3-preview").innerHTML=['<input type="hidden" value="<?php echo $reg_edit['codigo']-34512; ?>" name="d-img3">'];
    }
	function limpiar3(){
	var d = document.getElementById("list3");
	while (d.hasChildNodes())
	d.removeChild(d.firstChild);
	document.getElementById('img_anuncio3').value ="";
	}
    </script>