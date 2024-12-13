<?php
require_once 'C:/xampp/htdocs/frm5/config.php';  
require_once 'C:/xampp/htdocs/frm5/model/FormationModel.php';  
require_once 'C:/xampp/htdocs/frm5/PHPMailer-master/PHPMailerAutoload.php';

class FormationController
{
    // Méthode pour récupérer toutes les formations
    public function listFormations()
    {
        $sql = "SELECT * FROM formation"; 
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour trier les formations par durée croissante
    public function sortByDureeAsc()
    {
        $sql = "SELECT * FROM formation ORDER BY duree ASC";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour trier les formations par durée décroissante
    public function sortByDureeDesc()
    {
        $sql = "SELECT * FROM formation ORDER BY duree DESC";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    // Reste de votre code...

    // Méthode pour supprimer une formation
    public function deleteFormation($id_f)
    {
        $sql = "DELETE FROM formation WHERE id_f = :id_f"; 
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_f', $id_f);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour ajouter une formation et envoyer un e-mail au formateur
    public function addFormation($formation)
    {
        $sql = "INSERT INTO formation (titre, disc, duree, nom_f, pre_f, email_f)  
        VALUES (:titre, :disc, :duree, :nom_f, :pre_f, :email_f)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $formation->getTitre(),
                'disc' => $formation->getDisc(),
                'duree' => $formation->getDuree(),
                'nom_f' => $formation->getNomF(),
                'pre_f' => $formation->getPreF(),
                'email_f' => $formation->getEmailF()
            ]);

            // Envoi de l'e-mail au formateur
            $this->sendmail($formation->getEmailF());

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour une formation
    public function updateFormation($formation, $id_f)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE formation SET 
                    titre = :titre,
                    disc = :disc,
                    duree = :duree,
                    nom_f = :nom_f,
                    pre_f = :pre_f,
                    email_f = :email_f
                WHERE id_f = :id_f'
            );

            $query->execute([
                'id_f' => $id_f,
                'titre' => $formation->getTitre(),
                'disc' => $formation->getDisc(),
                'duree' => $formation->getDuree(),
                'nom_f' => $formation->getNomF(),
                'pre_f' => $formation->getPreF(),
                'email_f' => $formation->getEmailF()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    // Méthode pour afficher une formation par son ID
    public function showFormation($id_f)
    {
        $sql = "SELECT * FROM formation WHERE id_f = :id_f"; 
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_f', $id_f);
            $query->execute();

            $formation = $query->fetch();
            return $formation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour rechercher une formation par titre
    public function recherchertitre($titre) 
    {
        $db = Config::getConnexion();
        $stmt = $db->prepare("SELECT * FROM formation WHERE titre LIKE ?");
        $stmt->execute(['%' . $titre . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour envoyer un e-mail au formateur
    private function sendmail($email_f)
    {
        $mailto = $email_f;  // Utilisation de l'email du formateur
        $mailSub = 'hygeia';
        $mailMsg = 'Bonjour, une nouvelle formation a été ajoutée et vous êtes le formateur de cette formation. Merci beaucoup!';

        $mail = new PHPMailer();
        $mail->IsSmtp();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // Utiliser le port 465 pour SSL
        $mail->IsHTML(true);
        $mail->Username = "yassinnjeh11@gmail.com";
        $mail->Password = "izgkiqnjlnqbfmae";  // Sensible : Utiliser des variables d'environnement si possible
        $mail->SetFrom("yassinnjeh11@gmail.com");
        $mail->Subject = $mailSub;
        $mail->Body = $mailMsg;
        $mail->AddAddress($mailto);
        
        if (!$mail->Send()) {
            echo "Le mail n'a pas été envoyé.";
        } else {
            echo "E-mail envoyé avec succès au formateur.";
        }
    }
}
?>