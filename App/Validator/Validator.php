<?php
namespace App\Validator;
class Validator
{
  private $errors = [];
  private $data = [];

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function validate($rules)
  {
    foreach ($rules as $field => $ruleset)
    {
      $fieldValue = isset($this->data[$field]) ? $this->data[$field] : null;
      $rulesArray = explode('|', $ruleset);
      foreach ($rulesArray as $rule) {
        if (strpos($rule, ':') !== false) {
          list ($ruleName, $param) = explode(':', $rule);
          $this->applyRule($field, $ruleName, $param, $fieldValue);
        } else {
          $this->applyRule($field, $rule, null, $fieldValue);
        }
        if (isset($this->errors[$field])) {
          break;
        }
      }
    }
    return empty($this->errors);
  }

  public function applyRule($field, $rule, $param, $value)
  {
    switch ($rule) {
      case 'required':
        if (empty($value)) {
          $this->addError($field, "This field is required.");
        }
        break;
      case 'min':
        if (strlen($value) < $param) {
          $this->addError($field, "This field must be required at least {$param} characters.");
        }
        break;
      case 'string':
        if (!is_string($value)) {
          $this->addError($field, "This field must be a valid string.");
        }
        break;
      case 'email':
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->addError($field, "This field must be a valid email address.");
        }
        break;
      case 'confirmed':
          // Check if the value matches the confirmed field (e.g., password matches password_confirmation)
          if ($value !== $this->data[$param]) {
              $this->addError($field, "The {$field} does not match the confirmation field.");
          }
          break;
      case 'no_special_chars':
        if (!preg_match('/^[a-zA-Z0-9 ]*$/', $value)) {
          $this->addError($field, "This field must not contain special characters.");
        }
        break;
      case 'image_type':
        if(!isset($value['tmp_name']) || empty($value['tmp_name'])) {
          break;
        }
        $allowedTypes = explode(',', $param);
        $extension = strtolower(pathinfo($value['name'], PATHINFO_EXTENSION));
        if(!in_array($extension, $allowedTypes)) {
          $this->addError($field, "This file type must not be allowed.");
        }
        break;
      case 'image_size':
        if (!isset($value['tmp_name']) || empty($value['tmp_name'])) {
          break;
        }
        $maxSize = (int) $param * 1024 * 1024;
        if ($value['size'] > $maxSize) {
          $this->addError($field, "This file type must not be exceed {$param} MB.");
        }
        break;
      default:
        break;
    }
  }

  private function addError($field, $message)
  {
    // Add only if no previous error for the field
    if (!isset($this->errors[$field])) {
      $this->errors[$field] = [];
    }
    
    // Add error message for the field
    $this->errors[$field][] = $message;
  }

  public function getErrors()
  {
    return $this->errors;
  }
}