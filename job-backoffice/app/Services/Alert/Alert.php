<?php
namespace App\Services\Alert;

class Alert
{
  public string $type; // success, warning, danger, info
  public string $title;
  public string $message;
  public ?array $primaryButton;
  public ?array $secondaryButton;
  public string $icon;
  public function __construct(
    string $type,
    string $title,
    string $message,
    string $icon,
    ?array $primaryButton = null,
    ?array $secondaryButton = null
  ) {
    $this->type = $type;
    $this->title = $title;
    $this->message = $message;
    $this->icon = $icon;
    $this->primaryButton = $primaryButton;
    $this->secondaryButton = $secondaryButton;
  }
  public static function success(string $title, string $message, string $icon, ?array $primary = null, ?array $secondary = null): self
  {
    return new self('success', $title, $message, $icon, $primary, $secondary);
  }

  public static function danger(string $title, string $message, string $icon, ?array $primary = null, ?array $secondary = null): self
  {
    return new self('danger', $title, $message, $icon, $primary, $secondary);
  }

  public static function warning(string $title, string $message, string $icon, ?array $primary = null, ?array $secondary = null): self
  {
    return new self('warning', $title, $message, $icon, $primary, $secondary);
  }

  public static function info(string $title, string $message, string $icon, ?array $primary = null, ?array $secondary = null): self
  {
    return new self('info', $title, $message, $icon, $primary, $secondary);
  }
  public function toArray(): array
  {
    return [
      'type' => $this->type,
      'title' => $this->title,
      'message' => $this->message,
      'icon' => $this->icon,
      'primaryButton' => $this->primaryButton,
      'secondaryButton' => $this->secondaryButton,
    ];
  }
}