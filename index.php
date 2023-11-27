<head>
<title>Remove Bg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/20231120.png">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	crossorigin="anonymous"></script>
<style>

</style>
</head>
<body>
	<div class="container">
    <div class="before">
    <center>  <img src="img/3108323.png" alt="" style="width: 200px;height:200px;margin-top: 10%;"> </center>
    </div>
<div style="margin-top:5%;" class="card"><div class="card-body">
	<form class="inline-form" id="image-upload-form" action="upload.php" method="post">
		 <div class="dropzone-wrapper">
        <div class="dropzone-desc">
         
         <p>Choose an image file or drag it here.</p>
        </div>
        <input name="userImage" type="file" class="dropzone">
       </div>
		<div>
			<input type="submit" value="Upload" class="btn-upload" />
	</form>	</div></div></div>
	 
	 <div class="loader">
    <center>  <img src="img/abc.png" alt="" style="width: 150px;height:150px;margin-top: 10%;"> </center>
    </div>
		<div id="targetLayer"></div>

	<script type="text/javascript">
    $(document).ready(function (e) {
    	$("#image-upload-form").on('submit',(function(e) {
    		e.preventDefault();
    		$.ajax({
            	url: "upload.php",
    			type: "POST",
    			data:  new FormData(this),
    			contentType: false,
        	cache: false,
    			processData: false,
          beforeSend:function(){
           $('.before').hide();
           $('.loader').show();
            },
    			success: function(data)
    		    {
    				$("#targetLayer").html(data);
            $('.loader').hide();
    		    },
    		  	error: function(data)
    	    	{
    		  	  console.log("error");
                  console.log(data);
    	    	}
    	   });
    	}));
    });
</script>
</body>
</html>