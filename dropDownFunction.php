
        function generateSelect($userID, $value, $queryType) {

            // Create (connect to) SQLite database in file
            $file_db = new PDO('sqlite:photos');

            $html = '<select name="'.$value.'">';

            if($queryType == 1) {

                $insert = 'SELECT name 
                               FROM album
                               WHERE albumID in 
                                    (SELECT albumID
                                     FROM userCreateAlbum
                                     WHERE :userID = userID)
                               ORDER by dateCreated';
     
                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':userID', $userID);
                $row = $stmt->execute();
                $i = 0;

                //TEST (REMOVE WHEN FINISHED)
                $html2 = '<select name="'.$value.'">';
                $html2 .= '<option value="BLAH"></option>';
                $html2 .= '</select>';
                return $html2;

                while($row[$i]) {            

                    $html .= '<option value=' .$row[$i].'>'.'</option>';
                    $i++;
                }

            } elseif($queryType == 2) {

                $insert = 'SELECT name                                    
                           FROM photoGroup
                           WHERE groupID in 
                                (SELECT groupID
                                 FROM groupHasUser
                                 WHERE :userID = userID)';             

                $stmt = $file_db->prepare($insert);
                $stmt->bindParam(':userID', $userID);
                $row = $stmt->execute();
                $i = 0;

                while($row[$i]) {            

                    $html .= '<option value=' .$row[$i].'>'.'</option>';
                    $i++;
                }
            }
            
            $html .= '</select>';
            //return $html;
        }
    }

