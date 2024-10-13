document.addEventListener("DOMContentLoaded", () => {
  axios
    .get('http://192.168.1.101:8080/php/getApiProducts.php', {
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
        card.addEventListener("click", () => addCartProduct(product));
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

let totalSum = 0;
// inside of cart will be 'id' no id non lho messo non ho voglia di modificare tutto., 'name', 'price'
let cart = [];

// gestisce il click su una card
function addCartProduct(product) {
  console.log(product);

  console.log(product.label);
  console.log(product.price);

  let cont = ({ "label": product.label, "price": product.price });
  cart.push(cont);
  totalSum += product.price;
  // stampo array con il carrello
  console.log(cart);
  console.log(`totale del carrello: ${totalSum.toFixed(2)}`)

  // price total logic
  let totalPrice = document.querySelector("#totalPrice");
  totalPrice.textContent = totalSum.toFixed(2);

  // creazione cart
  const arrayCartContainer = document.querySelector("#arrayCart");
  const card = createCard(product);
  card.classList.add("in-cart");
  arrayCartContainer.appendChild(card);

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

function logIn(event) {
  const logMein = document.getElementById("logMein");
  const form = event.target;
  if (!validateForm(form)) {
    alert('failed validation bro');
    return;
  }
  //returnera data
  const data = getData(form);
  console.log(data);
  // axios logic post and validatefrom php
  logMein.textContent = `inviato dati`;
  axios
    .post('http://192.168.1.101:8080/php/postLogIn.php', data)

    .then((response) => {
      console.log(response);
      console.log(response.data);
      if (response.data.status === 'success') {
        console.log("successo");
        getDiscountedData();
      } else {
        console.log("non sei loggato bro");
      }
    })
    .catch((error) => {
      console.log(error);
    });



  //reset form
  form.reset();
  event.preventDefault();
}


const getDiscountedData = () => {
  axios
    .get('http://192.168.1.101:8080/php/postAPIDiscounted.php', {
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
        card.addEventListener("click", () => addCartProduct(product));
        cardContainer.appendChild(card);
      });

    })
    .catch((error) => {
      console.error('errre:', error);
    });

};

//validation
function validateForm(form) {
  const formData = new FormData(form);
  const credit = formData.get('credit');
  const email = formData.get('email');
  const day = parseInt(formData.get('day'), 10);
  const month = parseInt(formData.get('month'), 10);

  //credit card validation
  if (credit.length !== 4 || !/^\d+$/.test(credit)) {
    alert('carta di credito non valida o hai inserito piu numeri o hai inserito un carattere non valido');
    return false;
  }

  // controll email
  if (!validateEmail(email)) {
    alert('inserisci email valida');
    return false;
  }

  //  controllo data
  const currentDate = new Date();
  const currentDay = currentDate.getDate();
  const currentMonth = currentDate.getMonth() + 1;

  if (month < currentMonth || (month === currentMonth && day < currentDay)) {
    alert('giorno non valido perche maggiore di quelal di oggi');
    return false;
  }

  return true;
}

// get data 
function getData(form) {
  const formData = new FormData(form);

  for (const [key, value] of formData.entries()) {
    console.log(`${key}: ${value}`);
  }
  const dataObject = Object.fromEntries(formData);

  return dataObject;
}

// controllo email presa da qualche parte su overflow
function validateEmail(email) {
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return emailPattern.test(email);
}

const form = document.getElementById("form-container");
form.addEventListener("submit", logIn);


function buyCart(event) {
  // logica copra quando mando un axio post voglio ricevere una risposta di conferma
  axios
    .post('http://192.168.1.101:8080/php/postBuy.php', cart)

    .then((response) => {
      console.log(response);
      console.log(response.data);
      if (response.data.status === 'success') {
        console.log("comprato");
      } else {
        console.log("non sei loggato bro");
      }
    })
    .catch((error) => {
      console.log(error);
    });



  cart = [];
  console.log('ora array vuoto');
  let totalPrice = document.querySelector("#totalPrice");
  totalPrice.textContent = `00.00`
  totalSum = 0;
  const arrayContainer = document.querySelector("#arrayCart");
  arrayContainer.innerHTML = '';
}

const buyForm = document.getElementById("compralo");
buyForm.addEventListener("click", buyCart); 
