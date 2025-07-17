<?php 
	if(isset($_POST['save']))
	  {
		$n1 = $_POST['number'];
		$a = $_POST['list1'];
        $b = $_POST['list2'];
        $c = $_POST['list3'];
        $d = $_POST['list4'];
        $e = $_POST['list5'];
        $f = $_POST['list6'];
        $g = $_POST['list7'];
        $h = $_POST['list8'];
        $i = $_POST['list9'];
        $j = $_POST['list10'];
        $k = $_POST['list11'];
        $l = $_POST['list12'];
        $m = $_POST['list13'];
        $n = $_POST['list14'];
        $o = $_POST['list15'];
        $p = $_POST['list16'];
        $q = $_POST['list17'];
        $r = $_POST['list18'];
        $s = $_POST['list19'];
        $t = $_POST['list20'];

        $a1 = $_POST['price1'];
        $a2 = $_POST['price2'];
        $a3 = $_POST['price3'];
        $a4 = $_POST['price4'];
        $a5 = $_POST['price5'];
        $a6 = $_POST['price6'];
        $a7 = $_POST['price7'];
        $a8 = $_POST['price8'];
        $a9 = $_POST['price9'];
        $a10 = $_POST['price10'];
        $a11 = $_POST['price11'];
        $a12 = $_POST['price12'];
        $a13 = $_POST['price13'];
        $a14 = $_POST['price14'];
        $a15 = $_POST['price15'];
        $a16 = $_POST['price16'];
        $a17 = $_POST['price17'];
        $a18 = $_POST['price18'];
        $a19 = $_POST['price19'];
        $a20 = $_POST['price20'];


        $result = $db->exec("INSERT INTO products (ID, list1, list2, list3, list4, list5, list6, list7, list8, list9, list10, list11, list12, list13, list14, list15, list16, list17, list18, list19, list20, price1, price2, price3, price4, price5, price6, price7, price8, price9, price10, price11, price12, price13, price14, price15, price16, price17, price18, price19, price20)
        VALUES ('$n1', '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$m', '$n', '$o', '$p', '$q', '$r', '$s', '$t', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$a11', '$a12', '$a13', '$a14', '$a15', '$a16', '$a17', '$a18', '$a19', '$a20')");
            $insertId = $db->lastInsertId();
            if ($insertId) {
                echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');</script>";
            } else {
                echo "<script>alert('ไม่สามารถเพิ่มข้อมูลได้');</script>";
            }
        }
        

      if(isset($_GET['del'])){
		$id=$_GET['del'];
		$stmt = $db->prepare("DELETE FROM products WHERE ID=:id");
		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		echo "<script>
				alert('ลบข้อมูลเรียบร้อย');
				             </script>";
	 }
	 if(isset($_POST['edit']))
	 {
		$n1 = $_POST['number'];
		$a = $_POST['list1'];
        $b = $_POST['list2'];
        $c = $_POST['list3'];
        $d = $_POST['list4'];
        $e = $_POST['list5'];
        $f = $_POST['list6'];
        $g = $_POST['list7'];
        $h = $_POST['list8'];
        $i = $_POST['list9'];
        $j = $_POST['list10'];
        $k = $_POST['list11'];
        $l = $_POST['list12'];
        $m = $_POST['list13'];
        $n = $_POST['list14'];
        $o = $_POST['list15'];
        $p = $_POST['list16'];
        $q = $_POST['list17'];
        $r = $_POST['list18'];
        $s = $_POST['list19'];
        $t = $_POST['list20'];
       
        $a1 = $_POST['price1'];
        $a2 = $_POST['price2'];
        $a3 = $_POST['price3'];
        $a4 = $_POST['price4'];
        $a5 = $_POST['price5'];
        $a6 = $_POST['price6'];
        $a7 = $_POST['price7'];
        $a8 = $_POST['price8'];
        $a9 = $_POST['price9'];
        $a10 = $_POST['price10'];
        $a11 = $_POST['price11'];
        $a12 = $_POST['price12'];
        $a13 = $_POST['price13'];
        $a14 = $_POST['price14'];
        $a15 = $_POST['price15'];
        $a16 = $_POST['price16'];
        $a17 = $_POST['price17'];
        $a18 = $_POST['price18'];
        $a19 = $_POST['price19'];
        $a20 = $_POST['price20'];

	    $affected_rows = $db->exec("UPDATE products SET list1='$a', list2='$b', list3='$c', list4='$d', list5='$e', list6='$f', list7='$g', list8='$h', list9='$i', list10='$j', list11='$k', list12='$l', list13='$m', list14='$n', list15='$o', list16='$p', list17='$q', list18='$r', list19='$s', list20='$t', price1='$a1', price2='$a2', price3='$a3', price4='$a4', price5='$a5', price6='$a6', price7='$a7', price8='$a8', price9='$a9', price10='$a10', price11='$a11', price12='$a12', price13='$a13', price14='$a14', price15='$a15', price16='$a16', price17='$a17', price18='$a18', price19='$a19', price20='$a20' WHERE ID='$n1'");
    $insertId = $db->lastInsertId();
    echo "<script>alert('Updateข้อมูลเรียบร้อย');</script>";
}
?>

<div class="editbox">
    <?php  if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		foreach($db->query("select * from products where ID ='$id'")as $r){
    ?>
    <form method="post" action="">
        <div id="input" class="col">
            <input type="text" name="number" class="form-control" placeholder="ID" value="<?php echo $r['ID']; ?>">
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list1" class="form-control" placeholder="list1" id="input"
                    value="<?php echo $r['list1']; ?>">
                <input type="text" name="price1" class="form-control" placeholder="price1" id="input"
                    value="<?php echo $r['price1']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list2" class="form-control" placeholder="list2" id="input"
                    value="<?php echo $r['list2']; ?>">
                <input type="text" name="price2" class="form-control" placeholder="price2" id="input"
                    value="<?php echo $r['price2']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list3" class="form-control" placeholder="list3" id="input"
                    value="<?php echo $r['list3']; ?>">
                <input type="text" name="price3" class="form-control" placeholder="price3" id="input"
                    value="<?php echo $r['price3']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list4" class="form-control" placeholder="list4" id="input"
                    value="<?php echo $r['list4']; ?>">
                <input type="text" name="price4" class="form-control" placeholder="price4" id="input"
                    value="<?php echo $r['price4']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list5" class="form-control" placeholder="list5" id="input"
                    value="<?php echo $r['list5']; ?>">
                <input type="text" name="price5" class="form-control" placeholder="price5" id="input"
                    value="<?php echo $r['price5']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list6" class="form-control" placeholder="list6" id="input"
                    value="<?php echo $r['list6']; ?>">
                <input type="text" name="price6" class="form-control" placeholder="price6" id="input"
                    value="<?php echo $r['price6']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list7" class="form-control" placeholder="list7" id="input"
                    value="<?php echo $r['list7']; ?>">
                <input type="text" name="price7" class="form-control" placeholder="price7" id="input"
                    value="<?php echo $r['price7']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list8" class="form-control" placeholder="list8" id="input"
                    value="<?php echo $r['list8']; ?>">
                <input type="text" name="price8" class="form-control" placeholder="price8" id="input"
                    value="<?php echo $r['price8']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list9" class="form-control" placeholder="list9" id="input"
                    value="<?php echo $r['list9']; ?>">
                <input type="text" name="price9" class="form-control" placeholder="price9" id="input"
                    value="<?php echo $r['price9']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list10" class="form-control" placeholder="list10" id="input"
                    value="<?php echo $r['list10']; ?>">
                <input type="text" name="price10" class="form-control" placeholder="price10" id="input"
                    value="<?php echo $r['price10']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list11" class="form-control" placeholder="list11" id="input"
                    value="<?php echo $r['list11']; ?>">
                <input type="text" name="price11" class="form-control" placeholder="price11" id="input"
                    value="<?php echo $r['price11']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list12" class="form-control" placeholder="list12" id="input"
                    value="<?php echo $r['list12']; ?>">
                <input type="text" name="price12" class="form-control" placeholder="price12" id="input"
                    value="<?php echo $r['price12']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list13" class="form-control" placeholder="list13" id="input"
                    value="<?php echo $r['list13']; ?>">
                <input type="text" name="price13" class="form-control" placeholder="price13" id="input"
                    value="<?php echo $r['price13']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list14" class="form-control" placeholder="list14" id="input"
                    value="<?php echo $r['list14']; ?>">
                <input type="text" name="price14" class="form-control" placeholder="price15" id="input"
                    value="<?php echo $r['price14']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list15" class="form-control" placeholder="list15" id="input"
                    value="<?php echo $r['list15']; ?>">
                <input type="text" name="price15" class="form-control" placeholder="price15" id="input"
                    value="<?php echo $r['price15']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list16" class="form-control" placeholder="list16" id="input"
                    value="<?php echo $r['list16']; ?>">
                <input type="text" name="price16" class="form-control" placeholder="price16" id="input"
                    value="<?php echo $r['price16']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list17" class="form-control" placeholder="list17" id="input"
                    value="<?php echo $r['list17']; ?>">
                <input type="text" name="price17" class="form-control" placeholder="price17" id="input"
                    value="<?php echo $r['price17']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list18" class="form-control" placeholder="list18" id="input"
                    value="<?php echo $r['list18']; ?>">
                <input type="text" name="price18" class="form-control" placeholder="price18" id="input"
                    value="<?php echo $r['price18']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list19" class="form-control" placeholder="list19" id="input"
                    value="<?php echo $r['list19']; ?>">
                <input type="text" name="price19" class="form-control" placeholder="price19" id="input"
                    value="<?php echo $r['price19']; ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <input type="text" name="list20" class="form-control" placeholder="list20" id="input"
                    value="<?php echo $r['list20']; ?>">
                <input type="text" name="price20" class="form-control" placeholder="price20" id="input"
                    value="<?php echo $r['price20']; ?>">
            </div>
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
                <div class="row">
                    <input type="text" name="number" class="form-control" placeholder="ID">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list1" class="form-control" placeholder="list1" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price1" class="form-control" placeholder="price1" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list2" class="form-control" placeholder="list2" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price2" class="form-control" placeholder="price2" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list3" class="form-control" placeholder="list3" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price3" class="form-control" placeholder="price3" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list4" class="form-control" placeholder="list4" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price4" class="form-control" placeholder="price4" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list5" class="form-control" placeholder="list5" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price5" class="form-control" placeholder="price5" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list6" class="form-control" placeholder="list6" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price6" class="form-control" placeholder="price6" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list7" class="form-control" placeholder="list7" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price7" class="form-control" placeholder="price7" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list8" class="form-control" placeholder="list8" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price8" class="form-control" placeholder="price8" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list9" class="form-control" placeholder="list9" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price9" class="form-control" placeholder="price9" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list10" class="form-control" placeholder="list10" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price10" class="form-control" placeholder="price10" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list11" class="form-control" placeholder="list11" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price11" class="form-control" placeholder="price11" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list12" class="form-control" placeholder="list12" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price12" class="form-control" placeholder="price12" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list13" class="form-control" placeholder="list13" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price13" class="form-control" placeholder="price13" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list14" class="form-control" placeholder="list14" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price14" class="form-control" placeholder="price14" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list15" class="form-control" placeholder="list15" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price15" class="form-control" placeholder="price15" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list16" class="form-control" placeholder="list16" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price16" class="form-control" placeholder="price16" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list17" class="form-control" placeholder="list17" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price17" class="form-control" placeholder="price17" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list18" class="form-control" placeholder="list18" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price18" class="form-control" placeholder="price18" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list19" class="form-control" placeholder="list19" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price19" class="form-control" placeholder="price19" id="input">
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <input type="text" name="list20" class="form-control" placeholder="list20" id="input">
                </div>
                <div class="col">
                    <input type="text" name="price20" class="form-control" placeholder="price20" id="input">
                </div>
            </div>

        </div>
        <button type="submit" name="save" class="btn btn-primary" id="input">บันทึก</button>
    </form>