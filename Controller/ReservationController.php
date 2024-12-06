<?php
require_once 'C:/xampp/htdocs/crud_reservation/Model/ReservationModel.php';
require_once 'C:/xampp/htdocs/crud_reservation/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ReservationController {
    public function handleReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            try {
                // Retrieve and sanitize form data
                $nom_client = htmlspecialchars($_POST['nom_client']);
                $email_nutritioniste = filter_var($_POST['email_nutritioniste'], FILTER_SANITIZE_EMAIL);
                $date_reservation = $_POST['date_reservation'];
                $heure_reservation = $_POST['heure_reservation'];

                // Handle file upload and get image path
                $imagePath = $this->uploadImage($_FILES['image']);

                // Validate form data
                $errors = $this->validateReservation($nom_client, $email_nutritioniste, $date_reservation, $heure_reservation, $imagePath);

                if (empty($errors)) {
                    // Save reservation using the model
                    $result = Reservation::createReservation($nom_client, $email_nutritioniste, $date_reservation, $heure_reservation, $imagePath);

                    if ($result) {
                        // Send confirmation email to the user
                        $this->sendConfirmationEmail($email_nutritioniste, $nom_client, $date_reservation, $heure_reservation);

                        echo "<script>alert('Réservation effectuée avec succès !'); window.location.href='display.php';</script>";
                    } else {
                        throw new Exception("Erreur lors de l'enregistrement de la réservation.");
                    }
                } else {
                    foreach ($errors as $error) {
                        echo "<script>alert('$error');</script>";
                    }
                }
            } catch (Exception $e) {
                // Display error message
                echo "<script>alert('Erreur : " . $e->getMessage() . "');</script>";
            }
        }
    }

    public static function getAllReservations() {
        $pdo = Config::getConnexion(); // Use the config for database connection
        $sql = "SELECT * FROM reservation";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Send confirmation email
    private function sendConfirmationEmail($email, $nom_client, $date_reservation, $heure_reservation) {
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'hsiniahmed90@gmail.com'; // Your email
            $mail->Password = 'axam ueum cegg ddfy'; // Your password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            //Recipients
            $mail->setFrom('hsiniahmed90@gmail.com', 'HYGEIA');
            $mail->addAddress($email);
    
            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Confirmation de votre réservation chez HYGEIA';
            $mail->Body    = "
                <html>
                <head>
                    <title>Confirmation de Réservation</title>
                </head>
                <body>
                    <h2>Bonjour $nom_client,</h2>
                    <p>Nous vous confirmons votre réservation chez HYGEIA.</p>
                    <p><strong>Date:</strong> $date_reservation</p>
                    <p><strong>Heure:</strong> $heure_reservation</p>
                    <p>Merci de nous avoir choisis!</p>
                    <p>Cordialement,</p>
                    <p>HYGEIA</p>
                </body>
                </html>
            ";
    
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    // Handle file upload securely
    private function uploadImage($imageFile) {
        $uploadDir = 'uploads/';
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 2 * 1024 * 1024; // Max file size: 2 MB
    
        // Check for upload errors
        if ($imageFile['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Erreur lors du téléchargement du fichier. Code d\'erreur: ' . $imageFile['error']);
        }
    
        // Validate file size
        if ($imageFile['size'] > $maxFileSize) {
            throw new Exception('Le fichier dépasse la taille maximale autorisée de 2 Mo.');
        }
    
        // Validate file extension
        $fileExtension = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new Exception('Le format du fichier est invalide. Formats autorisés : jpg, jpeg, png, gif.');
        }
    
        // Generate a unique file name
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uniqueFileName;
    
        // Create upload directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        // Move file to upload directory
        if (!move_uploaded_file($imageFile['tmp_name'], $uploadPath)) {
            throw new Exception('Erreur lors du déplacement du fichier téléchargé.');
        }
    
        return $uploadPath;
    }
    

    // Validate reservation input data
    private function validateReservation($nom_client, $email_nutritioniste, $date_reservation, $heure_reservation, $imagePath) {
        $errors = [];

        if (empty($nom_client)) {
            $errors[] = "Le nom du client est obligatoire.";
        }
        if (empty($email_nutritioniste) || !filter_var($email_nutritioniste, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email du nutritionniste est invalide.";
        }
        if (empty($date_reservation) || strtotime($date_reservation) < strtotime(date("Y-m-d"))) {
            $errors[] = "La date de réservation ne peut pas être dans le passé.";
        }
        if (empty($heure_reservation) || !preg_match("/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/", $heure_reservation)) {
            $errors[] = "L'heure de réservation doit être au format valide (HH:MM).";
        }
        if (empty($imagePath)) {
            $errors[] = "L'image est obligatoire et doit être téléchargée correctement.";
        }

        return $errors;
    }
    public function handleUpdateReservation($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom_client = htmlspecialchars($_POST['nom_client']);
            $email_nutritioniste = filter_var($_POST['email_nutritioniste'], FILTER_SANITIZE_EMAIL);
            $date_reservation = $_POST['date_reservation'];
            $heure_reservation = $_POST['heure_reservation'];

            // Update reservation
            $success = Reservation::updateReservation(
                $id, 
                $nom_client, 
                $email_nutritioniste, 
                $date_reservation, 
                $heure_reservation
            );

            if ($success) {
                header("Location: display.php");
                exit();
            } else {
                echo "Erreur lors de la mise à jour de la réservation.";
            }
        }
    }

    public function getReservationDetails($id) {
        return Reservation::getReservationById($id);
    }
    public function deleteReservation() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Ensure the ID is an integer

            try {
                // Call the Model to delete the reservation
                $result = Reservation::deleteReservation($id);

                if ($result) {
                    header("Location: display.php");
                    exit();
                } else {
                    throw new Exception("Erreur lors de la suppression de la réservation.");
                }
            } catch (Exception $e) {
                // Display error message
                echo "<script>alert('Erreur : " . $e->getMessage() . "');</script>";
            }
        } else {
            echo "<script>alert('ID de réservation non spécifié.');</script>";
        }
    }
}
