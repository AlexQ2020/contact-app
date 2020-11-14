<?php
//common start
function runQuery($sql){
    $con=con();
    if(mysqli_query($con,$sql)){
        return true;
    }else{
        die("Query Fail: ".mysqli_error($con));
    }
}
function fetch($sql){
    $query=mysqli_query(con(),$sql);
    $row=mysqli_fetch_assoc($query);
    return $row;
}
function fetchAll($sql){
    $query=mysqli_query(con(),$sql);
    $rows=[];
    while ($row=mysqli_fetch_assoc($query)){
        array_push($rows,$row);
    }
    return $rows;
}
function redirect($l){
    header("location: $l");
}
function linkTo($l){
    echo "<script>location.href='$l'</script>";
}
function short($str,$length="100"){
    return substr($str,0,$length)."";
}
function textFilter($text){
    $text=trim($text);
    $text=htmlentities($text,ENT_QUOTES);
    $text=stripcslashes($text);
    return $text;
}
//common end

function old($inputName){
    if(isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "";
    }
}

function setError($inputName,$message){
    $_SESSION['error'][$inputName]=$message;
}

function getError($inputName){
    if(isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];
    }else{
        return "";
    }
}

function clearError(){
    $_SESSION['error']=[];
}












//contact start
function register(){

    $errorStatus=0;
    $fname="";
    $lname="";
    $phone="";
    $photo="";
    $fnameNew="";$lnameNew="";$phoneNew="";$photoNew="";

    //first name
    if(empty($_POST['fname'])){
        setError("fname","First name is required");
        $errorStatus=1;
    }else{
        if(strlen($_POST['fname'])<=1){
            setError("fname","First name is too short");
            $errorStatus=1;
        }else{
            if(strlen($_POST['fname'])>20){
                setError("fname","First name is too long");
                $errorStatus=1;
            }else{
                if(!preg_match("/^[a-zA-Z' ]*$/",$_POST['fname'])){
                    setError('fname',"Only letters and white space allowed");
                    $errorStatus=1;
                }else{
                    $fname=textFilter($_POST['fname']);
                    $fnameNew=$fname;
                }
            }
        }
    }

    //last name
    if(empty($_POST['lname'])){
        setError("lname","Last name is required");
        $errorStatus=1;
    }else{
        if(strlen($_POST['lname'])<=1){
            setError("lname","Last name is too short");
            $errorStatus=1;
        }else{
            if(strlen($_POST['lname'])>20){
                setError("lname","Last name is too long");
                $errorStatus=1;
            }else{
                if(!preg_match("/^[a-zA-Z' ]*$/",$_POST['lname'])){
                    setError('lname',"Only letters and white space allowed");
                    $errorStatus=1;
                }else{
                    $lname=textFilter($_POST['lname']);
                    $lnameNew=$lname;

                }
            }
        }
    }

    //contact or phone number
    if(empty($_POST['phone'])){
        setError("phone","Phone is requried");
        $errorStatus=1;
    }else{
        if(!preg_match("/^[0-9 ]*$/",$_POST['phone'])){
            setError("phone","Phone format incorrect");
            $errorStatus=1;
        }
        else{
            $phone=textFilter($_POST['phone']);
            $phoneNew=$phone;

        }
    }

    //upload photo
    $supportFileType=['image/jpeg','image/png'];
    if(isset($_FILES['upload']['name'])){
        $tempFile=$_FILES['upload']['tmp_name'];
        $fileName=$_FILES['upload']['name'];
        //print_r($_FILES) ;
        if(in_array($_FILES['upload']['type'],$supportFileType)){
            $saveFolder="store/";
            $newPhoto=$saveFolder.uniqid()."_".$fileName;
            move_uploaded_file($tempFile,$newPhoto);
            $photoNew=$newPhoto;

        }else{
            setError("upload","File is incorrect");
            $errorStatus=1;
        }

    }else{
        setError("upload","File is required");
        $errorStatus=1;
    }


    if(!$errorStatus){
        $sql="INSERT INTO contacts (fname,lname,phone,photo) VALUES ('$fnameNew','$lnameNew','$phoneNew','$photoNew')";
        runQuery($sql);
        redirect("contact_list.php");
    }

}
function contact($id){
    $sql="SELECT * FROM contacts WHERE id=$id";
    return fetch($sql);
}
function contacts(){
    $sql="SELECT id,CONCAT(fname,' ',lname,' ') AS name, phone, photo FROM contacts";
    return fetchAll($sql);
}

function contactDelete($id){

    $sql="SELECT * FROM contacts WHERE id=$id";
    $query=mysqli_query(con(),$sql);
    $row=mysqli_fetch_assoc($query);
    unlink($row['photo']);

    $sql = "DELETE FROM contacts WHERE id=$id";
    return runQuery($sql);
}

function contactUpdate(){

    $errorStatus=0;
    $fname="";
    $lname="";
    $phone="";
    $photo="";
    $fnameNew="";$lnameNew="";$phoneNew="";$photoNew="";

    $id=$_POST['id'];

    //first name
    if(empty($_POST['fname'])){
        setError("fname","First name is required");
        $errorStatus=1;
    }else{
        if(strlen($_POST['fname'])<=1){
            setError("fname","First name is too short");
            $errorStatus=1;
        }else{
            if(strlen($_POST['fname'])>20){
                setError("fname","First name is too long");
                $errorStatus=1;
            }else{
                if(!preg_match("/^[a-zA-Z' ]*$/",$_POST['fname'])){
                    setError('fname',"Only letters and white space allowed");
                    $errorStatus=1;
                }else{
                    $fname=textFilter($_POST['fname']);
                    $fnameNew=$fname;

                }
            }
        }
    }

    //last name
    if(empty($_POST['lname'])){
        setError("lname","Last name is required");
        $errorStatus=1;
    }else{
        if(strlen($_POST['lname'])<=1){
            setError("lname","Last name is too short");
            $errorStatus=1;
        }else{
            if(strlen($_POST['lname'])>20){
                setError("lname","Last name is too long");
                $errorStatus=1;
            }else{
                if(!preg_match("/^[a-zA-Z' ]*$/",$_POST['lname'])){
                    setError('lname',"Only letters and white space allowed");
                    $errorStatus=1;
                }else{
                    $lname=textFilter($_POST['lname']);
                    $lnameNew=$lname;

                }
            }
        }
    }

    //phone number
    if(empty($_POST['phone'])){
        setError("phone","Phone is requried");
        $errorStatus=1;
    }else{
        if(!preg_match("/^[0-9 ]*$/",$_POST['phone'])){
            setError("phone","Phone format incorrect");
            $errorStatus=1;
        }
        else{
            $phone=textFilter($_POST['phone']);
            $phoneNew=$phone;

        }
    }

    //update photo
    $supportFileType=['image/jpeg','image/png'];
    if(isset($_FILES['upload']['name'])){
        $tempFile=$_FILES['upload']['tmp_name'];
        $fileName=$_FILES['upload']['name'];
        //print_r($_FILES) ;
        if(in_array($_FILES['upload']['type'],$supportFileType)){
            $saveFolder="store/";


            $sql="SELECT * FROM contacts WHERE id=$id";
            $query=mysqli_query(con(),$sql);
            $row=mysqli_fetch_assoc($query);
            unlink($row['photo']);

            //new photo
            $newPhoto=$saveFolder.uniqid()."_".$fileName;
            move_uploaded_file($tempFile,$newPhoto);
            $photoNew=$newPhoto;

        }else{
            setError("upload","File is incorrect");
            $errorStatus=1;
        }

    }else{
        setError("upload","File is required");
        $errorStatus=1;
    }



    $sql="UPDATE contacts SET fname='$fnameNew',lname='$lnameNew',phone='$phoneNew',photo='$photoNew' WHERE id='$id'";
    if(!$errorStatus){
        runQuery($sql);
        redirect("contact_list.php");
    }

}
//contact end