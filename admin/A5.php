<h1>ภาษานักเรียน</h1>
<?php 
	if(isset($_POST['save']))
	  {
		$n = $_POST['number'];
		$l = $_POST['name'];
        $r = $_POST['Reg'];
        $c = $_POST['Class'];
        $s = $_POST['Section'];

		$result = $db->exec("INSERT INTO student_table(ID,NAME,Reg,Class,Section) VALUES('$n','$l','$r','$c','$s')");
		$insertId = $db->lastInsertId();
		if($insertId)
		{
			echo"<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
		}
		else
		{
			echo"<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
		}
		
	  }	

      if(isset($_GET['del'])){
		$id=$_GET['del'];
		$stmt = $db->prepare("DELETE FROM student_table WHERE ID=:id");
		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		echo "<script>
				alert('ลบข้อมูลเรียบร้อย');
				             </script>";
	 }
	 if(isset($_POST['edit']))
	 {
		$n = $_POST['number'];
		$l = $_POST['name'];
        $r = $_POST['Reg'];
        $c = $_POST['Class'];
        $s = $_POST['Section'];
	   $affected_rows = $db->exec("UPDATE student_table SET  name='$l',Reg='$r',Class='$c',Section='$s' where ID='$n'");
	   $insertId = $db->lastInsertId();
		   echo"<script>alert('Updateข้อมูลเรียบร้อย');</script>";
	   
	   
	 }	
?>
<div class="editbox">
    <?php  if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		foreach($db->query("select * from student_table where ID ='$id'")as $r){
    ?>
    <form method="post" action="">
        <div id="input" class="col">
            <input type="text" name="number" class="form-control" placeholder="ID" value="<?php echo $r['ID']; ?>">
        </div>
        <div class="col">
            <input type="text" name="name" class="form-control" placeholder="name" id="input"
                value="<?php echo $r['NAME']; ?>">
        </div>
        <div class="col">
            <input type="text" name="Reg" class="form-control" placeholder="Reg" id="input"
                value="<?php echo $r['Reg']; ?>">
        </div>
        <div class="col">
            <input type="text" name="Class" class="form-control" placeholder="Class" id="input"
                value="<?php echo $r['Class']; ?>">
        </div>
        <div class="col">
            <input type="text" name="Section" class="form-control" placeholder="Section" id="input"
                value="<?php echo $r['Section']; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo$id;?>">
        <button type="submit" name="edit" class="btn btn-primary" id="input">Update</button>
    </form>
    <?php
	}
}
?>
    <form method="post" action="">
        <div class="form-row">
            <div id="input" class="col">
                <input type="text" name="number" class="form-control" placeholder="ID">
            </div>
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="name" id="input">
            </div>
            <div class="col">
                <input type="text" name="Reg" class="form-control" placeholder="Reg" id="input">
            </div>
            <div class="col">
                <input type="text" name="Class" class="form-control" placeholder="Class" id="input">
            </div>
            <div class="col">
                <input type="text" name="Section" class="form-control" placeholder="Section" id="input">
            </div>
        </div>
        <button type="submit" name="save" class="btn btn-primary" id="input">บันทึก</button>
    </form>
    <div class="table-responsive-xxl">
        <table class="table table-striped">
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>เลขที่</th>
                <th>ชั้น</th>
                <th>เกรด</th>
                <th>สร้างในวัน</th>
                <th>edit</th>
                <th>ลบ</th>
            </tr>
            <?php 
		foreach($db->query("select * from student_table") as $row) {
			$num = $row["ID"];
	?>
            <tr>
                <td><?php echo $row["ID"]; ?></td>
                <td><?php echo $row["NAME"]; ?></td>
                <td><?php echo $row["Reg"]; ?></td>
                <td><?php echo $row["Class"]; ?></td>
                <td><?php echo $row["Section"]; ?></td>
                <td><?php echo $row["CreateAt"]; ?></td>
                <td><a href="admin.php?g=A5&edit=<?php echo $row ['ID']; ?>"><i class="fa-solid fa-wrench"></i></a></td>
                <td><a href="admin.php?g=A5&del=<?php echo $row['ID']; ?>"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php } ?>
        </table>
    </div>