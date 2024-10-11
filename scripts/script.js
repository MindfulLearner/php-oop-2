document.addEventListener("DOMContentLoaded", () => {
  axios
    .get('http://192.168.1.101:8080/data/products.json', {
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then((response) => {
      const products = response.data;
      const cardContainer = document.querySelector("#card-container");
      cardContainer.innerHTML = '';

      // Itero su ogni prodotto e creo una card
      products.forEach(product => {
        const card = createCard(product);
        cardContainer.appendChild(card);
      });

    })
    .catch((error) => {
      console.error('errre:', error);
    });
});

// creo una card per un prodotto
function createCard(product) {
  const card = document.createElement("div");
  card.classList.add('card');
  card.addEventListener("click", () => handleCardClick(product));

  // creo un div per il titolo prodotto (label)
  const labelDiv = createLabelDiv(product.label);
  card.appendChild(labelDiv);

  // creo un div per l'immagine del prodotto
  const imgContainerDiv = createImgContainer(product.images, product.label);
  card.appendChild(imgContainerDiv);

  // aggiungo il prezzo
  const priceDiv = createPriceDiv(product.price);
  card.appendChild(priceDiv);

  // aggiungo il tipo di prodotto
  const typeDiv = createTypeDiv(product.type);
  card.appendChild(typeDiv);

  // aggiungo l'icona dell'animale
  const categoryDiv = createCategoryDiv(product.category);
  card.appendChild(categoryDiv);

  return card;
}

// gestisce il click su una card
function handleCardClick(product) {
  console.log(product);
}

// creo un div per il titolo del prodotto (label)
function createLabelDiv(label) {
  const labelDiv = document.createElement("div");
  labelDiv.classList.add("label");
  labelDiv.textContent = label;
  return labelDiv;
}

// creo un div per l'immagine del prodotto
function createImgContainer(images, label) {
  const imgContainerDiv = document.createElement("div");
  imgContainerDiv.classList.add("img-container");

  const imgFull = document.createElement("img");
  imgFull.src = images;
  imgFull.alt = label;
  imgContainerDiv.appendChild(imgFull);

  return imgContainerDiv;
}

// aggiungo il prezzo del prodotto
function createPriceDiv(price) {
  const priceDiv = document.createElement("div");
  priceDiv.classList.add("price");
  priceDiv.textContent = `Prezzo: €${price.toFixed(2)}`;
  return priceDiv;
}

// aggiungo il tipo di prodotto
function createTypeDiv(type) {
  const typeDiv = document.createElement("div");
  typeDiv.classList.add("type");
  typeDiv.textContent = `Tipo: ${type}`;
  return typeDiv;
}

// aggiungo l'icona dell'animale
function createCategoryDiv(category) {
  const categoryDiv = document.createElement("div");
  categoryDiv.classList.add("category");

  const iconImg = document.createElement("img");
  iconImg.src = category.icon;
  iconImg.alt = `${category.animal} icon`;
  categoryDiv.appendChild(iconImg);

  const animalDiv = document.createElement("div");
  animalDiv.textContent = `Categoria: ${category.animal}`;
  categoryDiv.appendChild(animalDiv);

  return categoryDiv;
}

