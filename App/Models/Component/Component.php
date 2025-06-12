<?php
  namespace App\Models\Component;

  class Component
  {

    public static function Input(
        string $typeInput,
        string $nameInput,
        ?string $placeholderInput,
        ?string $classInput,
        ?string $idInput,
    ):string{
        return <<<HTML
        <input 
          type="$typeInput" 
          name="$nameInput" 
          class="$classInput" 
          placeholder="$placeholderInput" 
          id="$idInput"
        >
        HTML;
    }
    public static function Button(
      string $typeButton,
      string $titleButton , 
      ?string $classButton ='btn', 
      ?string $idButton = "id"
    ):string
    {
      return <<<HTML
         <button type="$typeButton" class="$classButton"  id="$idButton">$titleButton</button>
      HTML;
    }
    public static function P(string $valueP,?string $classP,?string $styleP):string
    {
      return <<<HTML
        <p style="$styleP" class="$classP">$valueP</p>
      HTML;
    }

    //ici ca doit avoir un tableau associatif avec les valeurs et les labels
    //exemple : ['value1' => 'Label 1', 'value2' => 'Label 2']
    public static function Select(
      string $nameSelect,
      array $optionsSelect,
      ?string $classSelect = 'form-select',
      ?string $idSelect = 'id'
    ):string
    {
      $optionsHtml = '';
      foreach ($optionsSelect as $value => $label) {
        $optionsHtml .= "<option value=\"$value\">$label</option>";
      }
      return <<<HTML
        <select name="$nameSelect" class="$classSelect" id="$idSelect">
          $optionsHtml
        </select>
      HTML;
    }
    public static function TextArea(
      string $nameTextArea,
      ?string $placeholderTextArea = 'Entrez votre texte ici',
      ?string $classTextArea = 'form-control',
      ?string $idTextArea = 'id'
    ):string
    {
      return <<<HTML
        <textarea name="$nameTextArea" class="$classTextArea" placeholder="$placeholderTextArea" id="$idTextArea"></textarea>
      HTML;
    }
    public static function Label(
      string $forLabel,
      string $textLabel,
      ?string $classLabel = 'form-label'
    ):string
    {
      return <<<HTML
        <label for="$forLabel" class="$classLabel">$textLabel</label>
      HTML;
    }
    public static function Link(string $url,string $nameUrl,string $classLink,?string $icone):string
    {
      return <<<HTML
        <li class="$classLink"><a href="$url" >$icone $nameUrl</a></li>
      HTML;
    }

    public static function Image(
      string $srcImage,
      ?string $classImage = 'img-fluid',
    ):string
    {
      return <<<HTML
        <img src="$srcImage" class="$classImage" >
      HTML;
    }

  }
?>