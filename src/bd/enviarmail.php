<?php
include 'conexion.php';
date_default_timezone_set('America/Mexico_City');
$_link = 'http://localhost:3000/login';
$_img = 'https://zictcian.000webhostapp.com/logoTrip.jpeg';
$entrega = date("d/m/Y").' a las '.date("g:i a");
        //$destinatario = "zictcianz@gmail.com";
        $destinatario = $_POST['correo'];
        $key = $_POST['token'];
        if($key=='12345'){
                $nombre=$_POST['nombre'];
                $Apaterno=$_POST['Apaterno'];
                $Amaterno=$_POST['Amaterno'];
                $actividad=$_POST['actividad'];
                if($destinatario){
                        // $nombre = htmlentities($_cons['Nombre'].' '.$_cons['APaterno'].' '.$_cons['AMaterno']);
                        $nombre = htmlentities($nombre.' '.$Apaterno.' '.$Amaterno);
                        $actividad = utf8_decode($actividad);

                        $asunto = $actividad;

                        $cuerpo = "<table id='x_bodyTable' style='border-collapse: collapse; height: 100%; margin: 0px; padding: 0px; width: 100%; transform: scale(0.87); transform-origin: left top 0px;' min-scale='0.87' width='100%' height='100%'
                        cellspacing='0' cellpadding='0' border='0' align='center'><tbody><tr><td id='x_bodyCell' style='height:100%; margin:0; padding:0; width:100%' valign='top' align='center'><table style='border-collapse:collapse' width='100%'
                        cellspacing='0' cellpadding='0' border='0'><tbody><tr><td id='x_templateHeader' style='background:#F7F7F7 none no-repeat center/cover; background-color:#F7F7F7; background-image:none; background-repeat:no-repeat; background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:0px; padding-bottom:0px' valign='top' align='center'><table class='x_templateContainer'
                        style='border-collapse:collapse; max-width:600px!important' width='100%' cellspacing='0' cellpadding='0' border='0' align='center'><tbody><tr><td class='x_headerContainer' style='background:transparent none no-repeat center/cover; background-color:transparent; background-image:none; background-repeat:no-repeat;
                        background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:0; padding-bottom:0' valign='top'></td></tr></tbody></table></td></tr><tr><td id='x_templateBody' style='background:#FFFFFF none no-repeat center/cover; background-color:#FFFFFF; background-image:none; background-repeat:no-repeat; background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:27px; padding-bottom:63px' valign='top' align='center'><table class='x_templateContainer' style='border-collapse:collapse; max-width:600px!important'
                        width='100%' cellspacing='0' cellpadding='0' border='0' align='center'><tbody><tr><td class='x_bodyContainer' style='background:transparent none no-repeat center/cover; background-color:transparent; background-image:none; background-repeat:no-repeat; background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:0; padding-bottom:0' valign='top'><table class='x_mcnTextBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody class='x_mcnTextBlockOuter'><tr><td
                        class='x_mcnTextBlockInner' style='padding-top:9px' valign='top'><table class='x_mcnTextContentContainer' style='max-width:100%; min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0' align='left'><tbody><tr><td class='x_mcnTextContent' style='padding:0px 18px 9px; color:#828282; word-break:break-word; font-family:Helvetica; font-size:16px; line-height:150%; text-align:left' valign='top'></td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnImageBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0'
                        cellpadding='0' border='0'><tbody class='x_mcnImageBlockOuter'><tr><td class='x_mcnImageBlockInner' style='padding:9px' valign='top'><table class='x_mcnImageContentContainer' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0' align='left'><tbody><tr><td class='x_mcnImageContent' style='padding-right:9px; padding-left:9px; padding-top:0; padding-bottom:0; text-align:center' valign='top'>
                        <!-- src='$_img' -->
                        <img data-imagetype='External' src='https://media.istockphoto.com/photos/german-stimulus-packages-after-the-corona-crisis-exchange-wooden-cube-picture-id1313171624?k=20&m=1313171624&s=612x612&w=0&h=N-xzDl1llX-1IlT8WzMruog7313DkWuIa9NL8nmJ6sY=' alt='' class='x_mcnImage' style='width:100%; padding-bottom:0; display:inline!important; vertical-align:bottom;
                        border:0; height:auto; outline:none; text-decoration:none' width='564' align='middle'> </td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnTextBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody class='x_mcnTextBlockOuter'><tr><td class='x_mcnTextBlockInner' style='padding-top:9px' valign='top'><table class='x_mcnTextContentContainer' style='max-width:100%; min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0' align='left'><tbody><tr><td class='x_mcnTextContent' style='padding:0px 18px 9px; font-family:Lato,&quot;
                        Helvetica Neue&quot;,Helvetica,Arial,sans-serif; word-break:break-word; color:#757575; font-size:16px; line-height:150%; text-align:justify' valign='top'><strong>Correo de verificaci&oacute;n</strong><br><br>Estimado(a) <strong> $nombre, </strong> se le notifica que se ha realizado la siguiente actividad respectivamente en el <b>sitio WEB MWReservaci&oacute;n, </b> se ha registrado como un nuevo usuario:<br><strong style='color:brown'>$actividad</strong><br><b>Email del usuario registrado:</b> $destinatario<br><b>Fecha de creaci&oacute;n</b>: $entrega <br><br><br>  </td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnButtonBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0'
                        cellpadding='0' border='0'><tbody class='x_mcnButtonBlockOuter'><tr><td class='x_mcnButtonBlockInner' style='padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px' valign='top' align='center'><table class='x_mcnButtonContentContainer' style='border-collapse:separate!important; border-radius:28px; background-color:#0047FF' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody><tr><td class='x_mcnButtonContent' style=' background: #003d5e; border-radius: 40px; font-family:Arial; font-size:16px; padding:18px' valign='middle' align='center'><a href='$_link' target='_blank' rel='noopener noreferrer' data-auth='NotApplicable' class='x_mcnButton' title='Ir a la Plataforma'
                        style='font-weight:bold; letter-spacing:normal; line-height:100%; text-align:center; text-decoration:none; color:#FFFFFF; display:block'>Ingresar al sitio WEB</a> </td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnDividerBlock' style='min-width:100%; border-collapse:collapse; table-layout:fixed!important' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody class='x_mcnDividerBlockOuter'><tr><td class='x_mcnDividerBlockInner' style='min-width:100%; padding:18px'><table class='x_mcnDividerContent' style='min-width:100%; border-top:2px solid #EAEAEA; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0'>
                        <tbody><tr><td style=''><span style='color:#828282;text-decoration:underline;'>Copyright © 2022 MWReservation. Todos los derechos reservados.</span></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>";

                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= "From: Correo MWReservation <info@procesosus.com>\r\n";
                        $headers .= "Bcc: zictcian@gmail.com\r\n";

                        if(mail($destinatario,$asunto,$cuerpo,$headers)){
                                echo json_encode("Correo registrado exitosamente");
                                $queryResult=$connect->query("SELECT * FROM usuario WHERE usuario.correo='$correo'");
                                $filas = $queryResult->fetch_all(MYSQLI_ASSOC);
                                if(empty($filas)){
                                        $connect->query("UPDATE usuario SET idestatuscuenta='1' WHERE correo = '$destinatario'");
                                        echo json_encode('usuario listo');
                                }else{
                                        echo json_encode('error correo no verificado');
                                }
                        }else{
                                echo json_encode('error');
                        }
                } else{
                        echo json_encode('error');
                }
        } else if($key=='54321'){
                if($destinatario){
                        $queryResult2=$connect->query("SELECT * FROM usuario WHERE usuario.correo='$destinatario'");
                        $fetchData2=$queryResult2->fetch_assoc();
                        if(!empty($fetchData2)){
                                $actividad=$_POST['actividad'];
                                $nombre=$fetchData2['nombre'];
                                $Apaterno=$fetchData2['Apaterno'];
                                $Amaterno=$fetchData2['Amaterno'];
                                $contra=$fetchData2['passencryp'];
                                $pass= base64_decode($contra);
                                // $nombre = htmlentities($_cons['Nombre'].' '.$_cons['APaterno'].' '.$_cons['AMaterno']);
                                $nombre = htmlentities($nombre.' '.$Apaterno.' '.$Amaterno);
                                $actividad = utf8_decode($actividad);

                                $asunto = $actividad;

                                $cuerpo = "<table id='x_bodyTable' style='border-collapse: collapse; height: 100%; margin: 0px; padding: 0px; width: 100%; transform: scale(0.87); transform-origin: left top 0px;' min-scale='0.87' width='100%' height='100%'
                                cellspacing='0' cellpadding='0' border='0' align='center'><tbody><tr><td id='x_bodyCell' style='height:100%; margin:0; padding:0; width:100%' valign='top' align='center'><table style='border-collapse:collapse' width='100%'
                                cellspacing='0' cellpadding='0' border='0'><tbody><tr><td id='x_templateHeader' style='background:#F7F7F7 none no-repeat center/cover; background-color:#F7F7F7; background-image:none; background-repeat:no-repeat; background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:0px; padding-bottom:0px' valign='top' align='center'><table class='x_templateContainer'
                                style='border-collapse:collapse; max-width:600px!important' width='100%' cellspacing='0' cellpadding='0' border='0' align='center'><tbody><tr><td class='x_headerContainer' style='background:transparent none no-repeat center/cover; background-color:transparent; background-image:none; background-repeat:no-repeat;
                                background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:0; padding-bottom:0' valign='top'></td></tr></tbody></table></td></tr><tr><td id='x_templateBody' style='background:#FFFFFF none no-repeat center/cover; background-color:#FFFFFF; background-image:none; background-repeat:no-repeat; background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:27px; padding-bottom:63px' valign='top' align='center'><table class='x_templateContainer' style='border-collapse:collapse; max-width:600px!important'
                                width='100%' cellspacing='0' cellpadding='0' border='0' align='center'><tbody><tr><td class='x_bodyContainer' style='background:transparent none no-repeat center/cover; background-color:transparent; background-image:none; background-repeat:no-repeat; background-position:center; background-size:cover; border-top:0; border-bottom:0; padding-top:0; padding-bottom:0' valign='top'><table class='x_mcnTextBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody class='x_mcnTextBlockOuter'><tr><td
                                class='x_mcnTextBlockInner' style='padding-top:9px' valign='top'><table class='x_mcnTextContentContainer' style='max-width:100%; min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0' align='left'><tbody><tr><td class='x_mcnTextContent' style='padding:0px 18px 9px; color:#828282; word-break:break-word; font-family:Helvetica; font-size:16px; line-height:150%; text-align:left' valign='top'></td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnImageBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0'
                                cellpadding='0' border='0'><tbody class='x_mcnImageBlockOuter'><tr><td class='x_mcnImageBlockInner' style='padding:9px' valign='top'><table class='x_mcnImageContentContainer' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0' align='left'><tbody><tr><td class='x_mcnImageContent' style='padding-right:9px; padding-left:9px; padding-top:0; padding-bottom:0; text-align:center' valign='top'>
                                <!-- src='$_img' -->
                                <img data-imagetype='External' src='https://media.istockphoto.com/photos/german-stimulus-packages-after-the-corona-crisis-exchange-wooden-cube-picture-id1313171624?k=20&m=1313171624&s=612x612&w=0&h=N-xzDl1llX-1IlT8WzMruog7313DkWuIa9NL8nmJ6sY=' alt='' class='x_mcnImage' style='width:100%; padding-bottom:0; display:inline!important; vertical-align:bottom;
                                border:0; height:auto; outline:none; text-decoration:none' width='564' align='middle'> </td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnTextBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody class='x_mcnTextBlockOuter'><tr><td class='x_mcnTextBlockInner' style='padding-top:9px' valign='top'><table class='x_mcnTextContentContainer' style='max-width:100%; min-width:100%; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0' align='left'><tbody><tr><td class='x_mcnTextContent' style='padding:0px 18px 9px; font-family:Lato,&quot;
                                Helvetica Neue&quot;,Helvetica,Arial,sans-serif; word-break:break-word; color:#757575; font-size:16px; line-height:150%; text-align:justify' valign='top'><strong>Correo de verificaci&oacute;n</strong><br><br>Estimado(a) <strong> $nombre, </strong> se le notifica que se ha realizado la siguiente actividad respectivamente en el <b>sitio WEB MWReservaci&oacute;n, </b> se ha solicitado el recordar el password<br><strong style='color:brown'>$actividad</strong><br><b>Email del usuario registrado:</b> $destinatario<br><b>Fecha de creaci&oacute;n</b>: $entrega <br><b>Password</b>: $pass <br><br><br>  </td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnButtonBlock' style='min-width:100%; border-collapse:collapse' width='100%' cellspacing='0'
                                cellpadding='0' border='0'><tbody class='x_mcnButtonBlockOuter'><tr><td class='x_mcnButtonBlockInner' style='padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px' valign='top' align='center'><table class='x_mcnButtonContentContainer' style='border-collapse:separate!important; border-radius:28px; background-color:#0047FF' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody><tr><td class='x_mcnButtonContent' style=' background: #003d5e; border-radius: 40px; font-family:Arial; font-size:16px; padding:18px' valign='middle' align='center'><a href='$_link' target='_blank' rel='noopener noreferrer' data-auth='NotApplicable' class='x_mcnButton' title='Ir a la Plataforma'
                                style='font-weight:bold; letter-spacing:normal; line-height:100%; text-align:center; text-decoration:none; color:#FFFFFF; display:block'>Ingresar al sitio WEB</a> </td></tr></tbody></table></td></tr></tbody></table><table class='x_mcnDividerBlock' style='min-width:100%; border-collapse:collapse; table-layout:fixed!important' width='100%' cellspacing='0' cellpadding='0' border='0'><tbody class='x_mcnDividerBlockOuter'><tr><td class='x_mcnDividerBlockInner' style='min-width:100%; padding:18px'><table class='x_mcnDividerContent' style='min-width:100%; border-top:2px solid #EAEAEA; border-collapse:collapse' width='100%' cellspacing='0' cellpadding='0' border='0'>
                                <tbody><tr><td style=''><span style='color:#828282;text-decoration:underline;'>Copyright © 2022 MWReservation. Todos los derechos reservados.</span></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>";

                                $headers = "MIME-Version: 1.0\r\n";
                                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                                $headers .= "From: Correo MWReservation <info@procesosus.com>\r\n";
                                $headers .= "Bcc: zictcian@gmail.com\r\n";

                                if(mail($destinatario,$asunto,$cuerpo,$headers)){
                                        echo json_encode('Correo enviado exitosamente');
                                }else{
                                        echo json_encode('error');
                                }
                        }else{
                                echo json_encode('error');
                        }
                } else{
                        echo json_encode('error');
                }
        }else{
                echo json_encode('error');
        }
?>