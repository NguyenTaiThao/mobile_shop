<?php
 require 'SendMail/src/Exception.php';
 require 'SendMail/src/PHPMailer.php';
 require 'SendMail/src/SMTP.php';

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 if(isset($_POST['email'])){
    if($_POST['email'] != ''){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $html = '<div style="border: 1px dotted forestgreen;">
            <h3 align="center">Thông tin khách hàng</h3>
            Họ tên:'. $name .' <br>
            Sđt:'.$phone .' <br>
            email: '.$email .' <br>
            địa chỉ : '.$address .'
            </div>
            <table style="width: 100%;" >
                <thead style="background-color: cornflowerblue;">
                    <tr>
                        <th>Mã Sản phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';

            $str_id = implode(',', $arr_id);
            $query = mysqli_query($con, "SELECT * FROM product WHERE prd_id IN ($str_id)");
            while($row = mysqli_fetch_assoc($query)){
                $sl = $_SESSION['cart'][$row['prd_id']];
                $tien = $sl * $row['prd_price'];
            $html .= '<tr>
            <td>#' . $row['prd_id'] .'</td>
            <td>'.$row['prd_name'] .'</td>
            <td>' . $sl .'</td>
            <td>' . number_format($row['prd_price'],0,'','.') .'</td>
            <td>'. number_format($tien,0,'','.') .'</td>
            </tr>';
            }
            $html .= '<tr style="font-size: 30px; font-weight: bold; color: red;">
                <td >Tổng tiền</td>
                <td  colspan="4" align="right">'.  number_format($total_cash,0,'','.') .'</td>
                        </tr>
                    
                    </tbody>
                </table>
                <p align="center" style="font-weight: bold;">Cảm ơn bạn đã mua hàng bên vietpro</p>';
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'thaonguyentai93@gmail.com';            // SMTP username
                    $mail->Password   = 'wajegytpjmutnmip';                     // SMTP password
                    $mail->SMTPSecure = 'TLS';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to
                    
                    $mail->CharSet = 'UTF-8';                                   // Tranh bi loi tieng viet khi gui mail
                    //Recipients
                    $mail->setFrom('thaonguyentai93@gmail.com', 'BK Shop');
                    $mail->addAddress($email, $name);                            // Add a recipient
                    // Content
                    $mail->isHTML(true);                                         // Set email format to HTML
                    $mail->Subject = 'Xác nhận đơn hàng';
                    $mail->Body    = $html;
            
                    $mail->send();
                    //echo 'Message has been sent';
                    header("location:index.php?page_layout=success");
                    session_destroy();
                }   catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
    }
    
    

?>
<div id="customer">
    <form id="frm" method="post">
        <div class="row">

            <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Họ và tên (bắt buộc)" type="text" name="name" class="form-control" required>
            </div>
            <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone" class="form-control" required>
            </div>
            <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Email (bắt buộc)" type="text" name="email" class="form-control" required>
            </div>
            <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="address"
                    class="form-control" required>
            </div>

        </div>
    </form>
    <div class="row">
        <div class="by-now col-lg-6 col-md-6 col-sm-12">
            <a onclick="buyNow()">
                <b>Mua ngay</b>
                <span>Giao hàng tận nơi siêu tốc</span>
            </a>
        </div>
        <div class="by-now col-lg-6 col-md-6 col-sm-12">
            <a href="#">
                <b>Trả góp Online</b>
                <span>Vui lòng call (+84) 0988 550 553</span>
            </a>
        </div>
    </div>
</div>
<!--	End Customer Info	-->
<script>
    function buyNow(){
        document.getElementById('frm').submit();
    }
</script>