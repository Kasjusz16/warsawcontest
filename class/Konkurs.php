<?php
   
    class Konkurs extends DbConnect{
 
        function enlist($pobierz){

            $wynik= $this->db->query($pobierz);
            $lp = 0;
            while($wiersz=$wynik->fetch_object()){
                $lp++;
                echo "
                <tr>
                    <td>$lp</td>
                    <td>$wiersz->name</td>
                    <td>$wiersz->surname</td>
                    <td>$wiersz->birth_date</td>
                    <td>$wiersz->sex</td>
                    <td>$wiersz->mail</td>
                    <td>$wiersz->phone</td>
                    <td>$wiersz->address</td>
                    <td>$wiersz->answer1</td>
                    <td>$wiersz->answer2</td>
                    <td>$wiersz->register_date</td>
                </tr>";
            }
        }
    }
?>

