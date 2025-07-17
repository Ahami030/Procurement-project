  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" onload="setStartDate(); setEndDate();">
                        
                                                <?php
                                                // เชื่อมต่อกับ MySQL Database
                                                $servername = "localhost";
                                                $username = "root";
                                                $password = "";
                                                $dbname = "user_registration";
                        
                                                $conn = new mysqli($servername, $username, $password, $dbname);
                        
                                                // ตรวจสอบการเชื่อมต่อ
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }
                        
                                                if (isset($_POST["save2"])) {
                        
                                                    // รับข้อมูลจากฟอร์ม
                                                    $name = $_POST['name'];
                                                    $date_start = date('Y-m-d'); // ตั้งค่า date_start เป็นวันที่ปัจจุบัน
                                                
                                                    // คำนวณวันที่ date_end โดยเพิ่ม 30 วันจากวันปัจจุบัน
                                                    $date_end = date('Y-m-d', strtotime('+30 days'));
                        
                                                    $company_name = $_POST['company_name2'];
                        
                                                    // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูล
                                                    $sql = "INSERT INTO db_checker (name, date_start, date_end, company_name) VALUES ('$name', '$date_start', '$date_end', '$company_name')";
                        
                                                    if ($conn->query($sql) === TRUE) {
                                                        echo '<div class="alert alert-success" role="alert">บิลถูกเพิ่มเรียบร้อยแล้ว</div>';
                                                    } else {
                                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                                    }
                                                }
                                                $conn->close();
                                                ?>
                                                <!-- Modal content goes here -->
                                                <form action="" method="post">
                                                    <input type="hidden" id="ID_member" name="ID_member"
                                                        value="<?php echo $submittedID_member ?>">
                        
                                                    <div class="col mt-2 mb-2">
                                                        <label for="company_name2">ชื่อบริษัท</label>
                                                        <input type="text" id="company_name2" class="form-control" name="company_name2">
                                                    </div>
                        
                                                    <div class="col mt-2 mb-2">
                                                        <label for="date_start">วันที่เริ่มต้น</label>
                                                        <input type="date" id="date_start" class="form-control" name="date_start">
                                                    </div>
                                                    <div class="col mt-2 mb-2">
                                                        <label for="date_end">วันที่สิ้นสุด</label>
                                                        <input type="date" id="date_end" class="form-control" name="date_end">
                                                    </div>
                        
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="save2">
                                                            submit
                                                        </button>
                                                        <!-- Additional modal buttons can be added here -->
                                                    </div>
                        
                                                </form>
                        
                                            </div>
                                        </div>
                                    </div>
                                </div>