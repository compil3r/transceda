$('#fotoDaHistoria').click(function() {
    $('#tipo').val('1');
    $('#files').click();
});

$('#fotoDePerfil').click(function() {
    $('#tipo').val('2');
    $('#files').click();
});

$('.teste').on('click',function(){$('.collapse').collapse('hide');})




// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});


  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes. </li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';

  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  
$("#confirme").blur(function(){
	if ($("#senha").val()!=$("#confirme").val()){
		document.getElementById('s').innerHTML='Senhas precisam ser iguais!';
	}
	if ($("#senha").val() == $("#confirme").val()){
		$("#s").empty();
	}
	
});


// convert bytes into friendly format
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};


// update info by cropping (onChange and onSelect events handler)
function updateInfo(e) {
    $('#x').val(e.x);
    $('#y').val(e.y);
    $('#w').val(e.w);
    $('#h').val(e.h);
};

// clear info by cropping (onRelease event handler)
function clearInfo() {
    $('.info #w').val('');
    $('.info #h').val('');
};

// Create variables (in this scope) to hold the Jcrop API and image size
var jcrop_api, boundx, boundy;
function fotoHistoria() {
    if ($('#btnFotoPerfil').length) {
        $('#btnFotoPerfil').hide();
    }
    if (!$('#btnFotoHistoria').length) {
    $('#botao-final').append("<input form=\"formHistoria\" type=\"submit\" onclick=\"enviarForm();\" id=\"btnFotoHistoria\" class=\"btn btn-primary\" data-dismiss=\"modal\" value=\"Salvar\">");
    }

    fileSelectHandler();
}


function enviarForm() {
    $('#formHistoria').submit();
}

function fileSelectHandler() {
    $('#modal1').modal('show');
    // get selected file
    var oFile = $('#files')[0].files[0];
    if (oFile == undefined) {
        oFile = $('.tFotoPerfil')[0].files[0];
    }

    // hide all errors
    $('.error').hide();

    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        $('.error').html('Please select a valid image file (jpg and png are allowed)').show();
        return;
    }


    // preview element
    var oImage = document.getElementById('preview');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler

            // display step 2
            $('.step2').fadeIn(500);

            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            $('#filesize').val(sResultFileSize);
            $('#filetype').val(oFile.type);
            $('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);

            // destroy Jcrop if it is existed
            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
                $('#preview').width(oImage.naturalWidth);
                $('#preview').height(oImage.naturalHeight);
            }

            setTimeout(function(){
                // initialize Jcrop
                $('#preview').Jcrop({
                    minSize: [32, 32], // min crop size
                    aspectRatio : 1, // keep aspect ratio 1:1
                    bgFade: true, // use fade effect
                    bgOpacity: .3, // fade opacity
                    onChange: updateInfo,
                    onSelect: updateInfo,
                    onRelease: clearInfo
                }, function(){

                    // use the Jcrop API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];

                    // Store the Jcrop API in the jcrop_api variable
                    jcrop_api = this;
                });
            },3000);

        };
    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}


