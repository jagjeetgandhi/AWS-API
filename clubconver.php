<html>  
      <head>  
           <title>Webslesson Tutorial</title> 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <style>
   
   .box
   {
    width:750px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:100px;
   }
  </style>
      </head>  
      <body>  
        <div class="container box">
          <h3 align="center">Import JSON File Data into Mysql Database in PHP</h3><br />
          <?php
          $connect = mysqli_connect("localhost", "root", "", "u238309547_exgaas"); //Connect PHP to MySQL Database
          $query = '';
          $table_data = '';
          $filename = "clubdata.json";
          $data = file_get_contents($filename); //Read the JSON file in PHP
echo $data;
          $array = json_decode($data, true); //Convert JSON String into PHP Array
echo $array;
          




          ?>
     <br />
         </div>  
      </body>  
 </html>