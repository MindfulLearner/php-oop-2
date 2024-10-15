<?php

class Products {
  private string $label; // nome titolo 
  private string $images; // src chee verra messo nellhtml
  private float $price; // prezzo
  /*private string $type; // giochi, prodotti ...*/
  private object $type;
  private Category $category; // cani o gatti o altro etcc..

  public function __construct(string $label, string $images, float $price, object $type, Category $category) {
    $this->label = $label;
    $this->images = $images;
    $this->price = $price;
    $this->type = $type;
    $this->category = $category;
  }

  
    public function getLabel() {
        return $this->label;
    }

    public function getImages() {
        return $this->images;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
      $this->price = $price;
    }

    public function getType() {
        return $this->type;
    }

    public function getCategory() {
        return $this->category;
    }

    // funzione per debuggare 
    // getinfo ha senso?
    public function getInfo() {
      return [
        'label' => $this->label,
        'images' => $this->images,
        'prices' => $this->price,
        'type' => $this->type,
        'category' => $this->category
      ];
    }
}

trait type {
  private string $type;
  public function getType() {
    return $this->type;
  }
}

class Category {
  private string $animal; // cani o gatti o altroo etc... 
  private string $animalIcon; // icona cani gatti...

  public function __construct(string $animal, string $animalIcon) {
    $this->animal = $animal;
    $this->animalIcon = $animalIcon;
  }
    public function getAnimal(): string {
        return $this->animal;
    }

    public function getAnimalIcon(): string {
        return $this->animalIcon;
    }

}

function prettyVarDump($var) {
  echo '<pre style="background: #f4f4f4; border: 1px solid #ccc; padding: 10px; border-radius: 5px; font-size: 14px; line-height: 1.5;">';
  var_dump($var);
  echo '</pre>';
}


// classi passte a composizione

class Cibo {
    public function getTypeName() {
        return 'food';
    }
}

class Giocattolo {
    public function getTypeName() {
        return 'toy';
    }
}

class Accessorio {
    public function getTypeName() {
        return 'accessory';
    }
}

class Cuccia {
    public function getTypeName() {
        return 'bed';
    }
}

?>
