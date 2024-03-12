<?php

class ClassPHP {
    public function generarCodigo($longitud = 10) {
        $bytes = random_bytes($longitud);
        return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $longitud);
    }

    public function send_code($email, $code) {
        $to = $email;
        $subject = "Verificación de tu cuenta";
        $logoPath = "../../resources/img/fav.png"; // Ruta relativa a la imagen del logo
    
        // Leer el archivo de la imagen
        $fileContent = file_get_contents($logoPath);
        $fileContentEncoded = chunk_split(base64_encode($fileContent));
        $fileMimeType = mime_content_type($logoPath);
        $fileName = basename($logoPath);
    
        // Definir el delimitador de contenido relacionado
        $boundary = md5(time());
    
        // Construir el mensaje HTML
        $htmlMessage = "
            <html>
            <head>
                <style>
                    body {font-family: Arial, sans-serif;}
                    .logo {width: 200px;}
                    .code {color: red; font-weight: bold;}
                </style>
            </head>
            <body>
                <p>¡Gracias por registrarte! Tu código de verificación es: <span class='code'>$code</span></p>
                <center><img src='cid:$fileName' class='logo' alt='Logo'></center>
            </body>
            </html>
        ";
    
        // Construir el mensaje MIME multipart
        $message = "--$boundary\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message .= chunk_split(base64_encode($htmlMessage));
        $message .= "--$boundary\r\n";
        $message .= "Content-Type: $fileMimeType; name=\"$fileName\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-ID: <$fileName>\r\n";
        $message .= "Content-Disposition: inline; filename=\"$fileName\"\r\n\r\n";
        $message .= "$fileContentEncoded\r\n\r\n";
        $message .= "--$boundary--";
    
        // Definir los encabezados
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From: Tu Nombre <tu@email.com>\r\n"; // Ajusta el remitente según tus necesidades
        $headers .= "Content-Type: multipart/related; boundary=\"$boundary\"\r\n";
    
        // Enviar el correo electrónico
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }




}

?>