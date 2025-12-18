<?php

class Contact {
private $contacts_file = 'contacts.json';

private $errors = array();


 public function validate($data) {
        $this->errors = array();
        
        // Validate firstname
        if (empty($data['firstname'])) {
            $this->errors[] = "First name is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['firstname'])) {
            $this->errors[] = "Only letters and spaces allowed in first name";
        }
        
        // Validate lastname
        if (empty($data['lastname'])) {
            $this->errors[] = "Last name is required";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['lastname'])) {
            $this->errors[] = "Only letters and spaces allowed in last name";
        }
        
        // Validate email
        if (empty($data['email'])) {
            $this->errors[] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid email format";
        }
            // Validate subject
        if (empty($data['subject'])) {
            $this->errors[] = "Subject is required";
        } elseif (!preg_match("/^[a-zA-Z0-9 .,!?'-]*$/", $data['subject'])) {
            $this->errors[] = "Invalid subject format";
        }
        
        return empty($this->errors);
    }
    



public function getErrors() {
    return $this->errors;   }


public function getAll(){
    if (file_exists($this->contacts_file)) {
        $json_data = file_get_contents($this->contacts_file);
        $contacts = json_decode($json_data, true);
        if (is_array($contacts)) {
            return $contacts;
        }
    }
    return array();
}

    public function save($data){
              $contactData = array(
            'firstname' => htmlspecialchars($data['firstname']),
            'lastname' => htmlspecialchars($data['lastname']),
            'email' => htmlspecialchars($data['email']),
            'subject' => htmlspecialchars($data['subject']),
            'country' => htmlspecialchars($data['country']),
            'date' => date('Y-m-d H:i:s')
        );
        
        $contacts = $this->getAll();
        $contacts[] = $contactData;
        
        file_put_contents($this->contacts_file, json_encode($contacts, JSON_PRETTY_PRINT));
        return true;
    }

}