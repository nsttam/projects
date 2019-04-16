<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>
<?php
//1) Connect to server
try {
      $db_config = array();
      $db_config['PDO_SGBD']      = 'mysql';
      $db_config['PDO_PORT']      = '3306';
      $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
      $db_config['PDO_USER']      = 'root';
      $db_config['PDO_PASSWORD']  = '';
      $db_config['PDO_OPTIONS']   = array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      );
      $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";",
                      $db_config['PDO_USER'],
                      $db_config['PDO_PASSWORD'],
                      $db_config['PDO_OPTIONS']
                  );
                  print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is OK ", "success");
  } catch(PDOException $e) {
                  print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion failed " . $e->getMessage(), "danger");
  } finally {
                  unset($db_config);
  }


//2) Create DB tamara_ravagnan_exam
$DB_NAME = "tamara_ravagnan_exam";
  $sql = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");
  try {
      $conn->exec($sql);
      print_alert("Database $DB_NAME CREATED ", "success");
  } catch(PDOException $e) {
      print_alert("Database $DB_NAME NOT CREATED " . $e->getMessage(), "danger");
  }

//3) Disconnect from DB and Reconnect to DB tamara_ravagnan_exam
$conn = null;

try {
    $db_config = array();
    $db_config['PDO_SGBD']      = 'mysql';
    $db_config['PDO_PORT']      = '3306';
    $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
    $db_config['PDO_DB_NAME']   = 'tamara_ravagnan_exam';
    $db_config['PDO_USER']      = 'root';
    $db_config['PDO_PASSWORD']  = '';
    $db_config['PDO_OPTIONS']   = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";"
                    . 'dbname='. $db_config['PDO_DB_NAME'],
                    $db_config['PDO_USER'],
                    $db_config['PDO_PASSWORD'],
                    $db_config['PDO_OPTIONS']
                );
                    print_alert($db_config['PDO_DB_NAME'] . " database connexion is OK ", "success");
    } catch(PDOException $e) {
                    print_alert($db_config['PDO_DB_NAME'] . " database connexion failed " . $e->getMessage(), "danger");
    } finally {
                    unset($db_config);
    }

//4) Create table Users
$TB_USERS = 'users';
$sql = "CREATE TABLE IF NOT EXISTS $TB_USERS (
         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         id_role INT(6) UNSIGNED NOT NULL,
         name VARCHAR(30) NOT NULL,
         email VARCHAR(50) NOT NULL,
         password VARCHAR(255) NOT NULL,
         created_at TIMESTAMP DEFAULT NOW(),
         updated_at TIMESTAMP DEFAULT NOW()
     )";
    try {
         $result = $conn->query($sql);
         print_alert("Table $TB_USERS created.", "success");
    } catch (PDOException $e) {
         print_alert("Table $TB_USERS not created" . $e->getMessage(), "danger");
    }

//5) Create table roles
$TB_ROLES = 'roles';
$sql = "CREATE TABLE IF NOT EXISTS $TB_ROLES (
         id INT(6) UNSIGNED PRIMARY KEY,
         rname VARCHAR(30) NOT NULL,
         created_at TIMESTAMP DEFAULT NOW(),
         updated_at TIMESTAMP DEFAULT NOW()
     )";
    try {
         $result = $conn->query($sql);
         print_alert("Table $TB_ROLES created.", "success");
    } catch (PDOException $e) {
         print_alert("Table $TB_ROLES not created" . $e->getMessage(), "danger");
    }



//6) Add data to table roles
$sql = "INSERT INTO $TB_ROLES
               (id, rname)
           VALUES
               (1, 'admin'),
               (2, 'operator'),
               (3, 'client')
           ";
   try {
        $result =	$conn->query($sql);
        print_alert("Data added to $TB_ROLES OK.", "success");
   }catch (PDOException $e){
        print_alert("Impossible to add data to $TB_ROLES" . $e->getMessage(), "danger");
   }


   // 7) add data users

   $id_role = 1;
   $name = "user1";
   $email = "user1@test.net";
   $pwd = password_hash('user1', PASSWORD_DEFAULT);
   $sql = $conn->prepare('INSERT INTO users (id_role, name, email, password) VALUES (:id_role, :name, :email, :pwd)');
   $sql->bindParam(':id_role', $id_role, PDO::PARAM_INT);
   $sql->bindParam(':name', $name, PDO::PARAM_STR);
   $sql->bindParam(':email', $email, PDO::PARAM_STR);
   $sql->bindParam(':pwd', $pwd, PDO::PARAM_STR);
   try {
       $sql->execute();
       print_alert("$id_role, $name, $email, $pwd added ", "success");
   } catch(PDOException $e) {
       print_alert("$id_role, $name, $email, $pwd not added ", "danger");
   }

//loop for creating 5 users admin
   for ($i=0; $i < 5; $i++) {
           $sql = "INSERT INTO users (id_role, name, email, password) VALUES (1, 'user". $i ."', 'user".$i."@test.net', '".$pwd."')";
           $pwd = password_hash('user1'.$i, PASSWORD_DEFAULT);
           try {
               $conn->query($sql);
               print_alert("added", "success");

           } catch(PDOException $e) {
                  print_alert("$id_role, $name,$email, $pwd not added ", "danger");
              }
       }
 //loop for creating 10 users operator
       for ($i=0; $i < 10; $i++) {
           $sql = "INSERT INTO users (id_role, name, email, password) VALUES (2, 'user". $i ."', 'user".$i."@test.net','".$pwd."')";
           $pwd = password_hash('user'.$i, PASSWORD_DEFAULT);
           try {
               $conn->query($sql);
               print_alert("added ", "success");

           } catch(PDOException $e) {
                  print_alert("$id_role, $name,$email, $pwd not added ", "danger");
             }
       }
//loop for creating 20 users client
       for ($i=0; $i < 20; $i++) {
           $sql = "INSERT INTO users (id_role, name, email, password) VALUES (3, 'user". $i ."', 'user".$i."@test.net', '".$pwd."')";
           $pwd = password_hash('user'.$i, PASSWORD_DEFAULT);
           try {
               $conn->query($sql);
               print_alert("added", "success");

           } catch(PDOException $e) {
                 print_alert("$id_role, $name,$email, $pwd not added ", "danger");
              }
       }
//POST method for adding a user using the form
       if( isset($_POST['id_role']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
           try{
               $sql = "INSERT INTO $TB_USERS (id_role, name, email, password) VALUES (:id_role, :name, :email, :pwd)";
               $result = $conn->prepare($sql);
               $result->bindParam(':id_role', $_POST['id_role']);
               $result->bindParam(':name', $_POST['name']);
               $result->bindParam(':email', $_POST['email']);
               $result->bindParam(':pwd', $_POST['password']);

               $res = $result->execute();

               print_alert("Line added to $TB_USERS OK.", "success");
           } catch (Exception $e) {
               print_alert("Line not added to $TB_USERS." . $e->getMessage(), "danger");
           }
       }

       if(isset($_POST['id_delete']) && $_POST['id_delete'] !== "" ){ //si get est trouvé et pas vide
//echo $_POST['id_delete'];
    try{
        $sql = "DELETE FROM users WHERE  id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $_POST['id_delete'], PDO::PARAM_INT);
        $res = $stmt->execute();
        print_alert("Delete content on users OK.", "success");
    }catch (PDOException $e) {
        print_alert("Failed to delete content on users KO" . $e->getMessage(), "danger");
    }
}

    if(isset($_POST['id_delete']) && $_POST['id_delete'] !== "" ){
        try{
            $sql = "DELETE FROM users WHERE  id = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $_POST['id_delete'], PDO::PARAM_INT);
            $res = $stmt->execute();
            print_alert("Delete  OK.", "success");
        }catch (PDOException $e) {
            print_alert("Failed to delete" . $e->getMessage(), "danger");
        }
    }

?>

<!-- FORM FOR USER CREATION -->

           <div class="container">
               <form method="post">
                 <div class="form-group">
                   <label for="addRole"><h6>Add a role</h6></label>
                   <input type="number" name="id_role" class="form-control" id="role" aria-describedby="roleHelp" placeholder="Role">
                 </div>
                 <div class="form-group">
                   <label for="addname"><h6>Add a name</h6></label>
                   <input type="text" name="name" class="form-control" id="name" aria-describedby="surnameHelp" placeholder="Add a name">
                 </div>
                 <div class="form-group">
                   <label for="addAge">Add email</label>
                   <input type="text" name="email" class="form-control" id="age" aria-describedby="emailHelp" placeholder="Add email ">
                 </div>
                 <div class="form-group">
                   <label for="addPassword">Add password</label>
                   <input type="text" name="password" class="form-control" id="age" aria-describedby="passHelp" placeholder="Add password">
                 </div>
                 <button type="submit" class="btn btn-primary">Add user</button>
               </form>
           </div>
         </br>









<?php
//Table to show results
$query = "SELECT id, id_role, name, email, password FROM $TB_USERS";
   try {
       //execute query
       $result = $conn->query($query);
?>
<table class="table">
   <thead class="thead-dark">
         <tr>
             <th scope="col">id</th>
             <th scope="col">id_role</th>
             <th scope="col">Name</th>
             <th scope="col">email</th>
             <th scope="col">password</th>
             <th scope="col">Create</th>
             <th scope="col">Delete</th>
             <th scope="col">Post</th>
             <th scope="col">Update</th>

        </tr>
  </thead>
<tbody>
  <?php
      while ($row = $result->fetch()) {
              echo "<tr>";
                  echo "<td>" . $row["id"] . "</td>";
                  echo "<td>" . $row["id_role"]. "</td>";
                  echo "<td>" . $row["name"] . "</td>";
                  echo "<td>" . $row["email"] . "</td>";
                  echo "<td>" . $row["password"] . "</td>";
                  echo '<td>
                      <form method="post" action="seed_php.php">
                          <input  type="hidden" value="' . $row['id'] . '" name="id_delete" class="form-control" id="id_delete" aria-describedby="user">
                          <button type="submit" value="add" class="btn btn-success">delete_POST</button>
                          </form>
                      </td>';
						      echo '<td><a href="./crud_examen.php?action=update&id=' . $row['id'] . '" class="btn btn-primary">Update</a></td>';
						      //echo '<td><a href="./crud_examen.php?action=delete&id=' . $row['id'] . '" class="btn btn-primary" onclick="return validation(' . $row['id'] . ')">Delete</a></td>';
                  echo '</tr>';
          }
  ?>
  </tbody>
</table>





<?php
 } catch (PDOException $e) {
          //echo '<br>Exception received: ',  $e->getMessage(), "\n";
          print_alert("Query $query not executed." . $e->getMessage(), "danger");
      } finally {
      }


      echo "<br>";


include "./footer.php";
?>
