<?php
class Texts {
  public $userButton;
  public $itemButton;
  public $loanButton;

  function setUser($input) {
    $this->userButton = $input;
  }

  function setItem($input) {
    $this->itemButton = $input;
  }

  function setLoan($input) {
    $this->loanButton = $input;
  }

  function getUser() {
    return $this->userButton;
  }

  function getItem() {
    return $this->itemButton;
  }

  function getLoan() {
    return $this->loanButton;
  }
}

  $texts = new Texts();
  $texts->setUser("Visa Pokemon");
  $texts->setItem("Lägg till Pokemon/Model");
  $texts->setLoan("Ta bort Pokemon");
?>