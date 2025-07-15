<?php
session_start();

// Check if session contains userdata
if (!isset($_SESSION['userdata'])) {
    header("Location: ../index.php");
    exit;
}

$userdata = $_SESSION['userdata'];
$status = isset($_SESSION['status']) ? $_SESSION['status'] : 'Not Voted';
$group = isset($_SESSION['groupdata']) ? $_SESSION['groupdata'] : [];
?>

<html>
    <head>
        
        <title>VOTING SYSTEM DASHBOARD</title>
        <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="mainsection">
        <center>
        <div id="groupsection">
    <?php
        if (isset($groups) && is_array($groups) && count($groups) > 0) {
            foreach($groups as $group) {
                ?>
                <div style="border: 1px solid black; margin: 10px; padding: 10px; width: 200px;">
                    <img src="../uploads/<?php echo $group['photo']; ?>" height="100" width="100"><br><br>
                    <b>Group Name:</b> <?php echo $group['name']; ?><br><br>
                    <b>Votes:</b> <?php echo $group['votes']; ?><br><br>

                    <form action="../api/vote.php" method="POST">
                        <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
                        <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                        <?php
                        if ($userdata['status'] == 0) {
                            echo '<input type="submit" name="votebtn" value="Vote" id="votebtn">';
                        } else {
                            echo '<button disabled type="button" id="voted">Voted</button>';
                        }
                        ?>
                    </form>
                </div>
                <?php
            }
        } 
    ?>
</div>
<div id="headersection">
       <a href="../"><button id="backbtn">Back</button></a>
        <a href="logout.php"><button id="logoutbtn">Logout</button></a>
        <h1>voting system</h1>
</div>
</center>
<hr>
<div id="mainpanel">
<div id="profile">
 <center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center><br><br>
 <b>Name:</b> <?php echo $userdata['name']?><br><br>
 <b>Mobile:</b><?php echo $userdata['mobile']?><br><br>
 <b>Address:</b><?php echo $userdata['address']?><br><br>
 <b>Status:</b><?php echo $status?><br><br>
</div>
<div id="group">
<?php
    if($_SESSION['group']){
        for ($i=0; $i<count($group); $i++){
            ?>
           <div>
            <img  style="float:right"  src="../uploads/<?php echo $group[$i]['photo']?>"  height="100" width="100" >
            <b>Group Name:</b> <?php echo $candiate[$i]['name']?><br><br>
            <b>Votes:</b> <?php echo $group[$i]['votes']?><br><br>
            <form action="../api/vote.php" method="post">
                <input type="hidden" name="gvotes" value="<?php echo $group[$i]['votes']?>">
                <input type="hidden" name="gid" value="<?php echo $group[$i]['id']?>">
                <?php
                    if($_SESSION['userdata']['status']==0){
                        ?>
                        <input type="submit" name="votebtn" value="vote" id="votebtn">
                        <?php

                    }
                    else{
                        ?>
                        <button disabled  type="button" name="votebtn" value="vote" id="voted">Voted</button>
                        <?php
                    }
                    ?>
            </form>
           </div>
           <hr>
            <?php
        }

    }
    else{

    }
    ?>
 </div>
 </div>
</div>
</body>
<style>

body{
    text-align: center;
    background-color: dodgerblue;
}
#voted{
    padding: 8px;
    font-size: 15px;
    background-color: green;
    color: white;
    border-radius: 5px;
}

#backbtn{
    padding: 8px;
    border-radius: 5px;
    width: 15%;
    background-color:lime;
    color: white;
    float: left;
    margin:10px;
}
#logoutbtn{
    padding: 8px;
    border-radius: 5px;
    width: 15%;
    background-color:lime;
    color: white;
    float: right;
    margin:10px;
}
#votebtn{
    padding: 8px;
    border-radius: 5px;
    width: 15%;
    background-color:lime;
    color: white;

}

#profile{
    background-color:white;
    width: 15%;
    padding:3%;
    
    float: left;
    }
#profile,img{
   border-radius:50%;
    object-fit:cover;
	vertical-align:middle;
	border-radius:10px;
	box-shadow: 0px 0px 15px black;
    }
#group{
    background-color:white;
    width:30%;
    padding:5%;
    float: right;
    object-fit:cover;
	vertical-align:middle;
	border-radius:10px;
	box-shadow: 0px 0px 15px black;
}
#headerSection {
padding: 5px;

}
#mainsection{
 padding:10px;
  
}
#headerSection h1 {
font-family: Cursive;
}
#dropbox {

padding: 10px;

border-radius: 5px;

width: 15%;
  
}
#loginbtn {
padding: 5px;
font-size: 15px;
color: white;
border-radius: 5px;
}
#mainpanel{
    padding:10px;
}
</style>
</html>