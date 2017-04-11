<?php
    require_once './config/Config.php';
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Konkurs</title>
        <link rel="stylesheet" href="styles/style.css">
        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
           
            <?php
            if(isset($_POST['submit'])){

                    $name = htmlentities($_POST['name']);
                    $surname = htmlentities($_POST['surname']);
                    $email = htmlentities($_POST['email']);
                    $pref = htmlentities($_POST['pref']);
                    $phoneNumber = htmlentities($_POST['phoneNumber']);
                    $address = htmlentities($_POST['address']);
                    $firstAnswer = htmlentities($_POST['select2']);
                    $secondAnswer = htmlentities($_POST['select3']);
                    

                    $check = new WSValidate();
                    //name val
                    $check->emptyField($name, 'Name');
                    $check->maxCharsAmount($name, 'Name', 25);
                    $check->onlyLetters($name, 'Name');
                    
                    //surname val
                    $check->emptyField($surname, 'Surname');                   
                    $check->maxCharsAmount($surname, 'Surname', 40);
                    $check->onlyLetters($surname, 'Surname');
                    
                    //birthdate val
                    $day = htmlentities($_POST['day']);
                    $month = htmlentities($_POST['month']);
                    $year = htmlentities($_POST['year']);
                    $check->bDayField($day, 'DAY');
                    $check->bDayField($month, 'MONTH');
                    $check->bDayField($year, 'YEAR');
                    $bday = $year.'-'.$month.'-'.$day;
                    
                    //sex
                    if(!isset($_POST['sex'])){
                    $check->checkCheckBox('Sex');
                        } else { 
                            $sex = ($_POST['sex']);
                        }
                        
                    //email val
                    $check->checkMail($email, 'E-mail');
                    $check->emptyField($email, 'E-mail');
                    
                    //phone val
                    $phone = $pref . $phoneNumber;
                    $check->emptyField($phone, 'Phone number');
                    $check->maxCharsAmount($phone, 'Phone number', 12);
                    
                    //adress                  
                    $check->emptyField($address, 'Address');
                    
                    //first q answer
                    $check->bDayField($firstAnswer, 'Choose answear');
                    
                    //second q answer
                    $check->bDayField($secondAnswer, 'Choose answear');
                    
                    //terms val 
                    if(!isset($_POST['checkbox'])){
                    $check->checkCheckBox('Terms');
                    } 
                    
                    if(($check->countError) > 0){
                    }
                    else
                    {
                        $date = date('Y-m-d H:i:s');
                        $zapytanie="INSERT INTO `formularz`(`id_form`, `name`, "
                                . "`surname`, `birth_date`, `sex`, `mail`, `phone`, "
                                . "`address`, `answer1`, `answer2`, `register_date`) "
                                . "VALUES (NULL, '$name', '$surname', '$bday', '$sex', '$email', '$phone', "
                                . "'$address', '$firstAnswer', '$secondAnswer', '$date')";
                        
                        $contestants = new DbConnect();
                        $wynik =$contestants->db->query($zapytanie);
                        
                        $message = "Name: $name <br>Surname: $surname<br>Birthday: $bday<br>Sex: $sex<br>Phone number: $phone<br>Address: $address<br>First question: How many people lives in Warsaw?<br>Your answear: $firstAnswer <br>correct answear was: 1,748,916.<br>Second question: How many districts Warsaw has?<br>Your answer: $secondAnswer <br> Correct answear was: 18.<br>Agreement accepted, e-mail generation date: $date";
                        $sendMail = new sendMail(E_MAIL_ADMIN);
                        $sendMail->send($email, 'Thank You for registration in contest About Warsaw!', $message);  
                    }
                    
                }
            ?>
        
        
 <div class="container-fluid">
  <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12 col1"></div>
   <div class="col-md-4 col-sm-4 col-xs-12 col2">
   <img src="syrenka.jpg" class="syrenka" align="right">
   <p>Contest about Warsaw</p>
    <form method="post">
     <div class="form-group">
      <label class="control-label requiredField" for="name">
       Name
       <span class="asteriskField">
        *
       </span>
      </label>
      <input type="text" class="form-control" id="name" name="name" />
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="surname">
       Surname
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="surname" name="surname" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="day">
       Birthdate
       <span class="asteriskField">
        *
       </span>
      </label>
            <select class="select form-control" name='day' id='day'>
                <option value="empty">DAY</option>
                <?php 
                    for($i = 1; $i<=31; $i++)
                    {
                        echo "<option value=\"$i\">$i</option>";
                    }
                ?>              
            </select>

            <select class="select form-control" name='month' id='month'>
                <option value="empty">MONTH</option>
                <option value='1'>January</option>
                <option value='2'>February</option>
                <option value='3'>March</option>
                <option value='4'>April</option>
                <option value='5'>May</option>
                <option value='6'>June</option>
                <option value='7'>July</option>
                <option value='8'>August</option>
                <option value='9'>September</option>
                <option value='10'>Octomber</option>
                <option value='11'>November</option>
                <option value='12'>December</option>
            </select>

            <select class="select form-control" name='year' id='year'>
                <option value="empty">YEAR</option>
                <?php 
                    for($i = 1980; $i<=1999; $i++)
                    {
                        echo "<option value=\"$i\">$i</option>";
                    }
                ?>
            </select>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField">
       Sex
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="">
       <div class="radio">
        <label class="radio">
         <input name="sex" type="radio" value="Male"/>
         Male
        </label>
       </div>
       <div class="radio">
        <label class="radio">
         <input name="sex" type="radio" value="Female"/>
         Female
        </label>
       </div>
      </div>
     </div>
     <div class="form-group">
      <label class="control-label requiredField" for="email">
       Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="email" name="email" type="text"/>
     </div>
     <div class="form">
      <label class="control-label requiredField" for="phoneNumber">
          Phone Number
       <span class="asteriskField">
        *
       </span>
      </label>
         <div class="form-inline">
     <select class="select form-control" id="pref" name="pref" >
        <option value="+49">
       +49
       </option>
       <option value="+48">
        +48
       </option>
       <option value="+76">
        +76
       </option>
         </select>
         </div>
        <div class="form-inline">
       <input class="form-control" id="phoneNumber" name="phoneNumber" type="text"  />
       </div>
     </div>
     <div class="form-group">
      <label class="control-label requiredField" for="address">
       Address
       <span class="asteriskField">
        *
       </span>
      </label>
      <textarea class="form-control" cols="40" id="address" name="address" rows="10"></textarea>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="select2">
          First Question: How many people lives in Warsaw?
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="select2" name="select2">
        <option value="empty">
            Choose answer
        </option>
        <option value="931,321">
        931,321
       </option>
       <option value="1,748,916">
        1,748,916
       </option>
       <option value="2,432,098">
        2,432,098
       </option>
      </select>
     </div>
     <div class="form-group " id="selectdiv">
      <label class="control-label requiredField" for="select3">
       Second Question: How many districts Warsaw has?
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="select3" name="select3">
       <option value="empty">
            Choose answer
        </option>
        <option value="3">
        3
       </option>
       <option value="7">
        7
       </option>
       <option value="11">
        11
       </option>
       <option value="18">
        18
       </option>
      </select>
     </div>
     <div class="form-group ">
      <label class="control-label ">
       <a href="#" id="terms">Read terms</a>
      </label>
      <div class=" ">
       <div class="checkbox">
        <label class="checkbox">
         <input name="checkbox" type="checkbox" value="Akceptuje"/>
         Accept
        </label>
       </div>
      </div>
     </div>
     <div class="form-group">
      <div>
          <button class="btn btn-primary " name="submit" type="submit" value="send">
        Send form
       </button>
          <?php unset($check); ?>
      </div>
     </div>
    </form>
   </div>
   <div class="col-md-4 col-sm-4 col-xs-12 col3"></div>
  </div>
 </div>
        <div id="mod">
            <div id="agreement">
                <h2>Agreement:</h2>
                <p>Agreement: Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.

Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.

The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                <button class="btn btn-default" id="back">Back</button>
            </div>
        </div>
         <footer>
            <div class="footer">
                <a href="#top">/Kontakt</a><a href="#top">Regulamin</a>
                <p>&copy; 2017</p>
                
        </div>
    </footer>
        <script src="js/jquery-3.1.1.js"></script>
        <script src="js/script.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
