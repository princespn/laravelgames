@extends('layouts.user_type.admin-app')
@section('content')
<style>
.upload-progress{
    height: 6px;
    background-color: #3c56c3;
    overflow: hidden;
    border: 1px solid #3c56c3;
    margin: 5px 0;

}

div#filelist {
    margin-top: 20px;
}

    
</style>
    <div class="row">
       
        <div class="col-6 mx-auto">
            <div class="admin-card">
        




                <div class="admin-card-header">
                    <h4 class="card-title">Add Images</h4>
                </div>
                
                <div class="admin-card-body">




                    <form class="row g-3" id="myform" method="post" enctype="multipart/form-data">
                        @csrf



                        <label for="market_toolimages">Upload Type</label>
                            <select class="form-select" name="tool_type" id="tool_type">
                            <option value="3">Creatives</option>
                            <option value="1">Banner</option>
                            </select>
<!-- 
                        <input type="text" class="d-none" id="tool_type" name="tool_type" value="3" />
                       -->
                        <div class="form-group col-12">
                            <label for="market_toolimages">Choose Images</label>
                            <!-- <input type="file" class="admin-form-control" id="market_toolimages"
                                value="{{ old('market_tool') }}" name="market_toolimages[]" placeholder="Images"
                                accept="image/png, image/jpeg, image/jpg" multiple /> -->

                                <div class="admin-form-control btn" id="pickfiles">Upload Images</div>


                                <div id="filelist"></div>
                              
                        </div>

                        <p class="text-danger">Note :- You can upload only 30 Images at once attempt.</p>
                        <div class="form-group col-12 text-center">
                            <button type="button" class="btn btn-rounded btn-outline-primary" id="selftopup" onclick="checkFilesUploaded()">
                                Submit
                            </button>
                            <span id="ajax_load" style="display:none;"><img src="{{url('/1Rto5efWp86Z/images/ajax-loader.gif')}}" width="20" height="20"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.5/plupload.full.min.js" ></script>
    <script>
        var csrf_token = "{{ csrf_token() }}";

        // const inputElement = document.getElementById("market_toolimages");
        // inputElement.addEventListener("change", handleFiles, false);
    

        // function handleFiles() {
        //     const fileList = this.files;
        //     if (fileList.length > 30) {
        //         toastr.error("You can only upload up to 30 images.");
        //         this.value = "";
        //     }
        // }


        //Plupload Start:


        function uploadImages(){
                       
            var uploader = new plupload.Uploader({
            browse_button: 'pickfiles',
        
            url: '{{ url("/1Rto5efWp86Z/upload-multiple-files") }}',
            chunk_size: '500KB', // 1 MB
            max_retries: 3,
            file_data_name: 'file',
            unique_names: true,
            prevent_duplicates: true,
        	multipart : true,
            filters: {
                max_file_size: '100MB',
                mime_types: [
                {title : "Images", extensions : "png,jpg,jpeg,gif"},
               ]
            },
            multipart_params : {
                // Extra Parameter
                "_token" : "{{ csrf_token() }}"
            },
            init: {
                PostInit: function () {
                    document.getElementById('filelist').innerHTML = '';
                },
                FilesAdded: function (up, files) {
					var afiles=$('input[name="uploadfiles[]"]').length;
					if(afiles>=30){
					showMSG("Max 30 files allowed");
                    return false;	
					}
                  
                    plupload.each(files, function (file) {
                        console.log('FilesAdded');
                        console.log(file);
                        showImagePreview(file);
                       // document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    });
                   
                    uploader.start();
                },
                UploadProgress: function (up, file) {
                    console.log('UploadProgress');
                    console.log(file);
                   // document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                   document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<div class="upload-progress"><div class="progress-bar" role="progressbar" aria-valuenow="'+file.percent+'" aria-valuemin="0" aria-valuemax="100" style="width:'+file.percent+'%"> <span class="sr-only">'+file.percent+'% Complete</span> </div></div>';
                },
                FileUploaded: function(up, file, result){

                    console.log('FileUploaded');
                    console.log(file);
                    console.log(JSON.parse(result.response));
                    responseResult = JSON.parse(result.response);

                    if (responseResult.ok==0) {
                        //toastr.error(responseResult.info, 'Error Alert', {timeOut: 5000});
                    }
                    if (result.status != 200) {
                      //  toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {timeOut: 5000});
                    }
                    if (responseResult.ok==1 && result.status == 200) {
                       // toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {timeOut: 5000});
                    }
                    var fileclass="."+file.id;
                    $(fileclass).val(responseResult.result);
                },
				FilesRemoved: function(uploader, files) {
               
                setTimeout(function () {
                    uploader.refresh();
                },1);
                },
                UploadComplete: function(up, file){
                    // toastr.success('Your File Uploaded Successfully!!', 'Success Alert', {timeOut: 5000});
                },
                Error: function (up, err) {
                    // DO YOUR ERROR HANDLING!
                    //toastr.error('Your File Uploaded Not Successfully!!', 'Error Alert', {timeOut: 5000});
                    //console.log(err);
                    showMSG(err.message);
                }
            }
        });
        uploader.init();
    
    function showImagePreview( file ) {

//alert(file.name);

var item = $('<div class="row mb-1" id="' + file.id + '"><div class="col-md-7"><input type="hidden" name="uploadfiles[]" value=""  class="'+file.id+'" />'+file.name+'</div><div class="col-md-4"><b></b></div></div>' ).appendTo($('#filelist'));
}
$(document).ready(function(){
$(document).on('click', '.rmimg', function() {
var divid=$(this).attr("data-id");
//alert(divid);
 $.each(uploader.files, function (i, file) {
 if (file && file.id == divid) {
 //alert('hii');
 uploader.removeFile(file);
 // Get uploaded file name
 var input_field=$('#'+divid).find('input[name="uploadfiles[]"]');
 var uploadefile=input_field.val();
  if(uploadefile!=''){
  
  }
 //alert(uploadefile);
 //return false;
 }
});
// alert(divid);
 $('#'+divid).remove(); 
 checkFilesUploaded('saveDraft');
})
})
 }




 function checkFilesUploaded(){
    
var alluploaded=true;

$("#ajax_load").show();

 $("input[name='uploadfiles[]']").each(function(){

      if($(this).val()==''){

     // console.log('waiting to upload');				

         alluploaded=false;	 
      }
 }) 

 if(alluploaded==false){

 setTimeout(checkFilesUploaded,500);	

 }else{
  $("#ajax_load").hide();
   //console.log('calling ajax');		
    saveForm();
   }	
  
}


function saveForm(){

var form = document.getElementById('myform');


var formData = new FormData(form);

$.ajax({

type:"POST",

url:"{{url('1Rto5efWp86Z/upload-multiple-files-submit')}}",

cache       : false,

contentType : false,

processData : false,

data:	formData,

beforeSend:function(){

$("#ajax_load").show();

},

success:function(data){

var obj=$.parseJSON(data);

$("#myform")[0].reset();
$('#filelist').html('');



//showMSG(obj.message);

$("#ajax_load").hide();
if(obj.success==1){

$("#myform")[0].reset();
$('#filelist').html('');
window.location.href = "{{ url('/1Rto5efWp86Z/marketing-tools/marketing-tools-report') }}";

}


}	

})



}
        uploadImages();

        //Plupload End:
        


    </script>
@endsection
