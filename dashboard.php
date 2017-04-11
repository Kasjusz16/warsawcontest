<?php
    require_once './config/Config.php';
//    $arrow ='';
//    $orderBy ='';
    if(isset($_GET['order']) && $_GET['order'] == 'ASC'  ){
        $orderBy = 'DESC';
        $arrow = "&dArr;";
    }
    else{
        $orderBy = 'ASC';
        $arrow = "&uArr;";
    }
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zarejestrowani w konkursie</title>
        <script src="scripts/jquery-3.1.1.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/style.css">
            
    </head>
    <body>
            <div class="container">
                <div class="jumbotron" style=" background-color: aliceblue; color:black; font-family: fantasy">
                    <h1 align="center">Contest about Warsaw</h1>      
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <span class="glyphicon glyphicon-bookmark"></span>Admin Panel</h3>  
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <form action="dashboard.php" method="GET">
                                                    <select onchange="window.location.replace('http://localhost/contestaboutwarsaw/dashboard.php?name='+ this.value)" class="select form-control" name='month' id='month'>
                                                        <option value="empty">Filter by:</option>
                                                        <option value='male'>Male</option>
                                                        <option value='female'>Female</option>
                                                        <option value='ga1'>First question answered correct</option>
                                                        <option value='ga2'>Second question answered correct </option>
                                                        <option value='ga12'>Both question answered correct</option>
                                                    </select>
                                                 </form>
                                            </div>
                                        
                                            <div class="col-xs-12 col-md-12"  style="padding-top:10px;">
                                                
                                                <a href="dashboard.php?action=name&order=<?php echo $orderBy; ?>" class="btn btn-success btn-lg" style="margin: 5px; float: left;">Name <?php echo $arrow;  ?></a>
                                                <a href="dashboard.php?action=surname&order=<?php echo $orderBy; ?>" class="btn btn-success btn-lg" style="margin: 5px; float: left;">Surname <?php echo $arrow;  ?></a>
                                                <a href="dashboard.php?action=sex&order=<?php echo $orderBy; ?>" class="btn btn-success btn-lg" style="margin: 5px; float: left;">Sex <?php echo $arrow;  ?></a>
                                                <a href="dashboard.php?action=mail&order=<?php echo $orderBy; ?>" class="btn btn-success btn-lg" style="margin: 5px; float: left;">E-mail <?php echo $arrow; ?></a>
                                                <form action="http://localhost/contestaboutwarsaw/dashboard.php">
                                                    <button type="submit" class="btn btn-danger btn-lg" style="margin: 5px; float: right;">Show all</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                

       <div class="table-responsive">             
            <div class="row"> 
             <div class="col-xs-12 col-md-12" >                
            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>L.p</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Birthdate</th>
                        <th>Sex</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>Address</th>
                        <th>First answer</th>
                        <th>Second answer</th>
                        <th>Register date</th>
                    </tr>
                </thead>
                <tbody>
       
                    <?php
                        $query = "SELECT * FROM `formularz`";

                        if(!empty($_GET['name']) && $_GET['name'] == 'male'){
                            $query = "SELECT * FROM `formularz` WHERE `sex` = 'male'";
                        }
                        if(!empty($_GET['name']) && $_GET['name'] == 'female'){
                            $query = "SELECT * FROM `formularz` WHERE `sex` = 'female'";
                        }
                        if(!empty($_GET['name']) && $_GET['name'] == 'ga1'){
                            $query = "SELECT * FROM `formularz` WHERE `answer1` = '1,748,916'";
                        }
                        if(!empty($_GET['name']) && $_GET['name'] == 'ga2'){
                            $query = "SELECT * FROM `formularz` WHERE `answer2` = '18'";
                        }
                        if(!empty($_GET['name']) && $_GET['name'] == 'ga12'){
                            $query = "SELECT * FROM `formularz` WHERE `answer1` = '1,748,916' AND `answer2` = '18'";
                        }
                        if(!empty($_GET['action']) && !empty($_GET['order'])){
                            $action = htmlentities($_GET['action']);
                            $order = htmlentities($_GET['order']);
                            $query .= " ORDER BY `$action` $order";
                        }                                         
                        $pokaz = new Konkurs();
                        $pokaz->enlist($query);
                        
                        ?>
                </tbody>
            </table>
                 </div>
                             </div>
                                    
    
         </div>
                </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
